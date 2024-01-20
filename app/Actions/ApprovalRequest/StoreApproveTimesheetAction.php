<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Models\ApprovalRequest;
use App\Models\Timesheet;
use App\Models\TimesheetApproval;
use Illuminate\Support\Facades\DB;

final class StoreApproveTimesheetAction
{
    protected Timesheet $timesheet;
    protected array $validated;

    public function handle(Timesheet $timesheet, array $validated = [])
    {
        $this->timesheet = $timesheet;
        $this->validated = $validated;

        DB::transaction(function () {
            $this->timesheet->update([
                'status' => TimesheetStatusEnum::Approved
            ]);

            TimesheetApproval::query()->updateOrCreate([
                'timesheet_id' => $this->timesheet->id,
            ], [
                'approval_date' => $this->validated['approval_date'],
            ]);

            ApprovalRequest::query()
                ->where('timesheet_id', $this->timesheet->id)
                ->update([
                    'status' => 'approved'
                ]);
        });
    }
}
