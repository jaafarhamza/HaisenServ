@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Messages</h1>
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
            <div class="grid grid-cols-1 md:grid-cols-3 h-[calc(80vh-2rem)]">
                <!-- Contacts Sidebar -->
                <div class="col-span-1 border-r border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Conversations</h2>
                        <a href="{{ route('messages.create') }}" class="text-primary hover:text-primary-light">
                            <i class="fas fa-plus-circle"></i> New Message
                        </a>
                    </div>
                    
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="relative">
                            <input type="text" id="search-contacts" placeholder="Search contacts..." class="w-full py-2 pl-10 pr-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-y-auto flex-grow" id="contacts-list">
                        @forelse($conversations as $conversation)
                            <a href="{{ route('messages.conversation', $conversation['user']->id) }}" class="block border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ $conversation['user']->id == ($activeUser->id ?? null) ? 'bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20' : '' }}">
                                <div class="flex items-center p-4">
                                    <div class="flex-shrink-0 relative">
                                        @if($conversation['user']->avatar)
                                            <img src="{{ asset('storage/' . $conversation['user']->avatar) }}" alt="{{ $conversation['user']->name }}" class="h-12 w-12 rounded-full object-cover">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                                            </div>
                                        @endif
                                        @if($conversation['unread_count'] > 0)
                                            <div class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">
                                                {{ $conversation['unread_count'] }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3 flex-grow">
                                        <div class="flex justify-between items-center">
                                            <h3 class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $conversation['user']->name }}</h3>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $conversation['last_message']->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate {{ $conversation['unread_count'] > 0 ? 'font-semibold text-gray-900 dark:text-white' : '' }}">
                                            @if($conversation['last_message']->sender_id == auth()->id())
                                                <span class="text-xs text-gray-400 dark:text-gray-500">You: </span>
                                            @endif
                                            {{ $conversation['last_message']->content }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center h-full">
                                    <div class="h-16 w-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-envelope text-gray-400 dark:text-gray-500 text-2xl"></i>
                                    </div>
                                    <p class="mb-4">No conversations yet</p>
                                    <a href="{{ route('messages.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                        Start a New Conversation
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Message Area -->
                <div class="col-span-2 flex flex-col">
                    @if(isset($activeUser))
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center">
                            <div class="flex-shrink-0">
                                @if($activeUser->avatar)
                                    <img src="{{ asset('storage/' . $activeUser->avatar) }}" alt="{{ $activeUser->name }}" class="h-12 w-12 rounded-full object-cover">
                                @else
                                    <div class="h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $activeUser->name }}</h3>
                                @if($activeUser->isProvider())
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Service Provider
                                        @if($activeUser->rating_average)
                                            <span class="ml-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                {{ number_format($activeUser->rating_average, 1) }}
                                            </span>
                                        @endif
                                    </p>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Client</p>
                                @endif
                            </div>
                        </div>
                        
                        <div id="messages-container" class="flex-grow overflow-y-auto p-4 space-y-4">
                            @foreach($messages as $message)
                                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-[70%]">
                                        <div class="{{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' }} rounded-lg px-4 py-2 shadow-sm">
                                            <p>{{ $message->content }}</p>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 {{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                            {{ $message->created_at->format('M d, Y h:i A') }}
                                            @if($message->sender_id == auth()->id())
                                                @if($message->read)
                                                    <span class="ml-1 text-primary"><i class="fas fa-check-double"></i></span>
                                                @else
                                                    <span class="ml-1 text-gray-400"><i class="fas fa-check"></i></span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                            <form action="{{ route('messages.send') }}" method="POST" id="message-form">
                                @csrf
                                <input type="hidden" name="recipient_id" value="{{ $activeUser->id }}">
                                <div class="flex items-center">
                                    <div class="relative flex-grow">
                                        <input type="text" id="message-input" name="content" placeholder="Type your message..." class="w-full py-3 pl-4 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary" required>
                                        <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 p-2 rounded-full">
                                            <i class="fas fa-paperclip"></i>
                                        </button>
                                    </div>
                                    <button type="submit" class="ml-2 p-3 bg-primary text-white rounded-full hover:bg-opacity-90 transition-colors">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-full p-6 text-center text-gray-500 dark:text-gray-400">
                            <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-comments text-gray-400 dark:text-gray-500 text-4xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Your Messages</h3>
                            <p class="mb-6">Select a conversation or start a new one</p>
                            <a href="{{ route('messages.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Start a New Conversation
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messagesContainer = document.getElementById('messages-container');
        const searchInput = document.getElementById('search-contacts');
        const contactsList = document.getElementById('contacts-list');
        const contactItems = contactsList.querySelectorAll('a');
        
        // Scroll to bottom of messages
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
        
        // Search contacts
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                contactItems.forEach(item => {
                    const contactName = item.querySelector('h3').textContent.toLowerCase();
                    
                    if (contactName.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
        
        // Message submission
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');
        
        if (messageForm) {
            messageForm.addEventListener('submit', function(e) {
                if (!messageInput.value.trim()) {
                    e.preventDefault();
                }
            });
        }
        
        // Real-time updates (placeholder - would need WebSockets implementation)
        function checkNewMessages() {
            // AJAX request to check for new messages would go here
            // This is just a placeholder for now
            setTimeout(checkNewMessages, 10000); // Check every 10 seconds
        }
        
        checkNewMessages();
    });
</script>
@endpush