<?php

namespace App\Actions;

use App\Enums\TimesheetStatusEnum;
use App\Events\TimesheetReopenedEvent;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;

final class ReopenApprovedTimesheetAction
{
    public function handle(Timesheet $timesheet)
    {
        DB::transaction(function () use ($timesheet) {
            $timesheet->update([
                'status' => TimesheetStatusEnum::Open,
            ]);

            $timesheet->approvalRequest()->delete();

            // $timesheet->timesheetApproval()->delete();

            TimesheetReopenedEvent::dispatch($timesheet);
        });
    }
}
