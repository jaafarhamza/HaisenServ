<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GamificationService;
use App\Services\BadgeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class GamificationController extends Controller
{
    protected $gamificationService;
    protected $badgeService;
    protected $userService;

    public function __construct(
        GamificationService $gamificationService,
        BadgeService $badgeService,
        UserService $userService
    ) {
        $this->gamificationService = $gamificationService;
        $this->badgeService = $badgeService;
        $this->userService = $userService;
    }

    /**
     * Display the gamification dashboard.
     */
    public function index()
    {
        $topUsers = $this->gamificationService->getTopUsers(10);
        
        // Group users by level
        $usersByLevel = [
            1 => $this->gamificationService->getUsersByLevel(1)->count(),
            2 => $this->gamificationService->getUsersByLevel(2)->count(),
            3 => $this->gamificationService->getUsersByLevel(3)->count(),
            4 => $this->gamificationService->getUsersByLevel(4)->count(),
            5 => $this->gamificationService->getUsersByLevel(5)->count(),
            6 => $this->gamificationService->getUsersByLevel(6)->count(),
        ];
        
        return view('admin.gamification.index', compact('topUsers', 'usersByLevel'));
    }

    /**
     * Display the badge management page.
     */
    public function badges()
    {
        $badges = $this->badgeService->getAllBadges();
        
        return view('admin.gamification.badges', compact('badges'));
    }

    /**
     * Show the form for creating a new badge.
     */
    public function createBadge()
    {
        return view('admin.gamification.create-badge');
    }

    /**
     * Store a newly created badge in storage.
     */
    public function storeBadge(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:badges,name',
            'description' => 'required|string|max:1000',
            'icon_url' => 'nullable|string|max:255',
        ]);
        
        try {
            $badge = $this->badgeService->createBadge($validated);
            
            return redirect()->route('admin.gamification.badges')
                ->with('success', 'Badge created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while creating the badge: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing a badge.
     */
    public function editBadge(string $id)
    {
        $badge = $this->badgeService->getBadgeById($id);
        
        return view('admin.gamification.edit-badge', compact('badge'));
    }

    /**
     * Update the specified badge in storage.
     */
    public function updateBadge(Request $request, string $id)
    {
        $badge = $this->badgeService->getBadgeById($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:badges,name,' . $id,
            'description' => 'required|string|max:1000',
            'icon_url' => 'nullable|string|max:255',
        ]);
        
        try {
            $this->badgeService->updateBadge($id, $validated);
            
            return redirect()->route('admin.gamification.badges')
                ->with('success', 'Badge updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while updating the badge: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified badge from storage.
     */
    public function destroyBadge(string $id)
    {
        try {
            $this->badgeService->deleteBadge($id);
            
            return redirect()->route('admin.gamification.badges')
                ->with('success', 'Badge deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the badge: ' . $e->getMessage());
        }
    }

    /**
     * Display users with a specific badge.
     */
    public function badgeUsers(string $id)
    {
        $badge = $this->badgeService->getBadgeById($id);
        $users = $this->badgeService->getUsersWithBadge($id);
        
        return view('admin.gamification.badge-users', compact('badge', 'users'));
    }

    /**
     * Award a badge to a user manually.
     */
    public function awardBadge(Request $request)
    {
        $validated = $request->validate([
            'badge_id' => 'required|exists:badges,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        try {
            $this->badgeService->awardBadgeToUser($validated['badge_id'], $validated['user_id']);
            
            return redirect()->back()
                ->with('success', 'Badge awarded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while awarding the badge: ' . $e->getMessage());
        }
    }

    /**
     * Award points to a user manually.
     */
    public function awardPoints(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
        ]);
        
        try {
            $this->gamificationService->addPoints(
                $validated['user_id'],
                'manual_award',
                $validated['points'],
                $validated['reason']
            );
            
            return redirect()->back()
                ->with('success', 'Points awarded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while awarding points: ' . $e->getMessage());
        }
    }
}
