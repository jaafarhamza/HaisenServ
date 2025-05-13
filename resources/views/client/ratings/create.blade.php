@extends('layouts.booking-layout')

@section('title', 'Rate Service')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Rate This Service</h1>
            <p class="text-gray-600 dark:text-gray-400">Share your experience with {{ $service->title }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <form action="{{ route('client.ratings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    
                    <!-- Service Info -->
                    <div class="mb-6 flex items-center">
                        <div class="flex-shrink-0 mr-4">
                            <div class="w-16 h-16 bg-primary bg-opacity-10 flex items-center justify-center rounded-lg">
                                <i class="fas fa-concierge-bell text-2xl text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $service->title }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $service->user->name }} · {{ $service->formatted_price }}</p>
                        </div>
                    </div>

                    <!-- Star Rating -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Rating</label>
                        <div class="flex items-center">
                            <div class="flex-grow">
                                <div class="flex space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" 
                                                data-rating="{{ $i }}" 
                                                class="rating-star text-gray-300 hover:text-yellow-400 focus:text-yellow-400 transition-colors w-10 h-10">
                                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" name="score" id="rating-value" value="5" required>
                            </div>
                            <div id="rating-text" class="text-lg font-medium text-gray-700 dark:text-gray-300 min-w-[80px] text-right">
                                Excellent
                            </div>
                        </div>
                        @error('score')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div class="mb-6">
                        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Review</label>
                        <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Share your experience with this service...">{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <a href="{{ route('client.bookings.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 mr-3 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg hover:opacity-90 transition-all">
                            Submit Rating
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
        const ratingStars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating-value');
        const ratingText = document.getElementById('rating-text');
        
        const ratingTexts = {
            1: 'Poor',
            2: 'Fair',
            3: 'Good',
            4: 'Very Good',
            5: 'Excellent'
        };
        
        function updateRating(rating) {
            // Update hidden input value
            ratingInput.value = rating;
            
            // Update text display
            ratingText.textContent = ratingTexts[rating];
            
            // Update star colors
            ratingStars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }
        
        // Set initial rating (5 stars)
        updateRating(5);
        
        // Add click event to stars
        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                updateRating(rating);
            });
        });
    });
</script>
@endpush