<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Farm;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileSettings;

class FarmNameMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $profileSettings = ProfileSettings::where('user_id', auth()->id())->first();
        $farmName = null;

        if ($user && ($user->role_id == 3 || $user->role_id == 4)) {
            // Fetch the farm associated with the user (farm leader)
            $userFarm = Farm::where('farm_leader', $user->id)->first();
            if ($userFarm) {
                // Retrieve the farm_name associated with the farm
                $farmName = $userFarm->farm_name;
            }
        }

        // Share $farmName with all views
        view()->share('farmName', $farmName);

        return $next($request);
    }
}
