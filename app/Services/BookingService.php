<?php

namespace App\Services;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\AvailabilityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Exceptions\Custom\AvailabilityException;
use App\Exceptions\Custom\BookingException;
use App\Exceptions\Custom\UnauthorizedActionException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingService
{
    protected $bookingRepository;
    protected $serviceRepository;
    protected $availabilityRepository;
    protected $userRepository;

    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        ServiceRepositoryInterface $serviceRepository,
        AvailabilityRepositoryInterface $availabilityRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->serviceRepository = $serviceRepository;
        $this->availabilityRepository = $availabilityRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllBookings()
    {
        return $this->bookingRepository->getAllBookings();
    }

    public function getBookingById($id)
    {
        return $this->bookingRepository->getBookingById($id);
    }

    public function getBookingsByUser($userId)
    {
        return $this->bookingRepository->getBookingsByUser($userId);
    }

    public function getBookingsByService($serviceId)
    {
        return $this->bookingRepository->getBookingsByService($serviceId);
    }

    public function getBookingsByProvider($providerId)
    {
        return $this->bookingRepository->getBookingsByProvider($providerId);
    }

    public function getPendingBookingsForProvider($providerId)
    {
        return $this->bookingRepository->getPendingBookingsForProvider($providerId);
    }

    public function createBooking(array $data)
    {
        // Get the service
        $service = $this->serviceRepository->getServiceById($data['service_id']);
        
        // Validate that the service is active
        if ($service->status !== 'active') {
            throw new BookingException('This service is not currently available for booking.');
        }
        
        // Check if the service is available at the requested time
        if (!$this->availabilityRepository->checkAvailability($service->id, $data['booking_date'])) {
            throw new AvailabilityException('The service is not available at the requested time.');
        }
        
        // Set the booking amount based on the service price
        if (!isset($data['amount'])) {
            $data['amount'] = $service->price;
        }
        
        // Set creation date if not provided
        if (!isset($data['creation_date'])) {
            $data['creation_date'] = now();
        }
        
        // Set status to pending if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }
        
        // Create the booking
        $booking = $this->bookingRepository->createBooking($data);
        
        // Here we would trigger events for notifications, etc.
        // event(new BookingCreated($booking));
        
        return $booking;
    }

    public function updateBooking($id, array $data)
    {
        return $this->bookingRepository->updateBooking($id, $data);
    }

    public function confirmBooking($id)
    {
        $booking = $this->bookingRepository->confirmBooking($id);
        
        // Here we would trigger events for notifications, etc.
        // event(new BookingConfirmed($booking));
        
        return $booking;
    }

    public function cancelBooking($id)
    {
        $booking = $this->bookingRepository->cancelBooking($id);
        
        // Here we would trigger events for notifications, etc.
        // event(new BookingCancelled($booking));
        
        return $booking;
    }

    public function completeBooking($id)
    {
        $booking = $this->bookingRepository->completeBooking($id);
        
        // Here we would trigger events for notifications, gamification, etc.
        // event(new BookingCompleted($booking));
        
        return $booking;
    }

    public function getBookingsByClientForProvider($clientId, $providerId)
    {
        // Find bookings where the client is the user and the service belongs to the provider
        $serviceIds = $this->serviceRepository
            ->getServicesByUser($providerId)
            ->pluck('id')
            ->toArray();
        
        if (empty($serviceIds)) {
            return collect(); // Return empty collection if provider has no services
        }
        
        // Since there's no direct method in the repository, we'll query the model directly
        return \App\Models\Booking::where('user_id', $clientId)
            ->whereIn('service_id', $serviceIds)
            ->with(['service', 'user'])
            ->latest()
            ->get();
    }

    public function getAvailableTimeSlots($serviceId, $date)
    {
        return $this->availabilityRepository->getAvailableTimeSlots($serviceId, $date);
    }
}
