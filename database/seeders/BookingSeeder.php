<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get client users
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->get();

        // Get all services
        $services = Service::where('status', 'active')->get();
        
        // Skip if no services or clients
        if ($services->isEmpty() || $clients->isEmpty()) {
            return;
        }

        // Create bookings with different statuses
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        
        // Create 30 random bookings
        for ($i = 0; $i < 30; $i++) {
            $client = $clients->random();
            $service = $services->random();
            $status = $statuses[array_rand($statuses)];
            
            // Generate random booking date within the last 60 days to 30 days in future
            $bookingDate = Carbon::now()->subDays(rand(-30, 60))->setHour(rand(8, 20))->setMinute(0)->setSecond(0);
            
            // Creation date should be before booking date
            $creationDate = (clone $bookingDate)->subDays(rand(1, 30));
            
            Booking::create([
                'user_id' => $client->id,
                'service_id' => $service->id,
                'booking_date' => $bookingDate,
                'status' => $status,
                'amount' => $service->price,
                'creation_date' => $creationDate,
                'created_at' => $creationDate,
                'updated_at' => $creationDate,
            ]);
        }
    }
}