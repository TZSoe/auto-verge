<?php

namespace App\Listeners;

use App\Events\CarIsTakenBack;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\InvoiceMail;
use Mail;

class SendInvoiceMailToCustomer implements ShouldQueue
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
     * @param  \App\Events\CarIsTakenBack  $event
     * @return void
     */
    public function handle(CarIsTakenBack $event)
    {
        $booking = $event->booking;
        Mail::to($booking->customer->email)->send(new InvoiceMail($booking));
    }
}
