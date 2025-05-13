<?php

namespace App\Repositories;

use App\Models\Gamification;
use App\Models\User;
use App\Repositories\Interfaces\GamificationRepositoryInterface;

class GamificationRepository implements GamificationRepositoryInterface
{
    public function getGamificationById($id)
    {
        return Gamification::findOrFail($id);
    }

    public function getGamificationByUser($userId)
    {
        return Gamification::where('user_id', $userId)->first();
    }

    public function createGamification(array $data)
    {
        if (!isset($data['update_date'])) {
            $data['update_date'] = now();
        }
        
        return Gamification::create($data);
    }

    public function updateGamification($id, array $data)
    {
        $gamification = $this->getGamificationById($id);
        
        if (!isset($data['update_date'])) {
            $data['update_date'] = now();
        }
        
        $gamification->update($data);
        return $gamification;
    }

    public function addPoints($userId, $points)
    {
        $gamification = $this->getGamificationByUser($userId);
        
        if (!$gamification) {
            // Create new gamification record if it doesn't exist
            return $this->createGamification([
                'user_id' => $userId,
                'points' => $points,
                'level' => 1,
                'update_date' => now()
            ]);
        }
        
        // Update existing record
        $gamification->points += $points;
        $gamification->update_date = now();
        $gamification->save();
        
        return $gamification;
    }

    public function updateLevel($userId, $level)
    {
        $gamification = $this->getGamificationByUser($userId);
        
        if (!$gamification) {
            // Create new gamification record if it doesn't exist
            return $this->createGamification([
                'user_id' => $userId,
                'points' => 0,
                'level' => $level,
                'update_date' => now()
            ]);
        }
        
        // Update existing record
        $gamification->level = $level;
        $gamification->update_date = now();
        $gamification->save();
        
        return $gamification;
    }

    public function getUsersByLevel($level)
    {
        return User::whereHas('gamification', function ($query) use ($level) {
            $query->where('level', $level);
        })->get();
    }

    public function getTopUsers($limit = 10)
    {
        return User::whereHas('gamification')
            ->with('gamification')
            ->get()
            ->sortByDesc(function ($user) {
                return $user->gamification->points;
            })
            ->take($limit)
            ->values();
    }
}
