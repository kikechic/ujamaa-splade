<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Models\ApprovalRequest;
use App\Models\Timesheet;
use App\Models\TimesheetApproval;
use Illuminate\Support\Facades\DB;

final class ApproveTimesheetAction
{
    protected Timesheet $timesheet;
    protected array $validated;

    public function handle(Timesheet $timesheet, array $validated): string
    {
        $this->timesheet = $timesheet;
        $this->validated = $validated;

        return DB::transaction(function () {
            if (data_get($this->validated, 'approve')) {
                $this->timesheet->update([
                    'status' => TimesheetStatusEnum::approved()
                ]);

                $this->timesheet->timesheetApproval()->updateOrCreate([
                    'approval_date' => $this->validated['approval_date']
                ]);

                ApprovalRequest::query()
                    ->where('timesheet_id', $this->timesheet->id)
                    ->update([
                        'status' => 'approved'
                    ]);

                // TimesheetApproval::query()->updateOrCreate([
                //     'timesheet_id' => $this->timesheet->id,
                // ], [
                //     'approval_date' => $this->validated['approval_date'],
                // ]);

                return "approved";
            }

            if (data_get($this->validated, 'reject')) {
                $this->timesheet->update([
                    'status' => TimesheetStatusEnum::rejected()
                ]);

                ApprovalRequest::query()
                    ->where('timesheet_id', $this->timesheet->id)
                    ->update([
                        'status' => 'rejected',
                    ]);

                return "rejected";
            }

            if (data_get($this->validated, 'return')) {
                $this->timesheet->timesheetComments()->create([
                    'comment' => $this->validated['comment'],
                ]);

                ApprovalRequest::query()
                    ->where('timesheet_id', $this->timesheet->id)
                    ->update([
                        'status' => 'open'
                    ]);

                return "returned";
            }
        });
    }
}
