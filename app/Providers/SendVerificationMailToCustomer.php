<?php

namespace App\Providers;

use App\Providers\BookingDone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationMailToCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\BookingDone  $event
     * @return void
     */
    public function handle(BookingDone $event)
    {
        //
    }
}
