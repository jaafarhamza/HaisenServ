<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Services\RatingService;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    protected $ratingService;
    protected $serviceService;

    public function __construct(RatingService $ratingService, ServiceService $serviceService)
    {
        $this->ratingService = $ratingService;
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the ratings for provider's services.
     */
    public function index()
    {
        $services = $this->serviceService->getServicesByUser(auth()->id());
        $serviceIds = $services->pluck('id')->toArray();
        
        // Get ratings for all provider's services
        $ratings = collect();
        
        foreach ($serviceIds as $serviceId) {
            $serviceRatings = $this->ratingService->getRatingsByService($serviceId);
            $ratings = $ratings->merge($serviceRatings);
        }
        
        // Sort by most recent first
        $ratings = $ratings->sortByDesc('rating_date')->values();
        
        return view('provider.ratings.index', compact('ratings'));
    }

    /**
     * Display the specified rating.
     */
    public function show(string $id)
    {
        $rating = $this->ratingService->getRatingById($id);
        
        // Check if the current provider owns the service related to this rating
        $service = $this->serviceService->getServiceById($rating->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get any replies to this rating
        $replies = $this->ratingService->getRepliesForRating($id);
        
        return view('provider.ratings.show', compact('rating', 'replies'));
    }

    /**
     * Show the form for replying to a rating.
     */
    public function reply(string $id)
    {
        $rating = $this->ratingService->getRatingById($id);
        
        // Check if the current provider owns the service related to this rating
        $service = $this->serviceService->getServiceById($rating->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('provider.ratings.reply', compact('rating'));
    }

    /**
     * Store a new reply to a rating.
     */
    public function storeReply(Request $request, string $id)
    {
        $rating = $this->ratingService->getRatingById($id);
        
        // Check if the current provider owns the service related to this rating
        $service = $this->serviceService->getServiceById($rating->service_id);
        
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        
        try {
            $reply = $this->ratingService->createReply([
                'user_id' => auth()->id(),
                'service_id' => $rating->service_id,
                'reply_id' => $rating->id,
                'score' => 0, // Not applicable for replies
                'comment' => $validated['comment'],
                'rating_date' => now(),
            ]);
            
            return redirect()->route('provider.ratings.show', $id)
                ->with('success', 'Reply submitted successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while submitting your reply: ' . $e->getMessage());
        }
    }
}
