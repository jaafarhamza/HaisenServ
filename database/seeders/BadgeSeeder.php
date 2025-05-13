<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'New Member',
                'description' => 'Welcome to HaisenServ!',
                'icon_url' => '/badges/new-member.png',
            ],
            [
                'name' => 'First Booking',
                'description' => 'Completed your first service booking',
                'icon_url' => '/badges/first-booking.png',
            ],
            [
                'name' => 'Top Rated',
                'description' => 'Achieved an average rating above 4.5',
                'icon_url' => '/badges/top-rated.png',
            ],
            [
                'name' => 'Loyal Customer',
                'description' => 'Completed 5 service bookings',
                'icon_url' => '/badges/loyal-customer.png',
            ],
            [
                'name' => 'VIP Customer',
                'description' => 'Completed 10 service bookings',
                'icon_url' => '/badges/vip-customer.png',
            ],
            [
                'name' => 'Excellent Provider',
                'description' => 'Delivered 10 successful services',
                'icon_url' => '/badges/excellent-provider.png',
            ],
            [
                'name' => 'Master Provider',
                'description' => 'Maintained 4.8+ rating for 20+ services',
                'icon_url' => '/badges/master-provider.png',
            ],
            [
                'name' => 'Fast Responder',
                'description' => 'Responds to messages within 1 hour',
                'icon_url' => '/badges/fast-responder.png',
            ],
            [
                'name' => 'Community Leader',
                'description' => 'Helped other members with valuable advice',
                'icon_url' => '/badges/community-leader.png',
            ],
            [
                'name' => 'Service Superstar',
                'description' => 'Reached Level 5 on the platform',
                'icon_url' => '/badges/service-superstar.png',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}