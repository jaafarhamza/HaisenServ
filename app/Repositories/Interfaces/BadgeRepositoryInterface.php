<?php

namespace App\Repositories\Interfaces;

interface BadgeRepositoryInterface
{
    public function getAllBadges();
    public function getBadgeById($id);
    public function getBadgeByName($name);
    public function createBadge(array $data);
    public function updateBadge($id, array $data);
    public function deleteBadge($id);
    public function getUserBadges($userId);
    public function assignBadgeToUser($badgeId, $userId);
    public function removeBadgeFromUser($badgeId, $userId);
    public function userHasBadge($userId, $badgeId);
}
