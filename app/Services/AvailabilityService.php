<?php

namespace App\Services;

use App\Repositories\Interfaces\AvailabilityRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AvailabilityService
{
    protected $availabilityRepository;
    protected $serviceRepository;
    protected $bookingRepository;

    public function __construct(
        AvailabilityRepositoryInterface $availabilityRepository,
        ServiceRepositoryInterface $serviceRepository,
        BookingRepositoryInterface $bookingRepository
    ) {
        $this->availabilityRepository = $availabilityRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function getAllAvailabilities()
    {
        return $this->availabilityRepository->getAllAvailabilities();
    }

    public function getAvailabilityById($id)
    {
        return $this->availabilityRepository->getAvailabilityById($id);
    }

    public function getAvailabilitiesByService($serviceId)
    {
        return $this->availabilityRepository->getAvailabilitiesByService($serviceId);
    }

    public function createAvailability(array $data)
    {
        // Validate that the time range doesn't overlap with existing availability
        $this->validateTimeRange($data);
        
        return $this->availabilityRepository->createAvailability($data);
    }

    public function updateAvailability($id, array $data)
    {
        // Validate that the time range doesn't overlap with existing availability
        $this->validateTimeRange($data, $id);
        
        return $this->availabilityRepository->updateAvailability($id, $data);
    }

    public function deleteAvailability($id)
    {
        return $this->availabilityRepository->deleteAvailability($id);
    }

    public function checkAvailability($serviceId, $dateTime)
    {
        return $this->availabilityRepository->checkAvailability($serviceId, $dateTime);
    }

    public function getAvailableTimeSlots($serviceId, $date)
    {
        return $this->availabilityRepository->getAvailableTimeSlots($serviceId, $date);
    }

    private function validateTimeRange(array $data, $excludeId = null)
    {
        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);
        
        // Ensure end time is after start time
        if ($startTime >= $endTime) {
            throw new \Exception('End time must be after start time.');
        }
        
        // Get existing availabilities for this service
        $existingAvailabilities = $this->availabilityRepository->getAvailabilitiesByService($data['service_id']);
        
        foreach ($existingAvailabilities as $availability) {
            // Skip the current availability being updated
            if ($excludeId && $availability->id == $excludeId) {
                continue;
            }
            
            $existingStart = Carbon::parse($availability->start_time);
            $existingEnd = Carbon::parse($availability->end_time);
            
            // Check for overlap
            if (($startTime >= $existingStart && $startTime < $existingEnd) ||
                ($endTime > $existingStart && $endTime <= $existingEnd) ||
                ($startTime <= $existingStart && $endTime >= $existingEnd)) {
                throw new \Exception('The specified time range overlaps with existing availability.');
            }
        }
        
        return true;
    }

    public function getWeeklyCalendar($serviceId, $startDate = null)
    {
        // If no start date provided, use the current date
        if (!$startDate) {
            $startDate = Carbon::now()->startOfWeek();
        } else if (!($startDate instanceof Carbon)) {
            $startDate = Carbon::parse($startDate)->startOfWeek();
        }
        
        // Generate calendar for 7 days
        $calendar = [];
        
        for ($i = 0; $i < 7; $i++) {
            $date = (clone $startDate)->addDays($i);
            
            $calendar[] = [
                'date' => $date->toDateString(),
                'day_name' => $date->format('l'),
                'time_slots' => $this->getAvailableTimeSlots($serviceId, $date)
            ];
        }
        
        return $calendar;
    }
}
