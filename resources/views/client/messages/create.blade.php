@extends('layouts.booking-layout')

@section('title', 'Message Provider')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Message Service Provider</h1>
            <p class="text-gray-600 dark:text-gray-400">Send a message to {{ $provider->name }} about your booking</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="recipient_id" value="{{ $provider->id }}">
                    
                    <!-- Provider Info -->
                    <div class="mb-6 flex items-start">
                        <div class="flex-shrink-0 mr-4">
                            <img src="{{ $provider->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($provider->name) . '&background=random' }}" 
                                 class="w-16 h-16 rounded-full" alt="{{ $provider->name }}">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $provider->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Service Provider</p>
                            @if($provider->phone)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <i class="fas fa-phone-alt mr-1"></i> {{ $provider->phone }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="What is your message about?" value="{{ $booking ? 'Regarding booking #' . $booking->id : old('subject') }}">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                        <textarea id="content" name="content" rows="5" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Type your message here...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <a href="{{ url()->previous() }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 mr-3 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg hover:opacity-90 transition-all">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection