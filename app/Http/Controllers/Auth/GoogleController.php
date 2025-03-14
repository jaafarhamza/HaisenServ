<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\Interfaces\GoogleAuthRepositoryInterface;

class GoogleController extends Controller
{
    protected $googleAuthRepository;
    
    public function __construct(GoogleAuthRepositoryInterface $googleAuthRepository) 
    {
        $this->googleAuthRepository = $googleAuthRepository;
    }
    
    public function redirectToGoogle()
    {
        return $this->googleAuthRepository->redirectToGoogle();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $this->googleAuthRepository->handleGoogleCallback();
            
            return redirect()->route('dashboard');
            
        } catch (Exception $e) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Google authentication failed. ' . $e->getMessage()]);
        }
    }
}