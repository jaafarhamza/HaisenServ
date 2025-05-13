@extends('layouts.app')

@section('title', 'Your Badges')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Your Badges</h1>
            <a href="{{ route('gamification.profile') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Gamification
            </a>
        </div>

        <!-- Badges Categories -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md mb-8">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">All Badges</h2>
                    <span class="px-4 py-1 bg-primary bg-opacity-10 text-primary text-sm rounded-full">
                        {{ count($userBadges) }} / {{ count($allBadges) }} Earned
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Earned Badges -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Earned Badges</h3>
                    
                    @if(count($userBadges) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($userBadges as $badge)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 flex flex-col items-center">
                                    <div class="h-16 w-16 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-3">
                                        <i class="fas {{ $badge->icon_class ?? 'fa-award' }} text-2xl text-primary"></i>
                                    </div>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white text-center mb-1">{{ $badge->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-2">{{ $badge->description }}</p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        Earned on {{ \Carbon\Carbon::parse($badge->pivot->earned_date)->format('M d, Y') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-500 dark:text-gray-400">You haven't earned any badges yet. Complete activities to earn badges!</p>
                        </div>
                    @endif
                </div>
                
                <!-- Available Badges -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Available Badges</h3>
                    
                    @php
                        $userBadgeIds = $userBadges->pluck('id')->toArray();
                        $availableBadges = $allBadges->whereNotIn('id', $userBadgeIds);
                    @endphp
                    
                    @if(count($availableBadges) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($availableBadges as $badge)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 flex flex-col items-center opacity-70">
                                    <div class="h-16 w-16 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mb-3">
                                        <i class="fas {{ $badge->icon_class ?? 'fa-award' }} text-2xl text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white text-center mb-1">{{ $badge->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-2">{{ $badge->description }}</p>
                                    <span class="text-xs text-primary dark:text-primary-light">
                                        <i class="fas fa-lock mr-1"></i> Locked
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-500 dark:text-gray-400">Congratulations! You've earned all available badges.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Badge Tips -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">How to Earn Badges</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 p-4 rounded-lg">
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                            <i class="fas fa-user-check text-blue-500"></i>
                        </div>
                        <div>
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Complete Your Profile</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Fill out all sections of your profile, including a profile picture and bio.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900 dark:bg-opacity-20 p-4 rounded-lg">
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-check text-green-500"></i>
                        </div>
                        <div>
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Make Bookings</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Book services and complete them to earn booking-related badges.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-purple-50 dark:bg-purple-900 dark:bg-opacity-20 p-4 rounded-lg">
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-3">
                            <i class="fas fa-star text-purple-500"></i>
                        </div>
                        <div>
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Leave Reviews</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Rate and review services you've used to earn reviewer badges.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 p-4 rounded-lg">
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center mr-3">
                            <i class="fas fa-medal text-yellow-500"></i>
                        </div>
                        <div>
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Reach Higher Levels</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Earn points through platform activity to level up and unlock level badges.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection