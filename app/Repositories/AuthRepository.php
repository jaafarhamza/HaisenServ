<?php
namespace App\Repositories;

use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthRepository implements AuthRepositoryInterface
{
    protected $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function attemptLogin(array $credentials, bool $remember = false): bool
    {
        return Auth::attempt($credentials, $remember);
    }
    
    public function logout(Request $request): void
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    
    public function register(array $userData)
    {
        $user = $this->userRepository->createUser($userData);
        
        return $user;
    }
    
    public function sendPasswordResetLink(string $email): string
    {
        return Password::sendResetLink(['email' => $email]);
    }
    
    public function resetPassword(array $data, ?callable $callback = null): string
    {
        if (!$callback) {
            $callback = function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            };
        }
        
        return Password::reset($data, $callback);
    }
}