<?php

namespace App\Listeners;

use App\Models\Timesheet;
use App\Notifications\TimesheetRejectedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TimesheetRejectedListener
{
    public function __construct(public Timesheet $timesheet)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Notification::send(
            notifiables: $event->timesheet->user,
            notification: new TimesheetRejectedNotification(
                timesheet: $event->timesheet
            )
        );
    }
}
