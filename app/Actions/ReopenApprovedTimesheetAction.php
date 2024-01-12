<?php

namespace App\Actions;

use App\Enums\TimesheetStatusEnum;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;

final class ReopenApprovedTimesheetAction
{
    public function handle(Timesheet $timesheet)
    {
        DB::transaction(function () use ($timesheet) {
            $timesheet->update([
                'status' => TimesheetStatusEnum::Open->value,
            ]);

            $timesheet->approvalRequest()->delete();

            $timesheet->timesheetApproval()->delete();
        });
    }
}
