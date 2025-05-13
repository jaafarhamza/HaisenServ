<?php

namespace App\Repositories;

use App\Models\Badge;
use App\Models\User;
use App\Repositories\Interfaces\BadgeRepositoryInterface;

class BadgeRepository implements BadgeRepositoryInterface
{
    public function getAllBadges()
    {
        return Badge::all();
    }

    public function getBadgeById($id)
    {
        return Badge::findOrFail($id);
    }

    public function getBadgeByName($name)
    {
        return Badge::where('name', $name)->first();
    }

    public function createBadge(array $data)
    {
        return Badge::create($data);
    }

    public function updateBadge($id, array $data)
    {
        $badge = $this->getBadgeById($id);
        $badge->update($data);
        return $badge;
    }

    public function deleteBadge($id)
    {
        $badge = $this->getBadgeById($id);
        $badge->delete();
        return true;
    }

    public function getUserBadges($userId)
    {
        $user = User::findOrFail($userId);
        return $user->badges;
    }

    public function assignBadgeToUser($badgeId, $userId)
    {
        $user = User::findOrFail($userId);
        
        // Check if user already has this badge
        if (!$this->userHasBadge($userId, $badgeId)) {
            $user->badges()->attach($badgeId, ['earned_date' => now()]);
            return true;
        }
        
        return false;
    }

    public function removeBadgeFromUser($badgeId, $userId)
    {
        $user = User::findOrFail($userId);
        $user->badges()->detach($badgeId);
        return true;
    }

    public function userHasBadge($userId, $badgeId)
    {
        $user = User::findOrFail($userId);
        return $user->badges()->where('badge_id', $badgeId)->exists();
    }
}
