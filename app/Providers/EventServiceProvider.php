<?php

namespace App\Providers;

use App\Events\BookUpdated;
use App\Events\BookViewed;
use App\Listeners\BookUpdatedListener;
use App\Listeners\BookViewedDatabaseListener;
use App\Listeners\BookViewedLogListener;
use App\Listeners\BookViewedLogSubscriber;
use App\Listeners\EventUpdateSubscriber;
use Illuminate\Auth\Events\Registered;
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

        BookViewed::class => [
            BookViewedLogListener::class,
            BookViewedDatabaseListener::class,
        ],

        BookUpdated::class => [
            BookUpdatedListener::class
        ]
    ];

    protected $subscribe = [
        EventUpdateSubscriber::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
