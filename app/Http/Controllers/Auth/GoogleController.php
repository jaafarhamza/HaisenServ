<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\GoogleAuthRepositoryInterface;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    protected $googleAuthRepository;
    
    public function __construct(GoogleAuthRepositoryInterface $googleAuthRepository) 
    {
        $this->googleAuthRepository = $googleAuthRepository;
    }
    
    public function redirectToGoogle()
    {
        // Debug the request URL
        Log::info('Redirecting to Google OAuth', [
            'requested_url' => request()->fullUrl()
        ]);
        return $this->googleAuthRepository->redirectToGoogle();
    }
    
    public function handleGoogleCallback(Request $request)
    {
        // Log that we've reached the callback with full URL info
        Log::info('Google callback reached', [
            'full_url' => $request->fullUrl(),
            'request_data' => $request->all()
        ]);
        
        try {
            if ($request->has('error')) {
                Log::error('Google auth error: ' . $request->error);
                return redirect()->route('login')
                    ->withErrors(['error' => 'Google authentication failed: ' . $request->error]);
            }
            
            $user = $this->googleAuthRepository->handleGoogleCallback();
            Log::info('Google auth successful', ['user_email' => $user->email ?? 'unknown']);
            
            return redirect()->route('dashboard');
            
        } catch (Exception $e) {
            Log::error('Google auth exception: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('login')
                ->withErrors(['error' => 'Google authentication failed. ' . $e->getMessage()]);
        }
    }
}