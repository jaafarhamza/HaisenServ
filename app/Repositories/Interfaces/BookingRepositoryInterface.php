<?php

namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface
{
    public function getAllBookings();
    public function getBookingById($id);
    public function getBookingsByUser($userId);
    public function getBookingsByService($serviceId);
    public function getBookingsByProvider($providerId);
    public function getPendingBookingsForProvider($providerId);
    public function createBooking(array $data);
    public function updateBooking($id, array $data);
    public function confirmBooking($id);
    public function cancelBooking($id);
    public function completeBooking($id);
}
