@extends('layouts.booking-layout')

@section('title', 'Book a Service')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Book a Service</h1>
            <p class="text-gray-600 dark:text-gray-400">Choose from available time slots to book this service.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('success') }}</p>
                <div class="mt-3">
                    <a href="{{ route('client.ratings.create', ['service_id' => $service->id]) }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        Rate This Service
                    </a>
                </div>
            </div>
        @endif

        @if($service)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Service Details -->
                <div class="col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $service->title }}</h2>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <span class="text-xl font-bold text-primary">{{ $service->formatted_price }}</span>
                                <span class="mx-2 text-gray-400 dark:text-gray-500">•</span>
                                <span class="text-gray-600 dark:text-gray-400">{{ $service->city }}</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($averageRating))
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @elseif($i == floor($averageRating) + 1 && $averageRating - floor($averageRating) >= 0.5)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" clip-path="inset(0 50% 0 0)"></path><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" fill="none" stroke="currentColor" stroke-width="1" clip-path="inset(0 0 0 50%)"></path></svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endif
                                    @endfor
                                    <span class="ml-1 text-gray-500 dark:text-gray-400 text-sm">({{ $service->ratings()->count() }})</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $service->description }}</p>
                        </div>
                        
                        @if($ratings && $ratings->count() > 0)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Recent Reviews</h3>
                                <div class="space-y-4">
                                    @foreach($ratings as $rating)
                                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                                            <div class="flex items-center mb-2">
                                                <img src="{{ $rating->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($rating->user->name) . '&background=random' }}" 
                                                     class="w-8 h-8 rounded-full mr-2" alt="{{ $rating->user->name }}">
                                                <div>
                                                    <div class="font-medium text-gray-900 dark:text-white">{{ $rating->user->name }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $rating->rating_date->format('M j, Y') }}</div>
                                                </div>
                                                <div class="ml-auto flex">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $rating->score)
                                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        @else
                                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-gray-600 dark:text-gray-400">{{ $rating->comment }}</p>
                                        </div>
                                    @endforeach
                                </div>
                                @if($service->ratings()->count() > 3)
                                    <div class="mt-3 text-center">
                                        <a href="#" class="text-primary hover:underline text-sm">See all {{ $service->ratings()->count() }} reviews</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Provider Info -->
                <div class="col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Service Provider</h3>
                            <div class="flex items-center mb-4">
                                <img src="{{ $provider->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($provider->name) . '&background=random' }}" 
                                     class="w-16 h-16 rounded-full mr-4" alt="{{ $provider->name }}">
                                <div>
                                    <div class="font-bold text-lg text-gray-900 dark:text-white">{{ $provider->name }}</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">{{ $provider->city ?? 'Location not specified' }}</div>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-600 dark:text-gray-400 text-sm">Phone</span>
                                    <span class="text-gray-900 dark:text-white text-sm">{{ $provider->phone ?? 'Not provided' }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600 dark:text-gray-400 text-sm">Services</span>
                                    <span class="text-gray-900 dark:text-white text-sm">{{ $provider->services()->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400 text-sm">Member since</span>
                                    <span class="text-gray-900 dark:text-white text-sm">{{ $provider->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                            
                            @if($provider->bio)
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">About</h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($provider->bio, 150) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Select Available Time Slot</h2>
                    
                    <form action="{{ route('client.bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <input type="hidden" id="booking_datetime" name="booking_date" value="">
                        
                        <div class="mb-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @if($availabilities && $availabilities->count() > 0)
                                    @foreach($availabilities as $index => $availability)
                                        <div class="availability-slot border border-gray-200 dark:border-gray-700 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:border-primary hover:bg-primary hover:bg-opacity-5" 
                                             data-datetime="{{ $availability->start_time->toIso8601String() }}">
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $availability->start_time->format('D, M j') }}</div>
                                            <div class="text-primary font-semibold">{{ $availability->start_time->format('g:i A') }} - {{ $availability->end_time->format('g:i A') }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-span-2 py-6 text-center text-gray-500 dark:text-gray-400">
                                        No available time slots for this service.
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ url()->previous() }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 mr-3 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 transition-all">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </a>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg hover:opacity-90 transition-all flex items-center">
                                <i class="fas fa-calendar-check mr-2"></i> Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 text-center">
                    <div class="text-gray-500 dark:text-gray-400 mb-4">
                        <i class="fas fa-exclamation-circle text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Service Selected</h3>
                        <p>Please select a service to book from our services page.</p>
                    </div>
                    <a href="{{ route('services.index') }}" class="inline-block px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all mt-4">
                        Browse Services
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingDateTimeInput = document.getElementById('booking_datetime');
        const availabilitySlots = document.querySelectorAll('.availability-slot');
        
        // Setup availability slots click handlers
        availabilitySlots.forEach(slot => {
            slot.addEventListener('click', function() {
                // Remove active class from all slots
                availabilitySlots.forEach(s => {
                    s.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
                    s.classList.add('border-gray-200', 'dark:border-gray-700');
                });
                
                // Add active class to selected slot
                this.classList.remove('border-gray-200', 'dark:border-gray-700');
                this.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
                
                // Set the datetime value
                bookingDateTimeInput.value = this.dataset.datetime;
            });
        });
        
        // Select the first availability slot by default
        if (availabilitySlots.length > 0) {
            availabilitySlots[0].click();
        }
    });
</script>
@endpush