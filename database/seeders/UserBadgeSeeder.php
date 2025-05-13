<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserBadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and badges
        $users = User::all();
        $badges = Badge::all();
        
        // Assign random badges to users
        foreach ($users as $user) {
            // Each user gets 1-5 random badges
            $randomBadgeCount = rand(1, 5);
            $randomBadges = $badges->random($randomBadgeCount);
            
            foreach ($randomBadges as $badge) {
                // Random date within last 90 days
                $earnedDate = now()->subDays(rand(1, 90));
                
                // Attach badge to user with earned date
                $user->badges()->attach($badge->id, [
                    'earned_date' => $earnedDate,
                    'created_at' => $earnedDate,
                    'updated_at' => $earnedDate,
                ]);
            }
        }
    }
}