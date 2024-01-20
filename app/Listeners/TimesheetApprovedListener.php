<?php

namespace App\Listeners;

use App\Models\Timesheet;
use App\Notifications\TimesheetApprovedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TimesheetApprovedListener
{
    public function __construct(public Timesheet $timesheet)
    {
    }

    public function handle(object $event): void
    {
        Notification::send(
            notifiables: $event->timesheet->user,
            notification: new TimesheetApprovedNotification(
                timesheet: $event->timesheet
            )
        );
    }
}
