<?php

namespace Database\Seeders;

use App\Models\Gamification;
use App\Models\User;
use Illuminate\Database\Seeder;

class GamificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();
        
        foreach ($users as $user) {
            // Create gamification record for each user with random points and level
            Gamification::create([
                'user_id' => $user->id,
                'points' => rand(0, 1500),
                'level' => rand(1, 5),
                'update_date' => now()->subDays(rand(0, 30))
            ]);
        }
    }
}