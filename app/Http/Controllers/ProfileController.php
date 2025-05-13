<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\BookingService;
use App\Services\ServiceService;
use App\Services\MessageService;
use App\Services\RatingService;
use App\Services\UserService;

class ProfileController extends Controller
{
    protected $bookingService;
    protected $serviceService;
    protected $messageService;
    protected $ratingService;
    protected $userService;

    public function __construct(
        BookingService $bookingService,
        ServiceService $serviceService,
        MessageService $messageService,
        RatingService $ratingService,
        UserService $userService
    ) {
        $this->bookingService = $bookingService;
        $this->serviceService = $serviceService;
        $this->messageService = $messageService;
        $this->ratingService = $ratingService;
        $this->userService = $userService;
    }

    /**
     * Display the user's profile dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $activeTab = $request->query('tab', 'profile');
        
        // Common data for all users
        $data = [
            'user' => $user,
            'activeTab' => $activeTab,
        ];
        
        // Get user-specific data based on roles
        if ($user->hasRole('client')) {
            // Get client bookings
            $data['bookings'] = $this->bookingService->getBookingsByUser($user->id);
            
            // Get client ratings
            $data['ratings'] = $this->ratingService->getRatingsByUser($user->id);
        }
        
        if ($user->hasRole('provider')) {
            // Get provider services
            $data['services'] = $this->serviceService->getServicesByUser($user->id);
            
            // Get service bookings
            $data['serviceBookings'] = $this->bookingService->getBookingsByProvider($user->id);
        }
        
        // Add user's personal bookings (as a customer) if they're a provider too
        if ($user->hasRole('provider') && $activeTab === 'my-bookings') {
            $data['personalBookings'] = $this->bookingService->getBookingsByUser($user->id);
        }
        
        // Get messages for all users
        $data['messages'] = $this->messageService->getConversationParticipants($user->id);
        
        return view('profile.index', $data);
    }
    
    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|file|max:10240',
        ]);
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $avatarPath;
        }
        
        // Update user
        $this->userService->updateUser($user->id, $validated);
        
        return redirect()->route('profile.index', ['tab' => 'profile'])
            ->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        // Update password
        $this->userService->updateUser($user->id, [
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('profile.index', ['tab' => 'security'])
            ->with('success', 'Password updated successfully.');
    }
    
    /**
     * Cancel a booking.
     */
    public function cancelBooking(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current user owns this booking or is the service provider
        $user = Auth::user();
        $isOwner = $booking->user_id === $user->id;
        $isProvider = $booking->service->user_id === $user->id;
        
        if (!$isOwner && !$isProvider) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be cancelled
        if ($booking->status !== 'pending' && $booking->status !== 'confirmed') {
            return back()->with('error', 'This booking cannot be cancelled.');
        }
        
        // Cancel the booking
        $this->bookingService->cancelBooking($id);
        
        $redirectTab = $isOwner ? 'my-bookings' : 'service-bookings';
        
        return redirect()->route('profile.index', ['tab' => $redirectTab])
            ->with('success', 'Booking cancelled successfully.');
    }
    
    /**
     * Confirm a booking (provider only).
     */
    public function confirmBooking(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current user is the service provider
        $user = Auth::user();
        $isProvider = $booking->service->user_id === $user->id;
        
        if (!$isProvider) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be confirmed
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking cannot be confirmed.');
        }
        
        // Confirm the booking
        $this->bookingService->confirmBooking($id);
        
        return redirect()->route('profile.index', ['tab' => 'service-bookings'])
            ->with('success', 'Booking confirmed successfully.');
    }
    
    /**
     * Complete a booking (provider only).
     */
    public function completeBooking(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current user is the service provider
        $user = Auth::user();
        $isProvider = $booking->service->user_id === $user->id;
        
        if (!$isProvider) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be completed
        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'This booking cannot be marked as completed.');
        }
        
        // Complete the booking
        $this->bookingService->completeBooking($id);
        
        return redirect()->route('profile.index', ['tab' => 'service-bookings'])
            ->with('success', 'Booking marked as completed successfully.');
    }
}