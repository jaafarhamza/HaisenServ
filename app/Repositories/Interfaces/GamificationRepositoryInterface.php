<?php

namespace App\Repositories\Interfaces;

interface GamificationRepositoryInterface
{
    public function getGamificationById($id);
    public function getGamificationByUser($userId);
    public function createGamification(array $data);
    public function updateGamification($id, array $data);
    public function addPoints($userId, $points);
    public function updateLevel($userId, $level);
    public function getUsersByLevel($level);
    public function getTopUsers($limit = 10);
}
