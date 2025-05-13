<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get completed bookings
        $completedBookings = Booking::where('status', 'completed')->get();
        
        // Get all services with their providers
        $services = Service::with('user')->get();
        
        if ($completedBookings->isEmpty()) {
            return;
        }

        // Create ratings for completed bookings
        foreach ($completedBookings as $booking) {
            // 80% chance of getting a rating
            if (rand(1, 100) <= 80) {
                $score = rand(3, 5); // Most ratings are positive (3-5 stars)
                $comments = [
                    "Great service! Would recommend.",
                    "The provider was professional and on time.",
                    "Satisfied with the quality of service.",
                    "Excellent work, exceeded my expectations.",
                    "Good job, will hire again.",
                    "Very knowledgeable and helpful.",
                    "Prompt service and good communication.",
                    "Reasonable price for the quality provided.",
                    "The provider was friendly and efficient.",
                    "Highly recommended for anyone in need of this service."
                ];
                
                // Rating date should be after booking date
                $ratingDate = Carbon::parse($booking->booking_date)->addDays(rand(1, 7));
                
                // Create the client's rating
                $rating = Rating::create([
                    'user_id' => $booking->user_id,
                    'service_id' => $booking->service_id,
                    'score' => $score,
                    'comment' => $comments[array_rand($comments)],
                    'rating_date' => $ratingDate,
                    'created_at' => $ratingDate,
                    'updated_at' => $ratingDate,
                ]);
                
                // 60% chance of getting a provider reply
                if (rand(1, 100) <= 60) {
                    $providerReplies = [
                        "Thank you for your feedback!",
                        "I appreciate your kind words.",
                        "Thanks for choosing our service.",
                        "It was a pleasure working with you.",
                        "Glad you were satisfied with our service.",
                        "We aim to provide the best quality service.",
                        "Thank you for your business!",
                        "Looking forward to serving you again.",
                        "Your satisfaction is our priority.",
                        "We value your feedback."
                    ];
                    
                    // Provider reply date should be after client rating date
                    $replyDate = Carbon::parse($ratingDate)->addDays(rand(1, 3));
                    
                    // Get the provider ID from the service
                    $service = $services->firstWhere('id', $booking->service_id);
                    $providerId = $service ? $service->user_id : null;
                    
                    if ($providerId) {
                        // Create the provider's reply
                        Rating::create([
                            'user_id' => $providerId,
                            'service_id' => $booking->service_id,
                            'score' => 5, // Not relevant for replies
                            'comment' => $providerReplies[array_rand($providerReplies)],
                            'rating_date' => $replyDate,
                            'reply_id' => $rating->id,
                            'created_at' => $replyDate,
                            'updated_at' => $replyDate,
                        ]);
                    }
                }
            }
        }
    }
}