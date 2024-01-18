<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;

final class RejectTimesheetAction
{
    protected Timesheet $timesheet;

    public function handle(Timesheet $timesheet)
    {
        DB::transaction(function () {
            $this->timesheet->update([
                'status' => TimesheetStatusEnum::Rejected
            ]);
        });
    }
}
