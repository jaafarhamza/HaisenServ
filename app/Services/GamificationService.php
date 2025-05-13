<?php

namespace App\Services;

use App\Repositories\Interfaces\GamificationRepositoryInterface;
use App\Repositories\Interfaces\BadgeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\RatingRepositoryInterface;
use Illuminate\Support\Facades\Log;

class GamificationService
{
    protected $gamificationRepository;
    protected $badgeRepository;
    protected $userRepository;
    protected $bookingRepository;
    protected $ratingRepository;

    // Define point values for different actions
    const POINTS = [
        'registration' => 10,
        'profile_completion' => 20,
        'first_booking' => 15,
        'service_booking' => 5,
        'service_completion' => 10,
        'rating_submitted' => 5,
        'receiving_5_star' => 10,
    ];

    // Define levels and their point thresholds
    const LEVELS = [
        1 => 0,      // Beginner
        2 => 50,     // Novice
        3 => 150,    // Regular
        4 => 300,    // Enthusiast
        5 => 500,    // Expert
        6 => 1000,   // Master
    ];

    public function __construct(
        GamificationRepositoryInterface $gamificationRepository,
        BadgeRepositoryInterface $badgeRepository,
        UserRepositoryInterface $userRepository,
        BookingRepositoryInterface $bookingRepository,
        RatingRepositoryInterface $ratingRepository
    ) {
        $this->gamificationRepository = $gamificationRepository;
        $this->badgeRepository = $badgeRepository;
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
        $this->ratingRepository = $ratingRepository;
    }

    public function getGamificationByUser($userId)
    {
        return $this->gamificationRepository->getGamificationByUser($userId);
    }

    public function addPoints($userId, $action, $customPoints = null, $description = null)
    {
        // Determine points to add
        $points = $customPoints ?? (self::POINTS[$action] ?? 0);
        
        // Add points to user's gamification record
        $gamification = $this->gamificationRepository->addPoints($userId, $points);
        
        // Check if the user should level up
        $this->checkLevelUp($userId, $gamification);
        
        // Check if the user has earned any badges
        $this->checkBadges($userId, $action, $gamification);
        
        return $gamification;
    }

    private function checkLevelUp($userId, $gamification)
    {
        $currentLevel = $gamification->level;
        $points = $gamification->points;
        
        // Find the highest level the user qualifies for
        $newLevel = $currentLevel;
        
        foreach (self::LEVELS as $level => $requiredPoints) {
            if ($points >= $requiredPoints && $level > $currentLevel) {
                $newLevel = $level;
            }
        }
        
        // Update level if there's a change
        if ($newLevel > $currentLevel) {
            $this->gamificationRepository->updateLevel($userId, $newLevel);
            
            // This would be a good place to dispatch an event
            // event(new UserLeveledUp($userId, $newLevel));
            
            return true;
        }
        
        return false;
    }

    private function checkBadges($userId, $action, $gamification)
    {
        // Define badge criteria based on actions and achievements
        $badgeCriteria = [
            'registration' => [
                'name' => 'New Member',
                'check' => function($userId) {
                    return true; // Always award for registration
                }
            ],
            'profile_completion' => [
                'name' => 'Identity Revealed',
                'check' => function($userId) {
                    $user = $this->userRepository->getUserById($userId);
                    return !empty($user->name) && 
                           !empty($user->email) && 
                           !empty($user->avatar) && 
                           !empty($user->bio);
                }
            ],
            'first_booking' => [
                'name' => 'First Booking',
                'check' => function($userId) {
                    return $this->bookingRepository->getBookingsByUser($userId)->count() === 1;
                }
            ],
            '5_bookings' => [
                'name' => 'Regular Client',
                'check' => function($userId) {
                    return $this->bookingRepository->getBookingsByUser($userId)->count() >= 5;
                }
            ],
            'first_rating' => [
                'name' => 'Reviewer',
                'check' => function($userId) {
                    return $this->ratingRepository->getRatingsByUser($userId)->count() === 1;
                }
            ],
            'level_up' => [
                'name' => 'Level Pioneer',
                'check' => function($userId) {
                    $gamification = $this->gamificationRepository->getGamificationByUser($userId);
                    return $gamification && $gamification->level >= 3;
                }
            ],
        ];
        
        // Additional level-specific badges
        if ($action == 'level_up') {
            $levelBadges = [
                2 => 'Apprentice',
                3 => 'Adept',
                4 => 'Expert',
                5 => 'Master',
                6 => 'Grandmaster',
            ];
            
            $currentLevel = $gamification->level;
            if (isset($levelBadges[$currentLevel])) {
                $badgeName = $levelBadges[$currentLevel];
                $this->awardBadge($userId, $badgeName);
            }
        }
        
        // Check for action-specific badges
        if (isset($badgeCriteria[$action])) {
            $criteria = $badgeCriteria[$action];
            if ($criteria['check']($userId)) {
                $this->awardBadge($userId, $criteria['name']);
            }
        }
        
        // Check for milestone badges that might be triggered by any action
        if ($action != 'registration') {
            if ($badgeCriteria['5_bookings']['check']($userId)) {
                $this->awardBadge($userId, $badgeCriteria['5_bookings']['name']);
            }
            
            // Add more milestone checks as needed
        }
    }

    private function awardBadge($userId, $badgeName)
    {
        // Find the badge by name
        $badge = $this->badgeRepository->getBadgeByName($badgeName);
        
        // If badge doesn't exist, create it (only in development)
        if (!$badge && config('app.env') === 'local') {
            $badge = $this->badgeRepository->createBadge([
                'name' => $badgeName,
                'description' => 'Automatically created badge: ' . $badgeName,
                'icon_url' => 'default_badge.png'
            ]);
        }
        
        if ($badge) {
            // Check if user already has this badge
            if (!$this->badgeRepository->userHasBadge($userId, $badge->id)) {
                $this->badgeRepository->assignBadgeToUser($badge->id, $userId);
                
                // This would be a good place to dispatch an event
                // event(new BadgeEarned($userId, $badge));
                
                return true;
            }
        }
        
        return false;
    }

    public function getTopUsers($limit = 10)
    {
        return $this->gamificationRepository->getTopUsers($limit);
    }

    public function getUsersByLevel($level)
    {
        return $this->gamificationRepository->getUsersByLevel($level);
    }
}
