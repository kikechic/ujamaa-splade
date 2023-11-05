<?php

namespace App\Listeners;

use App\Models\Timesheet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTimesheetCommentNotification;

class NewTimesheetCommentListener
{
    protected Timesheet $timesheet;
    protected string $comment;

    /**
     * Create the event listener.
     */
    public function __construct(Timesheet $timesheet, string $comment)
    {
        $this->timesheet = $timesheet;
        $this->comment = $comment;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Notification::send(new NewTimesheetCommentNotification($this->timesheet, $this->comment));
    }
}
