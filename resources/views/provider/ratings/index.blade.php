@extends('provider.layouts.app')

@section('title', 'Manage Reviews')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Manage Reviews</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Rating Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center">
            <div class="h-14 w-14 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-star text-primary text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Average Rating</p>
                <div class="flex items-center">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mr-2">{{ number_format($averageRating, 1) }}</p>
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $averageRating)
                                <i class="fas fa-star text-yellow-400"></i>
                            @elseif($i - 0.5 <= $averageRating)
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                            @else
                                <i class="far fa-star text-yellow-400"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center">
            <div class="h-14 w-14 bg-green-500 bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-comment-alt text-green-500 text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Reviews</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ratingsCount }}</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center">
            <div class="h-14 w-14 bg-blue-500 bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-reply text-blue-500 text-2xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Response Rate</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $responseRate }}%</p>
            </div>
        </div>
    </div>

    <!-- Rating Distribution -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md mb-6 overflow-hidden">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Rating Distribution</h2>
            
            <div class="space-y-3">
                @for($i = 5; $i >= 1; $i--)
                    @php
                        $count = $ratingDistribution[$i] ?? 0;
                        $percentage = $ratingsCount > 0 ? ($count / $ratingsCount) * 100 : 0;
                    @endphp
                    <div class="flex items-center">
                        <div class="w-12 text-right mr-3">
                            <div class="flex items-center justify-end">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-1">{{ $i }}</span>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                        </div>
                        <div class="flex-grow h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-yellow-400" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="w-16 text-right ml-3 text-sm text-gray-500 dark:text-gray-400">{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Reviews List -->
    @if($ratings->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-star text-4xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Reviews Yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't received any reviews for your services yet.</p>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">All Reviews</h2>
            </div>
            
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($ratings as $rating)
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start">
                            <div class="sm:w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 sm:mb-0 flex-shrink-0">
                                @if($rating->user->avatar)
                                    <img src="{{ asset('storage/' . $rating->user->avatar) }}" alt="{{ $rating->user->name }}" class="h-full w-full object-cover rounded-lg">
                                @else
                                    <i class="fas fa-user text-4xl text-gray-400 dark:text-gray-500"></i>
                                @endif
                            </div>
                            <div class="sm:ml-6 flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                            {{ $rating->user->name }} <span class="text-sm font-normal text-gray-500 dark:text-gray-400">rated</span> {{ $rating->service->title }}
                                        </h3>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"></i>
                                            @endfor
                                            <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">{{ $rating->rating_date->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex">
                                        <a href="{{ route('provider.ratings.show', $rating->id) }}" class="text-primary hover:text-primary-light transition-colors">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                    <p class="text-gray-600 dark:text-gray-300">{{ $rating->comment }}</p>
                                </div>
                                
                                @if($rating->replies && $rating->replies->count() > 0)
                                    <div class="ml-6 pl-4 border-l-2 border-gray-200 dark:border-gray-700">
                                        @foreach($rating->replies as $reply)
                                            <div class="mb-2">
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Your reply on {{ $reply->rating_date->format('M d, Y') }}:
                                                </p>
                                                <p class="text-gray-600 dark:text-gray-300">{{ $reply->comment }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex">
                                        <a href="{{ route('provider.ratings.reply', $rating->id) }}" class="text-secondary hover:text-secondary-light transition-colors">
                                            <i class="fas fa-reply mr-1"></i> Reply to this review
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $ratings->links() }}
            </div>
        </div>
    @endif
</div>
@endsection