<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Service;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function getAllBookings()
    {
        return Booking::with(['user', 'service'])->latest()->get();
    }

    public function getBookingById($id)
    {
        return Booking::with(['user', 'service'])->findOrFail($id);
    }

    public function getBookingsByUser($userId)
    {
        return Booking::where('user_id', $userId)
            ->with('service')
            ->latest()
            ->get();
    }

    public function getBookingsByService($serviceId)
    {
        return Booking::where('service_id', $serviceId)
            ->with('user')
            ->latest()
            ->get();
    }

    public function getBookingsByProvider($providerId)
    {
        return Booking::whereHas('service', function ($query) use ($providerId) {
            $query->where('user_id', $providerId);
        })
        ->with(['user', 'service'])
        ->latest()
        ->get();
    }

    public function getPendingBookingsForProvider($providerId)
    {
        return Booking::whereHas('service', function ($query) use ($providerId) {
            $query->where('user_id', $providerId);
        })
        ->where('status', 'pending')
        ->with(['user', 'service'])
        ->latest()
        ->get();
    }

    public function createBooking(array $data)
    {
        return Booking::create($data);
    }

    public function updateBooking($id, array $data)
    {
        $booking = $this->getBookingById($id);
        $booking->update($data);
        return $booking;
    }

    public function confirmBooking($id)
    {
        $booking = $this->getBookingById($id);
        $booking->status = 'confirmed';
        $booking->save();
        return $booking;
    }

    public function cancelBooking($id)
    {
        $booking = $this->getBookingById($id);
        $booking->status = 'cancelled';
        $booking->save();
        return $booking;
    }

    public function completeBooking($id)
    {
        $booking = $this->getBookingById($id);
        $booking->status = 'completed';
        $booking->save();
        return $booking;
    }
}
