<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Models\ApprovalRequest;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;

final class StoreRejectTimesheetAction
{
    protected Timesheet $timesheet;

    public function handle(Timesheet $timesheet)
    {
        $this->timesheet = $timesheet;

        DB::transaction(function () {
            $this->timesheet->update([
                'status' => TimesheetStatusEnum::rejected()
            ]);

            ApprovalRequest::query()
                ->where('timesheet_id', $this->timesheet->id)
                ->update([
                    'status' => 'rejected',
                ]);
        });
    }
}
