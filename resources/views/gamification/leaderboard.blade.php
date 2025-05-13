@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Leaderboard</h1>
            <a href="{{ route('gamification.profile') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Gamification
            </a>
        </div>

        <!-- Top Users Podium -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 text-center">Top Performers</h2>
            
            <div class="flex flex-col sm:flex-row justify-center items-end gap-4 sm:gap-8 mb-6">
                @if(isset($topUsers[1]))
                    <!-- 2nd Place -->
                    <div class="flex flex-col items-center order-1 sm:order-1">
                        <div class="relative">
                            @if($topUsers[1]->avatar)
                                <img src="{{ asset('storage/' . $topUsers[1]->avatar) }}" alt="{{ $topUsers[1]->name }}" class="h-20 w-20 rounded-full object-cover border-4 border-gray-300 dark:border-gray-600">
                            @else
                                <div class="h-20 w-20 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center border-4 border-gray-300 dark:border-gray-600">
                                    <i class="fas fa-user text-2xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                            @endif
                            <div class="absolute -bottom-2 -right-2 h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center border-2 border-white dark:border-gray-800">
                                <span class="text-gray-800 dark:text-gray-200 font-bold">2</span>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $topUsers[1]->name }}</h3>
                            <p class="text-primary text-sm">Level {{ $topUsers[1]->gamification->level }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">{{ number_format($topUsers[1]->gamification->points) }} pts</p>
                        </div>
                        <div class="h-24 w-full max-w-[100px] bg-gray-300 dark:bg-gray-600 rounded-t-lg mt-4"></div>
                    </div>
                @endif
                
                @if(isset($topUsers[0]))
                    <!-- 1st Place -->
                    <div class="flex flex-col items-center order-0 sm:order-2">
                        <div class="relative">
                            <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                                <i class="fas fa-crown text-3xl text-yellow-400"></i>
                            </div>
                            @if($topUsers[0]->avatar)
                                <img src="{{ asset('storage/' . $topUsers[0]->avatar) }}" alt="{{ $topUsers[0]->name }}" class="h-24 w-24 rounded-full object-cover border-4 border-yellow-400">
                            @else
                                <div class="h-24 w-24 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center border-4 border-yellow-400">
                                    <i class="fas fa-user text-3xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                            @endif
                            <div class="absolute -bottom-2 -right-2 h-8 w-8 rounded-full bg-yellow-400 flex items-center justify-center border-2 border-white dark:border-gray-800">
                                <span class="text-gray-800 font-bold">1</span>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $topUsers[0]->name }}</h3>
                            <p class="text-primary text-sm">Level {{ $topUsers[0]->gamification->level }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">{{ number_format($topUsers[0]->gamification->points) }} pts</p>
                        </div>
                        <div class="h-32 w-full max-w-[100px] bg-yellow-400 rounded-t-lg mt-4"></div>
                    </div>
                @endif
                
                @if(isset($topUsers[2]))
                    <!-- 3rd Place -->
                    <div class="flex flex-col items-center order-2 sm:order-3">
                        <div class="relative">
                            @if($topUsers[2]->avatar)
                                <img src="{{ asset('storage/' . $topUsers[2]->avatar) }}" alt="{{ $topUsers[2]->name }}" class="h-20 w-20 rounded-full object-cover border-4 border-amber-700 dark:border-amber-800">
                            @else
                                <div class="h-20 w-20 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center border-4 border-amber-700 dark:border-amber-800">
                                    <i class="fas fa-user text-2xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                            @endif
                            <div class="absolute -bottom-2 -right-2 h-8 w-8 rounded-full bg-amber-700 dark:bg-amber-800 flex items-center justify-center border-2 border-white dark:border-gray-800">
                                <span class="text-white font-bold">3</span>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $topUsers[2]->name }}</h3>
                            <p class="text-primary text-sm">Level {{ $topUsers[2]->gamification->level }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">{{ number_format($topUsers[2]->gamification->points) }} pts</p>
                        </div>
                        <div class="h-16 w-full max-w-[100px] bg-amber-700 dark:bg-amber-800 rounded-t-lg mt-4"></div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Full Leaderboard -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Global Leaderboard</h2>
                    <div>
                        <select id="leaderboard-filter" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-primary text-sm">
                            <option value="all">All Users</option>
                            <option value="providers">Providers</option>
                            <option value="clients">Clients</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Rank
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Level
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Points
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Badges
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($allUsers as $index => $user)
                            <tr class="{{ $user->id === auth()->id() ? 'bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($index < 3)
                                            <div class="flex-shrink-0 h-6 w-6 rounded-full {{ $index === 0 ? 'bg-yellow-400' : ($index === 1 ? 'bg-gray-300 dark:bg-gray-600' : 'bg-amber-700 dark:bg-amber-800') }} flex items-center justify-center mr-2">
                                                <span class="text-xs font-medium text-gray-900 dark:text-white">{{ $index + 1 }}</span>
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mr-2">
                                                <span class="text-xs font-medium text-gray-900 dark:text-white">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full">
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $user->name }}
                                                @if($user->id === auth()->id())
                                                    <span class="ml-2 text-xs text-primary">(You)</span>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $user->isProvider() ? 'Provider' : 'Client' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mr-2">
                                            <span class="text-xs font-medium text-primary">{{ $user->gamification->level }}</span>
                                        </div>
                                        <span class="text-sm text-gray-900 dark:text-white">{{ $levelNames[$user->gamification->level] ?? 'Explorer' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ number_format($user->gamification->points) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex -space-x-2">
                                        @forelse($user->badges->take(3) as $badge)
                                            <div class="h-8 w-8 rounded-full bg-primary bg-opacity-10 border-2 border-white dark:border-gray-800 flex items-center justify-center" title="{{ $badge->name }}">
                                                <i class="fas {{ $badge->icon_class ?? 'fa-award' }} text-xs text-primary"></i>
                                            </div>
                                        @empty
                                            <span class="text-sm text-gray-500 dark:text-gray-400">No badges</span>
                                        @endforelse
                                        
                                        @if($user->badges->count() > 3)
                                            <div class="h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-700 border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                                <span class="text-xs text-gray-600 dark:text-gray-400">+{{ $user->badges->count() - 3 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $allUsers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterSelect = document.getElementById('leaderboard-filter');
        
        filterSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const currentUrl = new URL(window.location.href);
            
            if (selectedValue === 'all') {
                currentUrl.searchParams.delete('filter');
            } else {
                currentUrl.searchParams.set('filter', selectedValue);
            }
            
            window.location.href = currentUrl.toString();
        });
        
        // Set initial filter value based on URL
        const urlParams = new URLSearchParams(window.location.search);
        const filterParam = urlParams.get('filter');
        
        if (filterParam) {
            filterSelect.value = filterParam;
        }
    });
</script>
@endpush