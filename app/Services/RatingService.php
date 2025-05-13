<?php

namespace App\Services;

use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\Facades\Log;

class RatingService
{
    protected $ratingRepository;
    protected $serviceRepository;
    protected $userRepository;
    protected $bookingRepository;

    public function __construct(
        RatingRepositoryInterface $ratingRepository,
        ServiceRepositoryInterface $serviceRepository,
        UserRepositoryInterface $userRepository,
        BookingRepositoryInterface $bookingRepository
    ) {
        $this->ratingRepository = $ratingRepository;
        $this->serviceRepository = $serviceRepository;
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function getAllRatings()
    {
        return $this->ratingRepository->getAllRatings();
    }

    public function getRatingById($id)
    {
        return $this->ratingRepository->getRatingById($id);
    }

    public function getRatingsByUser($userId)
    {
        return $this->ratingRepository->getRatingsByUser($userId);
    }

    public function getRatingsByService($serviceId)
    {
        return $this->ratingRepository->getRatingsByService($serviceId);
    }

    public function createRating(array $data)
    {
        // Validate that the user has booked this service before rating
        $hasBooking = $this->bookingRepository->getBookingsByUser($data['user_id'])
            ->where('service_id', $data['service_id'])
            ->where('status', 'completed')
            ->isNotEmpty();
            
        if (!$hasBooking) {
            throw new \Exception('You can only rate services that you have used.');
        }
        
        // Create the rating
        $rating = $this->ratingRepository->createRating($data);
        
        // Update the service's average rating
        $this->updateServiceRating($data['service_id']);
        
        // Update the provider's average rating
        $service = $this->serviceRepository->getServiceById($data['service_id']);
        $this->updateProviderRating($service->user_id);
        
        return $rating;
    }

    public function updateRating($id, array $data)
    {
        $rating = $this->ratingRepository->updateRating($id, $data);
        
        // Update the service's average rating
        $this->updateServiceRating($rating->service_id);
        
        // Update the provider's average rating
        $service = $this->serviceRepository->getServiceById($rating->service_id);
        $this->updateProviderRating($service->user_id);
        
        return $rating;
    }

    public function deleteRating($id)
    {
        $rating = $this->ratingRepository->getRatingById($id);
        $serviceId = $rating->service_id;
        $service = $this->serviceRepository->getServiceById($serviceId);
        $providerId = $service->user_id;
        
        $deleted = $this->ratingRepository->deleteRating($id);
        
        // Update the service's average rating
        $this->updateServiceRating($serviceId);
        
        // Update the provider's average rating
        $this->updateProviderRating($providerId);
        
        return $deleted;
    }

    public function createReply(array $data)
    {
        // Validate that the user is the provider of the service being rated
        $rating = $this->ratingRepository->getRatingById($data['reply_id']);
        $service = $this->serviceRepository->getServiceById($rating->service_id);
        
        if ($service->user_id !== $data['user_id']) {
            throw new \Exception('Only the service provider can reply to this rating.');
        }
        
        // Create the reply
        return $this->ratingRepository->createReply($data);
    }

    public function getRepliesForRating($ratingId)
    {
        return $this->ratingRepository->getRepliesForRating($ratingId);
    }

    private function updateServiceRating($serviceId)
    {
        $avgRating = $this->ratingRepository->getAverageRatingForService($serviceId);
        
        // Update the service model
        $this->serviceRepository->updateService($serviceId, [
            'rating_average' => $avgRating
        ]);
        
        return $avgRating;
    }

    private function updateProviderRating($providerId)
    {
        $avgRating = $this->ratingRepository->getAverageRatingForProvider($providerId);
        
        // Update the user model
        $this->userRepository->updateUser($providerId, [
            'rating_average' => $avgRating
        ]);
        
        return $avgRating;
    }
}
