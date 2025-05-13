@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit Your Review</h1>
            <p class="text-gray-600 dark:text-gray-400">Update your feedback for this service</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Service Details -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Service Details</h2>
                    <div class="flex flex-col sm:flex-row bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="sm:w-24 h-24 flex-shrink-0 bg-gray-200 dark:bg-gray-600 rounded-lg mb-4 sm:mb-0 flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-4xl text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <div class="sm:ml-4 flex-grow">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $rating->service->title }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                Provided by: {{ $rating->service->user->name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Review date: {{ $rating->rating_date->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Review Form -->
                <form action="{{ route('client.ratings.update', $rating->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Rating</label>
                        <div class="flex items-center" id="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-rating="{{ $i }}" class="star-btn text-3xl {{ $i <= $rating->score ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }} hover:text-yellow-400 focus:outline-none transition-colors">
                                    <i class="fas fa-star"></i>
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="score" id="rating-value" value="{{ old('score', $rating->score) }}" required>
                        @error('score')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Review</label>
                        <textarea id="comment" name="comment" rows="5" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>{{ old('comment', $rating->comment) }}</textarea>
                        @error('comment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="{{ route('client.ratings.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 mr-2 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                            Update Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starButtons = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-value');
        
        // Add click event to stars
        starButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                ratingInput.value = rating;
                updateStars(rating);
            });
        });
        
        // Update star colors based on rating value
        function updateStars(rating) {
            starButtons.forEach(btn => {
                const btnRating = parseInt(btn.dataset.rating);
                if (btnRating <= rating) {
                    btn.classList.remove('text-gray-300', 'dark:text-gray-600');
                    btn.classList.add('text-yellow-400');
                } else {
                    btn.classList.add('text-gray-300', 'dark:text-gray-600');
                    btn.classList.remove('text-yellow-400');
                }
            });
        }
    });
</script>
@endpush