<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\BookingDone;
use App\Listeners\SendVerificationMailToCustomer;
use App\Events\CarIsTakenBack;
use App\Listeners\SendInvoiceMailToCustomer;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BookingDone::class => [
            SendVerificationMailToCustomer::class,
        ],
        CarIsTakenBack::class => [
            SendInvoiceMailToCustomer::class
        ]
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
}
