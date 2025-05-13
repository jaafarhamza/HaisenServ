@extends('provider.layouts.app')

@section('title', 'Review Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Review Details</h1>
            <a href="{{ route('provider.ratings.index') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Reviews
            </a>
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

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Review Header -->
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row items-start">
                        <div class="sm:w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 sm:mb-0 flex-shrink-0">
                            @if($rating->user->avatar)
                                <img src="{{ asset('storage/' . $rating->user->avatar) }}" alt="{{ $rating->user->name }}" class="h-full w-full object-cover rounded-full">
                            @else
                                <i class="fas fa-user text-2xl text-gray-400 dark:text-gray-500"></i>
                            @endif
                        </div>
                        <div class="sm:ml-4 flex-grow">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $rating->user->name }} 
                                <span class="text-base font-normal text-gray-500 dark:text-gray-400">reviewed your service</span>
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400 mb-2">
                                {{ $rating->rating_date->format('F j, Y \a\t h:i A') }}
                            </p>
                            <div class="flex items-center">
                                <div class="flex mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-lg font-medium text-gray-900 dark:text-white">{{ $rating->score }}.0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-concierge-bell text-primary mr-2"></i>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Service</h3>
                    </div>
                    <div class="ml-6">
                        <p class="text-gray-900 dark:text-white font-medium">{{ $rating->service->title }}</p>
                        <p class="text-gray-500 dark:text-gray-400">{{ $rating->service->formatted_price }}</p>
                    </div>
                </div>

                <!-- Review Content -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Review</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300">{{ $rating->comment }}</p>
                    </div>
                </div>

                <!-- Replies -->
                @if($rating->replies && $rating->replies->count() > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Your Replies</h3>
                        
                        @foreach($rating->replies as $reply)
                            <div class="bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 rounded-lg p-4 mb-3 border-l-4 border-blue-500">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">You replied on {{ $reply->rating_date->format('M d, Y \a\t h:i A') }}</span>
                                    </div>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $reply->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Reply Form -->
                @if(!$rating->hasReply())
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Reply to this Review</h3>
                        
                        <form action="{{ route('provider.ratings.store-reply', $rating->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <textarea name="comment" rows="4" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Write your reply here..." required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                    Submit Reply
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Client Information -->
                <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Client Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $rating->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $rating->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Member Since</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $rating->user->created_at->format('M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Bookings</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $clientBookingsCount }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('messages.conversation', $rating->user_id) }}" class="inline-flex items-center text-primary hover:text-primary-light">
                            <i class="fas fa-envelope mr-2"></i> Message Client
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection