<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\ServiceService;
use Illuminate\Http\Request;

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
     * Display a listing of the provider's bookings.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $services = $this->serviceService->getServicesByUser(auth()->id());
        $serviceIds = $services->pluck('id')->toArray();
        
        // Get bookings for all provider's services
        $bookings = collect();
        
        foreach ($serviceIds as $serviceId) {
            $serviceBookings = $this->bookingService->getBookingsByService($serviceId);
            $bookings = $bookings->merge($serviceBookings);
        }
        
        // Filter by status if provided
        if ($status) {
            $bookings = $bookings->where('status', $status);
        }
        
        // Sort by most recent first
        $bookings = $bookings->sortByDesc('booking_date')->values();
        
        return view('provider.bookings.index', compact('bookings', 'status'));
    }

    /**
     * Display the specified booking.
     */
    public function show(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current provider owns the service related to this booking
        $service = $this->serviceService->getServiceById($booking->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('provider.bookings.show', compact('booking'));
    }

    /**
     * Confirm a booking.
     */
    public function confirm(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current provider owns the service related to this booking
        $service = $this->serviceService->getServiceById($booking->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be confirmed
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking cannot be confirmed.');
        }
        
        try {
            $this->bookingService->confirmBooking($id);
            
            return redirect()->route('provider.bookings.index')
                ->with('success', 'Booking confirmed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while confirming the booking: ' . $e->getMessage());
        }
    }

    /**
     * Cancel a booking.
     */
    public function cancel(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current provider owns the service related to this booking
        $service = $this->serviceService->getServiceById($booking->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be cancelled
        if ($booking->status !== 'pending' && $booking->status !== 'confirmed') {
            return back()->with('error', 'This booking cannot be cancelled.');
        }
        
        try {
            $this->bookingService->cancelBooking($id);
            
            return redirect()->route('provider.bookings.index')
                ->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while cancelling the booking: ' . $e->getMessage());
        }
    }

    /**
     * Mark a booking as completed.
     */
    public function complete(string $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        
        // Check if the current provider owns the service related to this booking
        $service = $this->serviceService->getServiceById($booking->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the booking can be completed
        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'This booking cannot be marked as completed.');
        }
        
        try {
            $this->bookingService->completeBooking($id);
            
            return redirect()->route('provider.bookings.index')
                ->with('success', 'Booking marked as completed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while completing the booking: ' . $e->getMessage());
        }
    }
}
