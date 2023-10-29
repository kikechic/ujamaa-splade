<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TimesheetPeriod;
use App\Tables\TimesheetsTable;
use App\Services\TimesheetService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Services\PrintTimesheetService;
use App\Enums\TimesheetPeriodStatusEnum;
use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Http\Requests\StoreTimesheetEntryRequest;

class TimesheetController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('timesheets_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheets');

        return view('timesheets.index', [
            'timesheets' => TimesheetsTable::class,
        ]);
    }

    public function entry()
    {
        abort_unless(Gate::allows('timesheets_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create timesheets');

        return view('timesheets.entry', [
            'timesheetPeriods' => TimesheetPeriod::query()
                ->where('status', TimesheetPeriodStatusEnum::open())
                ->get()
                ->keyBy('id')
                ->map(fn ($timesheetPeriod) => "$timesheetPeriod->period_year ~ $timesheetPeriod->month_name"),
        ]);
    }

    public function entryStore(StoreTimesheetEntryRequest $request)
    {
        return redirect()->route('timesheets.create', [
            'period' => $request->validated('timesheet_period_id'),
        ]);
    }

    public function store(StoreTimesheetRequest $request, TimesheetService $timesheetService)
    {
        abort_unless(Gate::allows('timesheets_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create timesheets');

        $timesheet = $timesheetService->setValidated($request->validated())->create();

        Toast::title("Timesheet $timesheet->timesheet_number created successfully")->autoDismiss(3);

        return redirect()->route('timesheets.index');
    }

    public function create()
    {
        abort_unless(Gate::allows('timesheets_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create timesheets');

        $timesheetPeriod = TimesheetPeriod::query()->select('id', 'period_year', 'period_month', 'status')->find(request('period'));

        $employee = Employee::query()->where('id', auth()->user()->approval->employee_id)->first();

        abort_unless($employee ?? false, Response::HTTP_FORBIDDEN, 'You must have an employee assigned to your user account to create timesheets');

        $employee->load('department:id,name', 'designation:id,name');

        $timesheetService = (new TimesheetService)->setTimesheetPeriod($timesheetPeriod)->createFrontEnd();

        return view('timesheets.create', [
            'timesheetPeriod' => $timesheetPeriod,
            'employee' => $employee,
            'days' => $timesheetService->getDays(),
            'donors' => $timesheetService->getDonors(),
            'hours' => $timesheetService->getHours(),
        ]);
    }

    public function show(Timesheet $timesheet, TimesheetService $timesheetService)
    {
        abort_unless(Gate::allows('timesheets_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheets');

        $timesheet->load([
            'user:id,name',
            'updater:id,name',
            'office:id,name',
            'department:id,name',
            'designation:id,name',
            'timesheetPeriod:id,period_year,period_month',
            'employee:id,first_name,middle_name,last_name,employee_number',
            'timesheetEntries',
        ]);

        $timesheetService = $timesheetService->setDocument($timesheet)->setTimesheetPeriod($timesheet->timesheetPeriod)->showFrontEnd();

        return view('timesheets.show', [
            'timesheet' => $timesheet,
            'days' => $timesheetService->getDays(),
            'totals' => $timesheetService->getTotals(),
            'printURL' => route('timesheets.print', $timesheet),
        ]);
    }

    public function edit(Timesheet $timesheet, TimesheetService $timesheetService)
    {
        abort_unless(Gate::allows('timesheets_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update timesheets');

        $timesheet->load('timesheetPeriod', 'employee');

        $timesheetService = $timesheetService->setDocument($timesheet)->updateFrontEnd();

        return view('timesheets.edit', [
            'timesheet' => $timesheet,
            'donors' => $timesheetService->getDonors(),
            'days' => $timesheetService->getDays(),
            'hours' => $timesheetService->getHours(),
        ]);
    }

    public function update(UpdateTimesheetRequest $request, Timesheet $timesheet, TimesheetService $timesheetService)
    {
        abort_unless(Gate::allows('timesheets_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update timesheets');

        $timesheetService->setDocument($timesheet)->setValidated($request->validated())->update();

        Toast::title("Timesheet $timesheet->timesheet_number updated successfully")->autoDismiss(3);

        return redirect()->route('timesheets.index');
    }

    public function destroy(Timesheet $timesheet)
    {
        abort_unless(Gate::allows('timesheets_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete timesheets');

        return DB::transaction(function () use ($timesheet) {
            return redirect()->route('timesheets.index');
        });
    }

    public function missingReportEntry()
    {
        $timesheetPeriods = TimesheetPeriod::query()
            ->get()
            ->keyBy('id')
            ->map(fn ($timesheetPeriod) => "$timesheetPeriod->period_year ~ $timesheetPeriod->month_name");

        return view('timesheets.reports.missing-entry', compact('timesheetPeriods'));
    }

    public function missingReport()
    {
        $validated = request()->validate([
            'timesheet_period_id' => 'required',
        ]);

        $timesheetService = (new TimesheetService)->setTimesheetPeriod($validated['timesheet_period_id'])->missing();

        return view('timesheets.reports.missing', [
            'employees' => $timesheetService->getEmployees(),
        ]);
    }

    public function postPrintTimesheet(Timesheet $timesheet, TimesheetService $timesheetService)
    {
        $timesheetService->setDocument($timesheet)->postTimesheet();

        Toast::title("Timesheet $timesheet->timesheet_number posted successfully")->autoDismiss(3);

        session()->flash('print_timesheet', route('documents.print', [
            'document_id' => $timesheet->id,
            // 'document_code' => DocumentTypesEnum::timesheet(),
        ]));

        return back();
    }

    public function postTimesheet(Timesheet $timesheet, TimesheetService $timesheetService)
    {
        $timesheetService->setDocument($timesheet)->postTimesheet();

        Toast::title("Timesheet $timesheet->timesheet_number posted successfully")->autoDismiss(3);

        return back();
    }

    public function print(Timesheet $timesheet, PrintTimesheetService $printTimesheetService)
    {

        return $printTimesheetService
            ->setTimesheet($timesheet)
            ->print()
            ->stream($timesheet->timesheet_number, [
                'Attachment' => 0,
            ]);
    }
}
