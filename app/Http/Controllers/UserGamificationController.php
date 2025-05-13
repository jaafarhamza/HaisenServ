<?php

namespace App\Http\Controllers;

use App\Services\GamificationService;
use App\Services\BadgeService;
use Illuminate\Http\Request;

class UserGamificationController extends Controller
{
    protected $gamificationService;
    protected $badgeService;

    public function __construct(GamificationService $gamificationService, BadgeService $badgeService)
    {
        $this->gamificationService = $gamificationService;
        $this->badgeService = $badgeService;
    }

    /**
     * Display the user's gamification profile.
     */
    public function index()
    {
        $userId = auth()->id();
        
        // Get the user's gamification data
        $gamification = $this->gamificationService->getGamificationByUser($userId);
        
        // If the user doesn't have gamification data yet, create it
        if (!$gamification) {
            $gamification = $this->gamificationService->addPoints($userId, 'registration', 0);
        }
        
        // Get the user's badges
        $badges = $this->badgeService->getUserBadges($userId);
        
        // Get the leaderboard position
        $topUsers = $this->gamificationService->getTopUsers(100);
        $leaderboardPosition = $topUsers->search(function ($user) use ($userId) {
            return $user->id === $userId;
        }) + 1; // +1 because array indices start at 0
        
        // Get the top 10 users for the leaderboard
        $leaderboard = $topUsers->take(10);
        
        return view('gamification.index', compact('gamification', 'badges', 'leaderboardPosition', 'leaderboard'));
    }

    /**
     * Display the user's badges.
     */
    public function badges()
    {
        $userId = auth()->id();
        
        // Get the user's badges
        $userBadges = $this->badgeService->getUserBadges($userId);
        
        // Get all available badges
        $allBadges = $this->badgeService->getAllBadges();
        
        // Determine which badges the user doesn't have yet
        $userBadgeIds = $userBadges->pluck('id')->toArray();
        $availableBadges = $allBadges->filter(function ($badge) use ($userBadgeIds) {
            return !in_array($badge->id, $userBadgeIds);
        });
        
        return view('gamification.badges', compact('userBadges', 'availableBadges'));
    }

    /**
     * Display the leaderboard.
     */
    public function leaderboard()
    {
        $userId = auth()->id();
        
        // Get the top 100 users
        $topUsers = $this->gamificationService->getTopUsers(100);
        
        // Get the user's position
        $userPosition = $topUsers->search(function ($user) use ($userId) {
            return $user->id === $userId;
        }) + 1; // +1 because array indices start at 0
        
        return view('gamification.leaderboard', compact('topUsers', 'userPosition'));
    }
}
