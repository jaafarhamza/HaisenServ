<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all active services
        $services = Service::where('status', 'active')->get();
        
        if ($services->isEmpty()) {
            return;
        }

        // For each service, create availability slots for the next 30 days
        foreach ($services as $service) {
            // Generate availabilities for the next 30 days
            for ($day = 0; $day < 30; $day++) {
                $date = Carbon::now()->addDays($day);
                
                // Skip some random days (weekends or random days off)
                if ($date->isWeekend() && rand(0, 100) < 70) {
                    continue; // 70% chance to skip weekends
                }
                
                if (rand(0, 100) < 20) {
                    continue; // 20% chance to skip any day (day off)
                }
                
                // Create 1-3 availability slots for this day
                $numSlots = rand(1, 3);
                
                for ($slot = 0; $slot < $numSlots; $slot++) {
                    // Generate random start time between 8 AM and 6 PM
                    $startHour = rand(8, 18);
                    
                    // Duration between 1-4 hours
                    $duration = rand(1, 4);
                    
                    // Create start and end times
                    $startTime = (clone $date)->setHour($startHour)->setMinute(0)->setSecond(0);
                    $endTime = (clone $startTime)->addHours($duration);
                    
                    // Ensure end time is not after 10 PM
                    if ($endTime->hour > 22) {
                        $endTime = (clone $date)->setHour(22)->setMinute(0)->setSecond(0);
                    }
                    
                    // Create availability
                    Availability::create([
                        'service_id' => $service->id,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}