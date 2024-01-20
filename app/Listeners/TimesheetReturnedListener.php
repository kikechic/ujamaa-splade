<?php

namespace App\Listeners;

use App\Models\Timesheet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TimesheetReturnedNotification;

class TimesheetReturnedListener
{
    public function __construct(public Timesheet $timesheet, public string $comment)
    {
    }

    public function handle(object $event): void
    {
        Notification::send(
            notifiables: $event->timesheet->user,
            notification: new TimesheetReturnedNotification(
                timesheet: $event->timesheet,
                comment: $event->comment
            )
        );
    }
}
