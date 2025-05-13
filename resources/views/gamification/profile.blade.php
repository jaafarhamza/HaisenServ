@extends('layouts.app')

@section('title', 'Gamification Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Your Gamification Profile</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Level and Points Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 col-span-1 md:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">Level {{ $gamification->level }}</h2>
                        <p class="text-gray-500 dark:text-gray-400">{{ $levelNames[$gamification->level] ?? 'Explorer' }}</p>
                    </div>
                    <div class="h-20 w-20 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                        <i class="fas {{ $levelIcons[$gamification->level] ?? 'fa-user' }} text-4xl text-primary"></i>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Progress to Level {{ $gamification->level + 1 }}</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pointsToNextLevel > 0 ? $pointsToNextLevel . ' points to go' : 'Max level reached!' }}</span>
                    </div>
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-primary" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <h3 class="text-2xl font-bold text-primary mb-1">{{ $gamification->points }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Points</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <h3 class="text-2xl font-bold text-secondary mb-1">{{ count($userBadges) }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Badges Earned</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <h3 class="text-2xl font-bold text-accent mb-1">{{ $leaderboardPosition }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Leaderboard Rank</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Benefits</h2>
                
                <div class="space-y-4">
                    @foreach($levelBenefits as $benefit)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-5 w-5 {{ $gamification->level >= $benefit['level'] ? 'text-green-500' : 'text-gray-300 dark:text-gray-600' }}">
                                <i class="fas {{ $gamification->level >= $benefit['level'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium {{ $gamification->level >= $benefit['level'] ? 'text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400' }}">
                                    {{ $benefit['name'] }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Level {{ $benefit['level'] }} required
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Badges -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Your Badges</h2>
                    <a href="{{ route('gamification.user-badges') }}" class="text-primary hover:text-primary-light">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                @if(count($userBadges) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach($userBadges as $badge)
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-2">
                                    <i class="fas {{ $badge->icon_class ?? 'fa-award' }} text-2xl text-primary"></i>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white text-center">{{ $badge->name }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $badge->pivot->earned_date ? \Carbon\Carbon::parse($badge->pivot->earned_date)->format('M d, Y') : 'Earned' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="h-20 w-20 mx-auto bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-award text-3xl text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Badges Yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            Complete activities on the platform to earn badges
                        </p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Activity</h2>
            </div>
            
            <div class="p-6">
                @if(count($recentActivities) > 0)
                    <div class="space-y-6">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-start">
                                <div class="h-10 w-10 rounded-full bg-{{ $activity['color'] }}-100 text-{{ $activity['color'] }}-600 dark:bg-{{ $activity['color'] }}-900 dark:bg-opacity-30 dark:text-{{ $activity['color'] }}-400 flex items-center justify-center mr-4">
                                    <i class="fas {{ $activity['icon'] }}"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $activity['title'] }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $activity['description'] }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $activity['date']->diffForHumans() }} • {{ $activity['points'] }} points earned
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="h-20 w-20 mx-auto bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-history text-3xl text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Activity Yet</h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            Your recent activities will appear here
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection