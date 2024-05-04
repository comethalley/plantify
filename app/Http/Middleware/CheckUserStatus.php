<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and their status is 0
        if (Auth::check() && Auth::user()->status === 0) {
            // Log out the user
            Auth::logout();
            // Redirect to login page with a message
            return redirect()->route('login')->with('status', 'Your account has been deactivated. Please contact support.');
        }

        return $next($request);
    }
}
