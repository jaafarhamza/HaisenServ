@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Booking Details</h1>
            <a href="{{ route('client.bookings.index') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Bookings
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
            <!-- Booking Status Header -->
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-500',
                    'confirmed' => 'bg-green-500',
                    'completed' => 'bg-blue-500',
                    'cancelled' => 'bg-red-500',
                ];
                $statusColor = $statusColors[$booking->status] ?? 'bg-gray-500';
                
                $statusDescriptions = [
                    'pending' => 'Your booking is waiting for provider confirmation',
                    'confirmed' => 'Your booking has been confirmed by the provider',
                    'completed' => 'This service has been completed',
                    'cancelled' => 'This booking has been cancelled',
                ];
                $statusDescription = $statusDescriptions[$booking->status] ?? '';
            @endphp
            
            <div class="{{ $statusColor }} text-white px-6 py-4">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                        @if($booking->status == 'pending')
                            <i class="fas fa-clock"></i>
                        @elseif($booking->status == 'confirmed')
                            <i class="fas fa-check"></i>
                        @elseif($booking->status == 'completed')
                            <i class="fas fa-check-double"></i>
                        @elseif($booking->status == 'cancelled')
                            <i class="fas fa-times"></i>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold">Booking {{ ucfirst($booking->status) }}</h2>
                        <p class="text-sm opacity-80">{{ $statusDescription }}</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Service Details -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Service Information</h3>
                    <div class="flex flex-col sm:flex-row">
                        <div class="sm:w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 sm:mb-0 flex-shrink-0">
                            <i class="fas fa-concierge-bell text-4xl text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <div class="sm:ml-6 flex-grow">
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $booking->service->title }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $booking->service->description }}</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Provider</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $booking->service->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $booking->service->formatted_price }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $booking->service->category->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Rating</p>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $booking->service->user->rating_average)
                                                <i class="fas fa-star text-yellow-400"></i>
                                            @elseif($i - 0.5 <= $booking->service->user->rating_average)
                                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                                            @else
                                                <i class="far fa-star text-yellow-400"></i>
                                            @endif
                                        @endfor
                                        <span class="ml-1 text-gray-600 dark:text-gray-400">({{ number_format($booking->service->user->rating_average, 1) }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Booking Details -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Booking Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-calendar-day mr-3 text-primary"></i>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white">Date & Time</h4>
                                </div>
                                <p class="ml-8 text-gray-600 dark:text-gray-400">
                                    {{ $booking->booking_date->format('l, F j, Y') }}<br>
                                    {{ $booking->booking_date->format('h:i A') }}
                                </p>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-info-circle mr-3 text-primary"></i>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white">Booking ID</h4>
                                </div>
                                <p class="ml-8 text-gray-600 dark:text-gray-400">
                                    #{{ $booking->id }}
                                </p>
                            </div>
                        </div>
                        
                        <div>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-money-bill-wave mr-3 text-primary"></i>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white">Payment</h4>
                                </div>
                                <p class="ml-8 text-gray-600 dark:text-gray-400">
                                    Amount: {{ $booking->amount ? number_format($booking->amount, 2) . ' $' : $booking->service->formatted_price }}<br>
                                    Status: <span class="font-medium {{ $booking->payment_status ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                        {{ $booking->payment_status ? 'Paid' : 'Pending Payment' }}
                                    </span>
                                </p>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-sticky-note mr-3 text-primary"></i>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white">Notes</h4>
                                </div>
                                <p class="ml-8 text-gray-600 dark:text-gray-400">
                                    {{ $booking->notes ?? 'No additional notes provided' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-wrap justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="mb-4 md:mb-0">
                        @if($booking->status == 'confirmed')
                            <span class="text-gray-600 dark:text-gray-400">
                                <i class="fas fa-info-circle mr-1 text-primary"></i>
                                The service provider will contact you before the appointment.
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex space-x-3">
                        @if($booking->status == 'pending' || $booking->status == 'confirmed')
                            <form action="{{ route('client.bookings.cancel', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    Cancel Booking
                                </button>
                            </form>
                        @endif
                        
                        @if($booking->status == 'confirmed')
                            <a href="{{ route('messages.conversation', $booking->service->user_id) }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Message Provider
                            </a>
                        @endif
                        
                        @if($booking->status == 'completed' && !$booking->hasRating())
                            <a href="{{ route('client.ratings.create', ['booking_id' => $booking->id]) }}" class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Leave a Review
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection