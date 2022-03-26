<?php

namespace App\Interfaces;

interface BookingRepositoryInterface 
{
    public function getAllBookings();
    public function getBookingById($bookingId);
    public function createBooking(array $bookingData);
    public function updateBooking($bookingId, array $bookingData);
    public function deleteBooking($bookingId);
}