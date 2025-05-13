@extends('provider.layouts.app')

@section('title', 'Reply to Review')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Reply to Review</h1>
            <a href="{{ route('provider.ratings.index') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Reviews
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Original Review -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Original Review</h2>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <div class="h-12 w-12 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                                @if($rating->user->avatar)
                                    <img src="{{ asset('storage/' . $rating->user->avatar) }}" alt="{{ $rating->user->name }}" class="h-full w-full object-cover rounded-full">
                                @else
                                    <i class="fas fa-user text-xl text-gray-400 dark:text-gray-500"></i>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center mb-1">
                                    <h3 class="font-medium text-gray-900 dark:text-white mr-2">{{ $rating->user->name }}</h3>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }} text-sm"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    For: <span class="font-medium">{{ $rating->service->title }}</span> • {{ $rating->rating_date->format('M d, Y') }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">{{ $rating->comment }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reply Form -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Your Reply</h2>
                    
                    <form action="{{ route('provider.ratings.store-reply', $rating->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <textarea id="comment" name="comment" rows="5" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Write your reply to this review..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('provider.ratings.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Submit Reply
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Tips Section -->
                <div class="mt-8 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 p-4 rounded-lg border-l-4 border-blue-500">
                    <h3 class="text-md font-medium text-gray-900 dark:text-white mb-2">Tips for Responding to Reviews</h3>
                    <ul class="text-sm text-gray-600 dark:text-gray-300 list-disc list-inside space-y-1">
                        <li>Always thank the client for their feedback, even if it's negative</li>
                        <li>Address specific points mentioned in the review</li>
                        <li>Keep your response professional and courteous</li>
                        <li>If there was an issue, explain what you've learned or how you'll improve</li>
                        <li>Keep your response concise and to the point</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection