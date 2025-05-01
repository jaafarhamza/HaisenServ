<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        $user = User::where('email', $credentials['email'])->first();
    
        // Check if user is banned
        if ($user && $user->isBanned()) {
            return back()->withErrors([
                'email' => 'Your account has been banned. Reason: ' . 
                    ($user->ban_reason ?? 'No reason provided') . 
                    '. The ban will be lifted on ' . 
                    ($user->banned_until->year === 2999 ? 'never' : $user->banned_until->format('M d, Y'))
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else if ($user->hasRole('provider')) {
                return redirect()->route('provider.profile');
            } else if ($user->hasRole('client')) {
                return redirect()->route('homepage');
            } else {
                return redirect()->route('role.selection');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $userData = $request->only('name', 'email', 'password');

        $this->authRepository->register($userData);

        return redirect(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $this->authRepository->logout($request);

        return redirect('/');
    }
}