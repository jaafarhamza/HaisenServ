<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();
        
        if ($users->count() < 2) {
            return;
        }

        // Create 50 random conversations
        for ($i = 0; $i < 20; $i++) {
            // Pick two random users for conversation
            $user1 = $users->random();
            $user2 = $users->random();
            
            // Ensure we don't have the same user talking to themselves
            while ($user1->id === $user2->id) {
                $user2 = $users->random();
            }
            
            // Generate random number of messages for this conversation (2-10)
            $messageCount = rand(2, 10);
            
            // Starting date for conversation (within last 30 days)
            $startDate = Carbon::now()->subDays(rand(0, 30))->setHour(rand(8, 22))->setMinute(rand(0, 59));
            $currentDate = clone $startDate;
            
            // Default message templates
            $clientMessages = [
                "Hi, I'm interested in your {SERVICE} service. Are you available?",
                "What's your rate for {SERVICE}?",
                "Do you provide {SERVICE} in my area?",
                "I need {SERVICE} as soon as possible. Can you help?",
                "I have a question about your {SERVICE} service.",
                "How long would it take to complete {SERVICE}?",
                "I'd like to book your {SERVICE} service.",
                "Can you provide a quote for {SERVICE}?",
                "What's included in your {SERVICE} package?",
                "I've used your services before and would like to book again."
            ];
            
            $providerMessages = [
                "Hello! Yes, I'm available for {SERVICE}. When do you need it?",
                "Thanks for your interest! My rate for {SERVICE} is \$XX per hour.",
                "Yes, I provide {SERVICE} in your area. What's your location?",
                "I'd be happy to help with {SERVICE}. What specifically do you need?",
                "I have availability this week for {SERVICE}. Would that work for you?",
                "For {SERVICE}, it usually takes about X days to complete.",
                "I'd be delighted to help you with {SERVICE}!",
                "I'll send you a detailed quote for {SERVICE} shortly.",
                "The {SERVICE} package includes X, Y, and Z.",
                "Great to hear from you again! Yes, I'm available for booking."
            ];
            
            $followupMessages = [
                "Perfect, thank you!",
                "That sounds good to me.",
                "Great, let's proceed.",
                "Thanks for the information.",
                "I appreciate your quick response.",
                "Excellent, looking forward to it.",
                "That works for me.",
                "Thanks for your help!",
                "Let me check my schedule and get back to you.",
                "I'll confirm and book right away."
            ];
            
            // Determine who starts the conversation
            $currentSender = rand(0, 1) === 0 ? $user1 : $user2;
            $currentRecipient = $currentSender->id === $user1->id ? $user2 : $user1;
            
            // Create messages for this conversation
            for ($j = 0; $j < $messageCount; $j++) {
                // Select message template based on sender and position in conversation
                if ($j === 0) {
                    // First message typically from client
                    $messageContent = $clientMessages[array_rand($clientMessages)];
                } else if ($j === 1) {
                    // Second message typically from provider
                    $messageContent = $providerMessages[array_rand($providerMessages)];
                } else {
                    // Followup messages
                    $messageContent = $followupMessages[array_rand($followupMessages)];
                }
                
                // Replace {SERVICE} placeholder with something generic
                $messageContent = str_replace('{SERVICE}', 'professional', $messageContent);
                
                // Create message
                Message::create([
                    'sender_id' => $currentSender->id,
                    'recipient_id' => $currentRecipient->id,
                    'content' => $messageContent,
                    'send_date' => $currentDate,
                    'read' => rand(0, 100) <= 70, // 70% chance of being read
                    'created_at' => $currentDate,
                    'updated_at' => $currentDate,
                ]);
                
                // Increment date by random minutes for next message
                $currentDate = $currentDate->addMinutes(rand(5, 120));
                
                // Switch sender and recipient for next message
                $tempSender = $currentSender;
                $currentSender = $currentRecipient;
                $currentRecipient = $tempSender;
            }
        }
    }
}