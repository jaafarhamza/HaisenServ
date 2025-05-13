<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use App\Services\UserService;
use App\Services\ServiceService;
use App\Services\BookingService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageService;
    protected $userService;
    protected $serviceService;
    protected $bookingService;

    public function __construct(
        MessageService $messageService, 
        UserService $userService,
        ServiceService $serviceService,
        BookingService $bookingService
    ) {
        $this->messageService = $messageService;
        $this->userService = $userService;
        $this->serviceService = $serviceService;
        $this->bookingService = $bookingService;
    }

    /**
     * Delete a conversation with a user.
     */
    public function delete(string $userId)
    {
        $currentUserId = auth()->id();
        
        try {
            // Delete all messages between these two users
            $this->messageService->deleteConversation($currentUserId, $userId);
            
            return redirect()->route('messages.index')
                ->with('success', 'Conversation deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    /**
     * Display a listing of the user's conversations.
     */
    public function index()
    {
        $participants = $this->messageService->getConversationParticipants(auth()->id());
        
        return view('messages.index', compact('participants'));
    }

    /**
     * Show the conversation with a specific user.
     */
    public function conversation(string $userId)
    {
        $currentUserId = auth()->id();
        
        // Get the other user's details
        $otherUser = $this->userService->getUserById($userId);
        
        if (!$otherUser) {
            abort(404, 'User not found.');
        }
        
        // Get the conversation messages
        $messages = $this->messageService->getConversation($currentUserId, $userId);
        
        // Mark all messages from the other user as read
        $this->messageService->markConversationAsRead($currentUserId, $userId);
        
        // Get all conversation participants for the sidebar
        $participants = $this->messageService->getConversationParticipants($currentUserId);
        
        // Get additional data based on the user role
        $userServices = [];
        $previousBookings = [];
        
        if ($otherUser->hasRole('provider')) {
            $userServices = $this->serviceService->getServicesByUser($userId);
        }
        
        if ($otherUser->hasRole('client') && auth()->user()->hasRole('provider')) {
            // Get bookings where this client booked your services
            $previousBookings = $this->bookingService->getBookingsByClientForProvider($userId, auth()->id());
        }
        
        return view('messages.conversation', compact('otherUser', 'messages', 'participants', 'userServices', 'previousBookings'));
    }

    /**
     * Send a new message.
     */
    public function send(Request $request)
    {
        // Debugging - Log all input
        \Illuminate\Support\Facades\Log::info('Message form submitted', ['request_data' => $request->all()]);
        
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string|max:10000',
            'booking_id' => 'nullable|exists:bookings,id',
        ]);
        
        try {
            \Illuminate\Support\Facades\Log::info('Message validated', ['validated_data' => $validated]);
            
            $messageData = [
                'sender_id' => auth()->id(),
                'recipient_id' => $validated['recipient_id'],
                'content' => $validated['content'],
                'send_date' => now(),
                'read' => false,
            ];
            
            \Illuminate\Support\Facades\Log::info('About to create message', ['message_data' => $messageData]);
            
            $message = $this->messageService->createMessage($messageData);
            
            \Illuminate\Support\Facades\Log::info('Message created', ['message_id' => $message->id]);
            
            // If this is an AJAX request, return the message
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                ]);
            }
            
            // If this was sent from a booking confirmation page, redirect back there
            if (isset($validated['booking_id'])) {
                return redirect()->route('client.bookings.confirmation', $validated['booking_id'])
                    ->with('message_success', 'Message sent successfully. ID: ' . $message->id);
            }
            
            // Otherwise, redirect back to the conversation
            return redirect()->route('messages.conversation', $validated['recipient_id'])
                ->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage(),
                ], 400);
            }
            
            // If this was sent from a booking confirmation page, redirect back there
            if (isset($validated['booking_id'])) {
                return redirect()->route('client.bookings.confirmation', $validated['booking_id'])
                    ->with('message_error', 'An error occurred while sending your message: ' . $e->getMessage());
            }
            
            return back()->withInput()
                ->with('error', 'An error occurred while sending your message: ' . $e->getMessage());
        }
    }

    /**
     * Get the unread message count for the current user.
     */
    public function getUnreadCount()
    {
        $count = $this->messageService->getUnreadMessageCount(auth()->id());
        
        return response()->json(['unread_count' => $count]);
    }

    /**
     * Show the form for starting a new conversation.
     */
    public function create(Request $request)
    {
        // Get recipient details if provided in query parameters
        $recipientId = $request->query('recipient_id');
        $recipient = null;
        
        if ($recipientId) {
            $recipient = $this->userService->getUserById($recipientId);
        }
        
        // Get all users by role
        $allUsers = $this->userService->getAllUsers()
            ->where('id', '!=', auth()->id());
            
        // Separate users by role
        $providers = $allUsers->filter(function($user) {
            return $user->hasRole('provider');
        })->values();
        
        $clients = $allUsers->filter(function($user) {
            return $user->hasRole('client');
        })->values();
        
        return view('messages.create', compact('recipient', 'providers', 'clients'));
    }

    /**
     * Start a new conversation with a user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string|max:10000',
        ]);
        
        try {
            $message = $this->messageService->createMessage([
                'sender_id' => auth()->id(),
                'recipient_id' => $validated['recipient_id'],
                'content' => $validated['content'],
                'send_date' => now(),
                'read' => false,
            ]);
            
            return redirect()->route('messages.conversation', $validated['recipient_id'])
                ->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while sending your message: ' . $e->getMessage());
        }
    }
    
    /**
     * Test message creation (for debugging)
     */
    public function testCreateMessage()
    {
        try {
            // Try to create a message directly using the Model
            $message = \App\Models\Message::create([
                'sender_id' => auth()->id(),
                'recipient_id' => auth()->id(), // Just sending to yourself for testing
                'content' => 'This is a test message created at ' . now(),
                'send_date' => now(),
                'read' => false,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Test message created successfully',
                'message_id' => $message->id,
                'message_data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}