<?php

namespace App\Actions\ApprovalRequest;

use App\Models\ApprovalRequest;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;

final class StoreReturnTimesheetAction
{
    protected Timesheet $timesheet;
    protected array $validated;

    public function handle(Timesheet $timesheet, array $validated = [])
    {
        $this->timesheet = $timesheet;
        $this->validated = $validated;

        DB::transaction(function () {
            $this->timesheet->timesheetComments()->create([
                'comment' => $this->validated['comment'],
            ]);

            ApprovalRequest::query()
                ->where('timesheet_id', $this->timesheet->id)
                ->update([
                    'status' => 'open'
                ]);
        });
    }
}
