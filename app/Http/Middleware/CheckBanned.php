<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isBanned()) {
            // Store ban 
            $banReason = auth()->user()->ban_reason ?? 'No reason provided';
            $banUntil = auth()->user()->banned_until;
            $isPermanent = $banUntil->year === 2999;
            $banEndDate = $isPermanent ? 'never' : $banUntil->format('M d, Y');
            
            // Log the user out
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Redirect with ban message
            return redirect()->route('login')
                ->withErrors([
                    'email' => "Your account has been banned. Reason: {$banReason}. The ban will be lifted on {$banEndDate}."
                ]);
        }

        return $next($request);
    }
}