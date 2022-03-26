<?php

namespace App\Listeners;

use App\Events\BookingDone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\VerificationMail;

class SendVerificationMailToCustomer implements ShouldQueue
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
     * @param  \App\Events\BookingDone  $event
     * @return void
     */
    public function handle(BookingDone $event)
    {
        $booking = $event->booking;
        Mail::to($booking->customer->email)->send(new VerificationMail($booking));
    }
}
