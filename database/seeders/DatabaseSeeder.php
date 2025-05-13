<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run core seeders first (if you haven't already run them)
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ServiceSeeder::class);
        
        // Run the new seeders
        $this->call([
            BadgeSeeder::class,
            GamificationSeeder::class,
            BookingSeeder::class,
            RatingSeeder::class,
            MessageSeeder::class,
            UserBadgeSeeder::class,
            AvailabilitySeeder::class,
        ]);
    }
}