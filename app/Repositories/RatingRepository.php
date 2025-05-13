<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Models\Service;
use App\Repositories\Interfaces\RatingRepositoryInterface;

class RatingRepository implements RatingRepositoryInterface
{
    public function getAllRatings()
    {
        return Rating::with(['user', 'service'])->whereNull('reply_id')->latest()->get();
    }

    public function getRatingById($id)
    {
        return Rating::with(['user', 'service', 'replies'])->findOrFail($id);
    }

    public function getRatingsByUser($userId)
    {
        return Rating::where('user_id', $userId)
            ->whereNull('reply_id')
            ->with(['service', 'replies'])
            ->latest()
            ->get();
    }

    public function getRatingsByService($serviceId)
    {
        return Rating::where('service_id', $serviceId)
            ->whereNull('reply_id')
            ->with(['user', 'replies'])
            ->latest()
            ->get();
    }

    public function createRating(array $data)
    {
        if (!isset($data['rating_date'])) {
            $data['rating_date'] = now();
        }
        
        return Rating::create($data);
    }

    public function updateRating($id, array $data)
    {
        $rating = $this->getRatingById($id);
        $rating->update($data);
        return $rating;
    }

    public function deleteRating($id)
    {
        $rating = $this->getRatingById($id);
        $rating->delete();
        return true;
    }

    public function getRepliesForRating($ratingId)
    {
        return Rating::where('reply_id', $ratingId)
            ->with('user')
            ->latest()
            ->get();
    }

    public function createReply(array $data)
    {
        if (!isset($data['rating_date'])) {
            $data['rating_date'] = now();
        }
        
        return Rating::create($data);
    }

    public function getAverageRatingForService($serviceId)
    {
        return Rating::where('service_id', $serviceId)
            ->whereNull('reply_id')
            ->avg('score') ?? 0;
    }

    public function getAverageRatingForProvider($providerId)
    {
        return Rating::whereHas('service', function ($query) use ($providerId) {
                $query->where('user_id', $providerId);
            })
            ->whereNull('reply_id')
            ->avg('score') ?? 0;
    }
}
