<?php

namespace App\Repositories\Interfaces;

interface RatingRepositoryInterface
{
    public function getAllRatings();
    public function getRatingById($id);
    public function getRatingsByUser($userId);
    public function getRatingsByService($serviceId);
    public function createRating(array $data);
    public function updateRating($id, array $data);
    public function deleteRating($id);
    public function getRepliesForRating($ratingId);
    public function createReply(array $data);
    public function getAverageRatingForService($serviceId);
    public function getAverageRatingForProvider($providerId);
}
