<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\GoogleAuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthRepository implements GoogleAuthRepositoryInterface
{
    protected $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $userData = [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => null
            ];
            
            $user = $this->userRepository->findOrCreateGoogleUser($userData);
            
            Auth::login($user);
            
            return $user;
            
        } catch (Exception $e) {
            throw $e;
        }
    }
}