@extends('layouts.app')

@section('title', 'New Message')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">New Message</h1>
            <a href="{{ route('messages.index') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Messages
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="recipient_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Recipient</label>
                        @if(isset($recipient))
                            <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
                            <div class="flex items-center px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <div class="flex-shrink-0">
                                    @if($recipient->avatar)
                                        <img src="{{ asset('storage/' . $recipient->avatar) }}" alt="{{ $recipient->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">{{ $recipient->name }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $recipient->isProvider() ? 'Service Provider' : 'Client' }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <select id="recipient_id" name="recipient_id" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                <option value="">-- Select Recipient --</option>
                                @if(count($providers) > 0)
                                    <optgroup label="Service Providers">
                                        @foreach($providers as $provider)
                                            <option value="{{ $provider->id }}" {{ old('recipient_id') == $provider->id ? 'selected' : '' }}>
                                                {{ $provider->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                
                                @if(count($clients) > 0)
                                    <optgroup label="Clients">
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('recipient_id') == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            </select>
                        @endif
                        @error('recipient_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject (Optional)</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                        <textarea id="content" name="content" rows="5" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('messages.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection