<?php

namespace App\Services;

use App\Repositories\Interfaces\BadgeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class BadgeService
{
    protected $badgeRepository;
    protected $userRepository;

    public function __construct(
        BadgeRepositoryInterface $badgeRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->badgeRepository = $badgeRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllBadges()
    {
        return $this->badgeRepository->getAllBadges();
    }

    public function getBadgeById($id)
    {
        return $this->badgeRepository->getBadgeById($id);
    }
    
    public function getBadgeByName($name)
    {
        return $this->badgeRepository->getBadgeByName($name);
    }

    public function createBadge(array $data)
    {
        return $this->badgeRepository->createBadge($data);
    }

    public function updateBadge($id, array $data)
    {
        return $this->badgeRepository->updateBadge($id, $data);
    }

    public function deleteBadge($id)
    {
        // Check if any users have this badge
        $users = $this->getUsersWithBadge($id);
        
        if ($users->isNotEmpty()) {
            // Remove the badge from all users first
            foreach ($users as $user) {
                $this->badgeRepository->removeBadgeFromUser($id, $user->id);
            }
        }
        
        return $this->badgeRepository->deleteBadge($id);
    }

    public function getUserBadges($userId)
    {
        return $this->badgeRepository->getUserBadges($userId);
    }

    public function getUsersWithBadge($badgeId)
    {
        // Get all users that have this badge
        $users = $this->userRepository->getAllUsers()->filter(function ($user) use ($badgeId) {
            return $this->badgeRepository->userHasBadge($user->id, $badgeId);
        });
        
        return $users;
    }

    public function awardBadgeToUser($badgeId, $userId)
    {
        // Check if user already has this badge
        if ($this->badgeRepository->userHasBadge($userId, $badgeId)) {
            return false;
        }
        
        return $this->badgeRepository->assignBadgeToUser($badgeId, $userId);
    }

    public function removeBadgeFromUser($badgeId, $userId)
    {
        return $this->badgeRepository->removeBadgeFromUser($badgeId, $userId);
    }
}
