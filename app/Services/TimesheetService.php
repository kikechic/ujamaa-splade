<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Donor;
use App\Models\Workday;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\TimesheetPeriod;
use App\Models\DocumentSequence;
use App\Models\TimesheetApproval;
use App\Enums\TimesheetStatusEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class TimesheetService
{
    protected $validated;
    protected Timesheet $timesheet;
    protected array $workdays;
    protected array $days = [];
    protected array $entry = [];
    protected array $totals = [];
    protected array $entries = [];
    protected array $leaveHours = [];
    protected array $donorHours = [];
    protected Carbon $endDate;
    protected Carbon $startDate;
    protected Collection $employees;
    protected TimesheetPeriod $timesheetPeriod;
    protected Collection $donors;
    protected int|string $documentNumber;
    protected bool $updating = false;

    public function setTimesheet($timesheet): self
    {
        $this->timesheet = $timesheet;
        return $this;
    }

    public function getTimesheet(): Timesheet
    {
        return $this->timesheet;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function setTimesheetPeriod($period): self
    {
        $this->timesheetPeriod = $period instanceof TimesheetPeriod ? $period : TimesheetPeriod::query()->findOrFail($period);
        return $this;
    }

    public function getEntries(): array
    {
        return $this->entries;
    }

    public function getDays(): array
    {
        return $this->days;
    }

    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function getDonors(): Collection
    {
        return $this->donors;
    }

    public function prepareWorkdays(): void
    {
        $this->workdays = Workday::query()->pluck('status', 'name')->toArray();
    }

    public function getHours(): array
    {
        return $this->donorHours;
    }

    public function getTotals(): array
    {
        return $this->totals;
    }

    public function prepareDonors(): void
    {
        $this->donors = Donor::query()->get();
    }

    public function setDocument($document): self
    {
        $this->timesheet = $document instanceof Timesheet ? $document : Timesheet::query()->find($document);
        $this->timesheet->loadMissing('timesheetPeriod', 'employee');
        $this->timesheetPeriod = $this->timesheet->timesheetPeriod;
        return $this;
    }

    public function getDocument(): Timesheet
    {
        return $this->timesheet;
    }

    public function getWorkdays(): array
    {
        return $this->workdays;
    }

    public function generateDocumentNumber(): void
    {
        $document = tap(DocumentSequence::documentCode('timesheet')->first(), fn ($doc) => $doc->increment('sequence_number'));
        $this->documentNumber = $document->prefix . $document->delimiter . str_pad($document->sequence_number, 4, '0', STR_PAD_LEFT);
    }

    public function create(): Timesheet
    {
        return DB::transaction(function () {
            $this->generateDocumentNumber();
            $this->prepareEntry();
            $this->timesheet = Timesheet::query()->create($this->entry);
            $this->prepareEntries();
            $this->storeEntries();
            return $this->timesheet;
        });
    }

    public function update(): void
    {
        $this->updating = true;
        DB::transaction(function () {
            $this->prepareEntry();
            $this->timesheet->update($this->entry);
            $this->timesheet->timesheetEntries()->delete();
            $this->prepareEntries();
            $this->storeEntries();
        });
    }

    public function prepareEntry(): void
    {
        $employee = Employee::query()->where('id', auth()->user()->approval->employee_id)->first();

        if (!$this->updating) {
            $this->entry['timesheet_number'] = $this->documentNumber;
            $this->entry['status'] = TimesheetStatusEnum::open();
        }

        $this->entry['timesheet_period_id'] = $this->validated['timesheet_period_id'];
        $this->entry['employee_id'] = $employee->id;
        $this->entry['department_id'] = $employee->department_id;
        $this->entry['designation_id'] = $employee->designation_id;
        // $this->entry['location_id'] = $employee->location_id;
        $this->entry['submission_date'] = $this->validated['submission_date'];
    }

    public function prepareEntries(): void
    {
        if (data_get($this->validated, 'hours')) {
            foreach ($this->validated['hours'] as $key => $donorHours) {
                $this->entries[$key] = [
                    'donor_id' => $this->validated['donor_ids'][$key],
                ];

                foreach ($donorHours as $dayKey => $hour) {
                    $this->entries[$key]['day_' . ($dayKey + 1)] = $hour;
                }
            }
        }
    }

    public function storeEntries(): void
    {
        $chunks = array_chunk($this->entries, 100);

        foreach ($chunks as $chunk) {
            $this->timesheet->timesheetEntries()->createMany($chunk);
        }
    }

    public function delete(): void
    {
        DB::transaction(function () {
            $this->timesheet->timesheetEntries()->delete();
            $this->timesheet->delete();
        });
    }

    public function prepareTotals(): void
    {
        $this->totals = [
            'column_donor_totals' => [],
            'column_totals' => [],
            'row_donor_totals' => [],
            'row_donor_percentages' => [],
            'donor_total' => 0,
            'grand_total' => 0,
        ];

        foreach ($this->days as $key => $day) {
            $this->totals['column_totals'][$key] = 0;
            $this->totals['column_donor_totals'][$key] = 0;
        }

        $timesheetDonorEntries = $this->timesheet->timesheetEntries->unique('donor_id')->pluck('donor_id', 'donor_id');

        foreach ($timesheetDonorEntries as $row) {
            $this->totals['row_donor_totals'][$row] = 0;
            $this->totals['row_donor_percentages'][$row] = 0;
        }

        foreach ($this->timesheet->timesheetEntries as $entry) {
            foreach ($this->days as $key => $value) {
                $column = 'day_' . $key + 1;
                $hrs = $entry->{$column};
                $hour = is_numeric($hrs) ? $hrs : 0;
                $this->totals['column_donor_totals'][$key] += $hour;
                $this->totals['column_totals'][$key] += $hour;
                $this->totals['row_donor_totals'][$entry->donor_id] += $hour;
                $this->totals['donor_total'] += $hour;
            }
        }

        $this->totals['grand_total'] = $this->totals['donor_total'];

        foreach ($this->totals['row_donor_totals'] as $key => $row_total) {
            $donorTotal = $this->totals['donor_total'];

            $this->totals['row_donor_percentages'][$key] = number_format($donorTotal <= 0 ? 0 : (($row_total / $donorTotal) * 100), 2);
        }
    }

    public function prepareTimesheetEntriesForSavingToDatabase(): void
    {
        foreach ($this->validated['hours'] as $key => $donorHours) {
            $this->entries[$key] = [
                'donor_id' => $this->validated['donor_ids'][$key],
            ];

            foreach ($donorHours as $dayKey => $hour) {
                $this->entries[$key]['day_' . ($dayKey + 1)] = $hour;
            }
        }
    }

    public function prepareDays(): void
    {
        $start = $this->startDate->copy();
        $end = $this->endDate->copy();

        while ($start->lte($end)) {
            $this->days[] = [
                'date' => $start->copy()->format('d'),
                'day' => $start->copy()->format('D'),
                'flag' => $this->workdays[$start->copy()->format('l')],
            ];

            $start->addDay();
        }
    }

    public function prepareStartAndEndDates(): void
    {
        $period = $this->timesheetPeriod->period_year . '-' . str_pad($this->timesheetPeriod->period_month?->value, 2, '0', STR_PAD_LEFT);

        $this->startDate = Carbon::parse($period)->startOfMonth();
        $this->endDate = Carbon::parse($period)->endOfMonth();
    }

    public function prepareHours(): void
    {
        $start = $this->startDate->copy();
        $end = $this->endDate->copy();

        foreach ($this->donors as $donor) {
            $this->donorHours[] = [];
        }

        while ($start->lte($end)) {
            $start->addDay();
            foreach ($this->donorHours as $key => $hour) {
                $this->donorHours[$key][] = '';
            }
        }

        if ($this->updating) {
            foreach ($this->donors as $donorIndex => $donor) {
                $entriesForCurrentDonor = $this->timesheet->timesheetEntries->where('donor_id', $donor->id);
                if ($entriesForCurrentDonor) {
                    foreach ($this->donorHours[$donorIndex] as $hourIndex => $hour) {
                        $dayColumnName = 'day_' . ($hourIndex + 1);
                        $this->donorHours[$donorIndex][$hourIndex] = $entriesForCurrentDonor->first()?->{$dayColumnName};
                    }
                }
            }
        }
    }

    public function createFrontEnd(): self
    {
        $this->frontEndHelper();

        return $this;
    }

    public function updateFrontEnd(): self
    {
        $this->updating = true;
        $this->frontEndHelper();

        return $this;
    }

    public function frontEndHelper(): void
    {
        $this->prepareStartAndEndDates();
        $this->prepareWorkdays();
        $this->prepareDays();
        $this->prepareDonors();
        $this->prepareHours();
    }

    public function showFrontEnd(): self
    {
        $this->prepareStartAndEndDates();
        $this->prepareWorkdays();
        $this->prepareDays();
        $this->prepareTotals();
        return $this;
    }

    public function missing(): self
    {
        $this->prepareStartAndEndDates();

        $this->employees =  Employee::query()
            ->with('department', 'office', 'designation')
            ->where(fn ($query) => $query->whereNull('inactive_date')->orWhere('inactive_date', '>=', $this->startDate))
            ->whereDoesntHave('timesheets', fn ($query) => $query->whereIn('timesheets.status', [TimesheetStatusEnum::pending(), TimesheetStatusEnum::approved()]))
            ->get();

        return $this;
    }

    public function postTimesheet(): void
    {
        DB::transaction(function () {
            $this->timesheet->update([
                'status' => TimesheetStatusEnum::posted(),
            ]);
        });
    }

    public function approveTimesheet(): void
    {
        DB::transaction(function () {
            if (data_get($this->validated, 'approve')) {
                $this->timesheet->update([
                    'status' => TimesheetStatusEnum::approved()
                ]);

                $this->timesheet->timesheetApproval()->create([
                    'approval_date' => $this->validated['approval_date']
                ]);
            }

            if (data_get($this->validated, 'reject')) {
                $this->timesheet->update([
                    'status' => TimesheetStatusEnum::rejected()
                ]);
            }

            if (data_get($this->validated, 'return')) {
                $this->timesheet->timesheetComments()->create([
                    'comment' => $this->validated['comment'],
                ]);
            }
        });
    }
}
