<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if(in_array($user->role_id, $roles)) {
            return $next($request);
        }

        return redirect('analytics')->with('error','You have not admin access');
    }
}
