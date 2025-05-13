<?php

namespace App\Repositories;

use App\Models\Availability;
use App\Models\Booking;
use App\Repositories\Interfaces\AvailabilityRepositoryInterface;
use Carbon\Carbon;

class AvailabilityRepository implements AvailabilityRepositoryInterface
{
    public function getAllAvailabilities()
    {
        return Availability::with('service')->get();
    }

    public function getAvailabilityById($id)
    {
        return Availability::findOrFail($id);
    }

    public function getAvailabilitiesByService($serviceId)
    {
        return Availability::where('service_id', $serviceId)
            ->orderBy('start_time')
            ->get();
    }

    public function createAvailability(array $data)
    {
        return Availability::create($data);
    }

    public function updateAvailability($id, array $data)
    {
        $availability = $this->getAvailabilityById($id);
        $availability->update($data);
        return $availability;
    }

    public function deleteAvailability($id)
    {
        $availability = $this->getAvailabilityById($id);
        $availability->delete();
        return true;
    }

    public function checkAvailability($serviceId, $dateTime)
    {
        // Convert the datetime to a Carbon instance if it's not already
        if (!($dateTime instanceof Carbon)) {
            $dateTime = Carbon::parse($dateTime);
        }
        
        // Get day of week (0 = Sunday, 6 = Saturday)
        $dayOfWeek = $dateTime->dayOfWeek;
        
        // Get time in format HH:MM:SS
        $time = $dateTime->format('H:i:s');
        
        // Check if there's an availability rule for this service and time
        $availabilityExists = Availability::where('service_id', $serviceId)
            ->whereTime('start_time', '<=', $time)
            ->whereTime('end_time', '>', $time)
            ->exists();
            
        if (!$availabilityExists) {
            return false;
        }
        
        // Check if there's an existing booking at this time
        $bookingExists = Booking::where('service_id', $serviceId)
            ->where('booking_date', $dateTime)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
            
        return !$bookingExists;
    }

    public function getAvailableTimeSlots($serviceId, $date)
    {
        // Convert the date to a Carbon instance if it's not already
        if (!($date instanceof Carbon)) {
            $date = Carbon::parse($date);
        }
        
        // Get day of week
        $dayOfWeek = $date->dayOfWeek;
        
        // Get availabilities for this service
        $availabilities = $this->getAvailabilitiesByService($serviceId);
        
        // Get existing bookings for this service on this date
        $bookings = Booking::where('service_id', $serviceId)
            ->whereDate('booking_date', $date->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();
            
        // Generate time slots (e.g., hourly slots from start_time to end_time)
        $timeSlots = [];
        
        foreach ($availabilities as $availability) {
            $startTime = Carbon::parse($availability->start_time);
            $endTime = Carbon::parse($availability->end_time);
            
            $slotStart = Carbon::parse($date->toDateString() . ' ' . $startTime->format('H:i:s'));
            
            while ($slotStart < Carbon::parse($date->toDateString() . ' ' . $endTime->format('H:i:s'))) {
                $slotEnd = (clone $slotStart)->addHour();
                
                // Check if this slot conflicts with any existing bookings
                $isAvailable = true;
                foreach ($bookings as $booking) {
                    $bookingTime = Carbon::parse($booking->booking_date);
                    
                    if ($bookingTime >= $slotStart && $bookingTime < $slotEnd) {
                        $isAvailable = false;
                        break;
                    }
                }
                
                if ($isAvailable) {
                    $timeSlots[] = [
                        'start' => $slotStart->format('H:i'),
                        'end' => $slotEnd->format('H:i'),
                        'is_available' => true
                    ];
                }
                
                $slotStart = $slotEnd;
            }
        }
        
        return $timeSlots;
    }
}
