<?php

namespace App\Listeners;

use App\Models\Timesheet;
use App\Notifications\TimesheetReopenedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TimesheetReopenedListener
{
    protected Timesheet $timesheet;

    public function __construct(Timesheet $timesheet)
    {
        $this->timesheet = $timesheet;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Notification::send(
            notifiables: $event->timesheet->user,
            notification: new TimesheetReopenedNotification(
                timesheet: $event->timesheet
            )
        );
    }
}
