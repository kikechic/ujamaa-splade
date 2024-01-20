<?php

namespace App\Providers;

use App\Events\TimesheetApprovedEvent;
use App\Events\TimesheetRejectedEvent;
use App\Events\TimesheetReopenedEvent;
use App\Events\TimesheetReturnedEvent;
use App\Listeners\TimesheetApprovedListener;
use App\Listeners\TimesheetRejectedListener;
use App\Listeners\TimesheetReopenedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Notifications\TimesheetReturnedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TimesheetReturnedEvent::class => [
            TimesheetReturnedNotification::class,
        ],
        TimesheetReopenedEvent::class => [
            TimesheetReopenedListener::class,
        ],
        TimesheetApprovedEvent::class => [
            TimesheetApprovedListener::class,
        ],
        TimesheetRejectedEvent::class => [
            TimesheetRejectedListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
