@extends('layouts.app')

@section('title', 'Conversation')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Conversation with {{ $otherUser->name }}</h1>
            <a href="{{ route('messages.index') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Messages
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
            <div class="grid grid-cols-1 md:grid-cols-4 h-[calc(80vh-2rem)]">
                <!-- User Info Sidebar -->
                <div class="col-span-1 border-r border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 flex flex-col items-center border-b border-gray-200 dark:border-gray-700">
                        <div class="h-24 w-24 rounded-full mb-4 overflow-hidden">
                            @if($otherUser->avatar)
                                <img src="{{ asset('storage/' . $otherUser->avatar) }}" alt="{{ $otherUser->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <i class="fas fa-user text-4xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                            @endif
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">{{ $otherUser->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                            {{ $otherUser->isProvider() ? 'Service Provider' : 'Client' }}
                            @if($otherUser->isProvider() && $otherUser->rating_average)
                                <span class="ml-1">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    {{ number_format($otherUser->rating_average, 1) }}
                                </span>
                            @endif
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-envelope mr-1"></i> {{ $otherUser->email }}
                        </p>
                        @if($otherUser->phone)
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <i class="fas fa-phone mr-1"></i> {{ $otherUser->phone }}
                            </p>
                        @endif
                    </div>
                    
                    @if($otherUser->isProvider())
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-3">Services</h3>
                            @if(count($userServices) > 0)
                                <div class="space-y-3">
                                    @foreach($userServices as $service)
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mr-2">
                                                <i class="fas fa-concierge-bell text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->title }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $service->formatted_price }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">No services listed</p>
                            @endif
                        </div>
                    @endif
                    
                    @if($otherUser->isClient())
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-3">Previous Bookings</h3>
                            @if(count($previousBookings) > 0)
                                <div class="space-y-3">
                                    @foreach($previousBookings as $booking)
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full {{ $booking->status == 'completed' ? 'bg-green-500 bg-opacity-10' : 'bg-blue-500 bg-opacity-10' }} flex items-center justify-center mr-2">
                                                <i class="fas fa-calendar-check {{ $booking->status == 'completed' ? 'text-green-500' : 'text-blue-500' }}"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->service->title }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->booking_date->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">No previous bookings</p>
                            @endif
                        </div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white mb-3">Actions</h3>
                        <div class="space-y-2">
                            @if($otherUser->isProvider())
                                <a href="{{ url('/services?provider=' . $otherUser->id) }}" class="flex items-center text-primary hover:text-primary-light">
                                    <i class="fas fa-list mr-2"></i> View All Services
                                </a>
                                <a href="{{ route('messages.create', ['recipient_id' => $otherUser->id]) }}" class="flex items-center text-primary hover:text-primary-light">
                                    <i class="fas fa-paper-plane mr-2"></i> New Message
                                </a>
                            @endif
                            
                            @if($otherUser->isClient() && auth()->user()->isProvider())
                                <a href="{{ route('provider.bookings.index', ['client_id' => $otherUser->id]) }}" class="flex items-center text-primary hover:text-primary-light">
                                    <i class="fas fa-calendar-alt mr-2"></i> View Bookings
                                </a>
                            @endif
                            
                            @if($otherUser->isProvider() && auth()->user()->isClient())
                                <a href="{{ route('client.bookings.create', ['provider_id' => $otherUser->id]) }}" class="flex items-center text-primary hover:text-primary-light">
                                    <i class="fas fa-calendar-plus mr-2"></i> Book a Service
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Message Area -->
                <div class="col-span-3 flex flex-col">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Messages</h2>
                        <div id="message-actions" class="flex space-x-2">
                            <button id="refresh-button" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400" title="Refresh Messages">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button id="delete-button" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400" title="Delete Conversation">
                                <i class="fas fa-trash"></i>
                            </button>
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
                            <input type="hidden" name="recipient_id" value="{{ $otherUser->id }}">
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Conversation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Delete Conversation</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this conversation? This action cannot be undone.</p>
        
        <div class="flex justify-end space-x-3">
            <button id="cancel-delete" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                Cancel
            </button>
            <form action="{{ route('messages.delete', $otherUser->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-opacity-90 transition-all">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messagesContainer = document.getElementById('messages-container');
        const deleteButton = document.getElementById('delete-button');
        const deleteModal = document.getElementById('delete-modal');
        const cancelDeleteButton = document.getElementById('cancel-delete');
        const refreshButton = document.getElementById('refresh-button');
        
        // Scroll to bottom of messages
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
        
        // Delete conversation modal
        if (deleteButton && deleteModal && cancelDeleteButton) {
            deleteButton.addEventListener('click', function() {
                deleteModal.classList.remove('hidden');
            });
            
            cancelDeleteButton.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });
            
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });
        }
        
        // Refresh messages
        if (refreshButton) {
            refreshButton.addEventListener('click', function() {
                location.reload();
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
        
        // Mark messages as read
        function markAsRead() {
            const userId = '{{ $otherUser->id }}';
            
            // This would be implemented with AJAX in a real application
            // e.g., fetch('/messages/mark-as-read/' + userId, { method: 'POST' });
        }
        
        markAsRead();
        
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