<?php

namespace App\Repositories;

use App\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;

class BookingRepository implements BookingRepositoryInterface 
{
    public function getAllBookings() 
    {
        return Booking::paginate(10);
    }

    public function getBookingById($bookingId) 
    {
        return Booking::findOrFail($bookingId);
    }

    public function createBooking(array $bookingData) 
    {
        $booking = Booking::create($bookingData);
        return $booking;
    }

    public function updateBooking($bookingId, array $bookingData) 
    {
        $booking = $this->getBookingById($bookingId);
        $booking->update($bookingData);
        return $booking;
    }

    public function deleteBooking($bookingId) 
    {
        $booking = $this->getBookingById($bookingId);
        $this->syncServicesToBooking($booking, []);
        $booking->delete();
    }

    public function paidBooking($bookingId){
        $booking = $this->getBookingById($bookingId);
        $booking->update(['is_taken_back' => 1]);
        return $booking;
    }

    public function syncServicesToBooking(Booking $booking, array $services){
        $booking->services()->sync($services);
    }
}
