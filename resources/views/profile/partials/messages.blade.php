<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Messages</h2>
    
    @if(isset($messages) && $messages->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Conversation List -->
            <div class="col-span-1 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Conversations</h3>
                
                <div class="space-y-2">
                    @foreach($messages as $participant)
                        <a href="{{ route('messages.conversation', $participant->id) }}" 
                            class="flex items-center p-3 rounded-lg {{ request()->route('user') == $participant->id ? 'bg-primary bg-opacity-10 border border-primary' : 'hover:bg-gray-100 dark:hover:bg-gray-600' }}">
                            <div class="relative">
                                <img class="h-10 w-10 rounded-full object-cover" 
                                    src="{{ $participant->avatar ? asset('storage/' . $participant->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($participant->name) . '&background=random' }}" 
                                    alt="{{ $participant->name }}">
                                
                                @if($participant->unread_count > 0)
                                    <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ $participant->unread_count }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $participant->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $participant->last_message ? Str::limit($participant->last_message, 20) : 'Start a conversation' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('messages.create') }}" class="block w-full text-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                        New Message
                    </a>
                </div>
            </div>
            
            <!-- Conversation or Welcome -->
            <div class="col-span-1 md:col-span-2 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                @if(isset($activeConversation))
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-600">
                        <img class="h-10 w-10 rounded-full object-cover" 
                            src="{{ $activeParticipant->avatar ? asset('storage/' . $activeParticipant->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($activeParticipant->name) . '&background=random' }}" 
                            alt="{{ $activeParticipant->name }}">
                        <div class="ml-3">
                            <p class="text-md font-medium text-gray-900 dark:text-white">{{ $activeParticipant->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $activeParticipant->hasRole('provider') ? 'Service Provider' : 'Client' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="h-80 overflow-y-auto mb-4 space-y-3" id="message-container">
                        @foreach($activeConversation as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-3/4 {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200' }} rounded-lg p-3">
                                    <p class="text-sm">{{ $message->content }}</p>
                                    <p class="text-xs {{ $message->sender_id === auth()->id() ? 'text-primary-light' : 'text-gray-500 dark:text-gray-400' }} mt-1">
                                        {{ $message->send_date->format('M j, g:i A') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <form action="{{ route('messages.send') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $activeParticipant->id }}">
                        <div class="flex">
                            <textarea name="content" rows="1" placeholder="Type your message..." 
                                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-l-lg focus:ring-primary focus:border-primary dark:bg-gray-800 dark:text-white resize-none"></textarea>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-r-lg hover:bg-opacity-90 transition-all">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="h-full flex flex-col items-center justify-center text-center py-10">
                        <i class="fas fa-comments text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Conversation Selected</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Select a conversation from the list or start a new one.</p>
                        <a href="{{ route('messages.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i> New Message
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
            <i class="fas fa-comments text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Messages Yet</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't started any conversations yet.</p>
            <a href="{{ route('messages.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                <i class="fas fa-plus mr-2"></i> Start a Conversation
            </a>
        </div>
    @endif
</div>