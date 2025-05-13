<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use App\Exceptions\AvailabilityException;

class BookingController extends Controller
{
    protected $bookingService;
    protected $serviceService;

    public function __construct(BookingService $bookingService, ServiceService $serviceService)
    {
        $this->bookingService = $bookingService;
        $this->serviceService = $serviceService;
    }

    /**
     * Display the booking confirmation page.
     */
    public function confirmation(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('client.bookings.confirmation', compact('booking'));
    }

    /**
     * Display a listing of the client's bookings.
     */
    public function index()
    {
        // Redirect to profile page with bookings tab
        return redirect()->route('profile.index', ['tab' => 'my-bookings']);
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create(Request $request)
    {
        $serviceId = $request->query('service_id');
        $service = null;
        $provider = null;
        $ratings = null;
        $averageRating = 0;
        $availabilities = null;
        
        if ($serviceId) {
            $service = $this->serviceService->getServiceById($serviceId);
            
            if ($service) {
                // Get provider information
                $provider = $service->user;
                
                // Get ratings for the service
                $ratings = $service->ratings()->with('user')->topLevel()->latest()->take(5)->get();
                $averageRating = $service->ratings()->avg('score') ?? 0;
                
                // Get availabilities for the service
                $availabilities = $service->availabilities()
                    ->where('start_time', '>=', now())
                    ->orderBy('start_time')
                    ->take(10)
                    ->get();
            }
        }
        
        return view('client.bookings.create', compact('service', 'provider', 'ratings', 'averageRating', 'availabilities'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:now',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        try {
            $booking = $this->bookingService->createBooking([
                'user_id' => auth()->id(),
                'service_id' => $validated['service_id'],
                'booking_date' => $validated['booking_date'],
                'notes' => $validated['notes'] ?? null,
            ]);
            
            return redirect()->route('client.bookings.confirmation', $booking->id)
                ->with('success', 'Booking request submitted successfully.');
        } catch (AvailabilityException $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while creating your booking: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified booking.
     */
    public function show(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('client.bookings.show', compact('booking'));
    }

    /**
     * Cancel the specified booking.
     */
    public function cancel(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be cancelled
        if ($booking->status !== 'pending' && $booking->status !== 'confirmed') {
            return back()->with('error', 'This booking cannot be cancelled.');
        }
        
        try {
            $this->bookingService->cancelBooking($id);
            
            return redirect()->route('profile.index', ['tab' => 'my-bookings'])
                ->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while cancelling your booking: ' . $e->getMessage());
        }
    }

    /**
     * Get available time slots for a service on a specific date.
     */
    public function getTimeSlots(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
        ]);
        
        $timeSlots = $this->bookingService->getAvailableTimeSlots(
            $validated['service_id'],
            $validated['date']
        );
        
        return response()->json(['time_slots' => $timeSlots]);
    }
}
