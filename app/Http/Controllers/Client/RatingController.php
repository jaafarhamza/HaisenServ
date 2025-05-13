<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Service;
use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    protected $ratingRepository;
    protected $serviceRepository;

    public function __construct(
        RatingRepositoryInterface $ratingRepository,
        ServiceRepositoryInterface $serviceRepository
    ) {
        $this->ratingRepository = $ratingRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Display a listing of the client's ratings.
     */
    public function index()
    {
        $ratings = $this->ratingRepository->getRatingsByUser(Auth::id());
        
        return view('client.ratings.index', compact('ratings'));
    }

    /**
     * Show the form for creating a new rating.
     */
    public function create(Request $request)
    {
        $serviceId = $request->query('service_id');
        
        if (!$serviceId) {
            return redirect()->route('client.bookings.index')
                ->with('error', 'Service ID is required to create a rating.');
        }
        
        $service = $this->serviceRepository->getServiceById($serviceId);
        
        if (!$service) {
            return redirect()->route('client.bookings.index')
                ->with('error', 'Service not found.');
        }
        
        // Check if the user has a confirmed or completed booking for this service
        $hasConfirmedBooking = Auth::user()->bookings()
            ->where('service_id', $serviceId)
            ->whereIn('status', ['confirmed', 'completed'])
            ->exists();
        
        if (!$hasConfirmedBooking) {
            return redirect()->route('client.bookings.index')
                ->with('error', 'You can only rate services that have been confirmed or completed.');
        }
        
        // Check if the user has already rated this service
        $existingRating = $this->ratingRepository->getUserRatingForService(Auth::id(), $serviceId);
        
        if ($existingRating) {
            return redirect()->route('client.ratings.edit', $existingRating->id)
                ->with('info', 'You have already rated this service. You can edit your rating here.');
        }
        
        return view('client.ratings.create', compact('service'));
    }

    /**
     * Store a newly created rating in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);
        
        // Make sure the user has booked this service and it's either confirmed or completed
        $hasConfirmedBooking = Auth::user()->bookings()
            ->where('service_id', $validated['service_id'])
            ->whereIn('status', ['confirmed', 'completed'])
            ->exists();
            
        if (!$hasConfirmedBooking) {
            return back()->withInput()
                ->with('error', 'You can only rate services that have been confirmed or completed.');
        }
        
        // Create the rating
        $rating = $this->ratingRepository->createRating([
            'user_id' => Auth::id(),
            'service_id' => $validated['service_id'],
            'score' => $validated['score'],
            'comment' => $validated['comment'],
            'rating_date' => now(),
        ]);
        
        // Update service average rating
        $service = $this->serviceRepository->getServiceById($validated['service_id']);
        $service->updateAverageRating();
        
        return redirect()->route('client.bookings.index')
            ->with('success', 'Thank you for your rating!');
    }

    /**
     * Show the form for editing the specified rating.
     */
    public function edit(string $id)
    {
        $rating = $this->ratingRepository->getRatingById($id);
        
        // Check if the current user owns this rating
        if ($rating->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $service = $this->serviceRepository->getServiceById($rating->service_id);
        
        return view('client.ratings.edit', compact('rating', 'service'));
    }

    /**
     * Update the specified rating in storage.
     */
    public function update(Request $request, string $id)
    {
        $rating = $this->ratingRepository->getRatingById($id);
        
        // Check if the current user owns this rating
        if ($rating->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);
        
        // Update the rating
        $this->ratingRepository->updateRating($id, $validated);
        
        // Update service average rating
        $service = $this->serviceRepository->getServiceById($rating->service_id);
        $service->updateAverageRating();
        
        return redirect()->route('client.ratings.index')
            ->with('success', 'Rating updated successfully.');
    }

    /**
     * Remove the specified rating from storage.
     */
    public function destroy(string $id)
    {
        $rating = $this->ratingRepository->getRatingById($id);
        
        // Check if the current user owns this rating
        if ($rating->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete the rating
        $this->ratingRepository->deleteRating($id);
        
        // Update service average rating
        $service = $this->serviceRepository->getServiceById($rating->service_id);
        $service->updateAverageRating();
        
        return redirect()->route('client.ratings.index')
            ->with('success', 'Rating deleted successfully.');
    }
}