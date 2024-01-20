<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Events\TimesheetApprovedEvent;
use App\Events\TimesheetRejectedEvent;
use App\Events\TimesheetReturnedEvent;
use App\Models\ApprovalRequest;
use App\Models\Timesheet;
use App\Models\TimesheetApproval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

final class ApproveTimesheetAction
{
    protected Timesheet $timesheet;
    protected array $validated;

    public function handle(Timesheet $timesheet, array $validated): string
    {
        $this->timesheet = $timesheet;
        $this->validated = $validated;

        if (data_get($this->validated, 'approve')) {
            (new StoreApproveTimesheetAction)->handle(
                timesheet: $this->timesheet,
                validated: $this->validated
            );

            TimesheetApprovedEvent::dispatch($this->timesheet);

            return "approved";
        }

        if (data_get($this->validated, 'reject')) {
            (new StoreRejectTimesheetAction)->handle(timesheet: $this->timesheet);

            TimesheetRejectedEvent::dispatch($this->timesheet);

            return "rejected";
        }

        if (data_get($this->validated, 'return')) {
            (new StoreReturnTimesheetAction)->handle(
                timesheet: $this->timesheet,
                validated: $this->validated
            );

            TimesheetReturnedEvent::dispatch($this->timesheet, $this->validated['comment']);

            return "returned";
        }
    }
}
