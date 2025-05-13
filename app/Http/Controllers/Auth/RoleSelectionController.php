<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSelectionController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showRoleSelectionForm()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('provider')) {
                return redirect()->route('provider.profile');
            }

            if ($user->hasRole('client')) {
                return redirect()->route('homepage');
            }
        }

        return view('auth.role-selection');
    }

    public function processRoleSelection(Request $request)
    {
        $request->validate([
            'role' => 'required|string|in:client,provider,skip',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to select a role.');
        }
        $role = $request->role;

        if ($role === 'skip') {
            $role === 'client';
        }

        $this->userRepository->assignRoleToUser($user, $request->role);

        if ($request->role === 'provider') {
            return redirect()->route('provider.profile')
                ->with('success', 'Welcome! Please complete your provider profile.');
        }

        return redirect()->route('homepage')
            ->with('success', 'Welcome to HaisenServ! Your account is ready to use.');
    }

    public function skipRoleSelection()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to skip role selection.');
        }

        $this->userRepository->assignRoleToUser($user, 'client');

        return redirect()->route('homepage')
            ->with('success', 'Welcome to HaisenServ! Your account is ready to use.');
    }
}