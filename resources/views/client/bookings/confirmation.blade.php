@extends('layouts.booking-layout')

@section('title', 'Booking Confirmed')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Success Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Booking Confirmed!</h2>
                    <p class="text-gray-600 dark:text-gray-400">Your booking has been successfully submitted and confirmed.</p>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Booking Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Service</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $booking->service->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Provider</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $booking->service->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Date & Time</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $booking->booking_date->format('D, M j, Y') }} at {{ $booking->booking_date->format('g:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>

                    @if($booking->notes)
                        <div class="mb-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Your Notes</p>
                            <p class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">{{ $booking->notes }}</p>
                        </div>
                    @endif

                    <div class="mb-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Contact Information</p>
                        <p class="text-gray-700 dark:text-gray-300">
                            <span class="font-medium">Phone:</span> {{ $booking->service->user->phone ?? 'Not provided' }}
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($booking->status === 'confirmed' || $booking->status === 'completed')
                            <a href="{{ route('client.ratings.create', ['service_id' => $booking->service_id]) }}" class="w-full px-6 py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all flex items-center justify-center">
                                <i class="fas fa-star mr-2"></i> Rate This Service
                            </a>
                        @else
                            <button disabled class="w-full px-6 py-3 bg-gray-400 text-white rounded-lg cursor-not-allowed flex items-center justify-center">
                                <i class="fas fa-star mr-2"></i> Rate Service (Available after confirmation)
                            </button>
                        @endif
                        <button type="button" onclick="document.getElementById('message-form').scrollIntoView({behavior: 'smooth'})" class="w-full px-6 py-3 border border-primary text-primary rounded-lg hover:bg-primary hover:bg-opacity-5 transition-all flex items-center justify-center">
                            <i class="fas fa-comment-alt mr-2"></i> Go to Message Form
                        </button>
                        <a href="{{ route('client.bookings.index') }}" class="sm:col-span-2 w-full px-6 py-3 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-opacity-90 transition-all flex items-center justify-center mt-2">
                            <i class="fas fa-calendar-check mr-2"></i> View All Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Provider Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Message {{ $booking->service->user->name }}</h2>
                
                @if(session('message_success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                        <p>{{ session('message_success') }}</p>
                    </div>
                @endif
                
                @if(session('message_error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                        <p>{{ session('message_error') }}</p>
                    </div>
                @endif
                
                <form id="message-form" action="{{ route('messages.send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="recipient_id" value="{{ $booking->service->user_id }}">
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Message</label>
                        <textarea id="content" name="content" rows="4" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection