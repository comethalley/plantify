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
        $farmName = null;
        $barangayName = null;

        if ($user) {
            if ($user->role_id == 3 || $user->role_id == 1 || $user->role_id == 2) {
                // If the user is a farm leader, fetch the farm associated with the farm leader's barangay
                $userFarm = Farm::where('farm_leader', $user->id)->first();
                if ($userFarm) {
                    $farmName = $userFarm->farm_name;
                    $barangayName = $userFarm->barangay_name;

                }
            } elseif ($user->role_id == 4) {
                // If the user is a farmer, retrieve the farm associated with the farmer's farm leader's barangay
                $farmer = Farmer::where('farmleader_id', $user->id)->first();
                if ($farmer && $farmer->farm) {
                    // Fetch the farm associated with the farm leader's barangay
                    $farmLeaderFarm = Farm::where('barangay_name', $farmer->barangay_name)->first();
                    if ($farmLeaderFarm) {
                        $farmName = $farmLeaderFarm->farm_name;
                        $barangayName = $farmLeaderFarm->barangay_name;

                    }
                }
            }
            
        }

        // Share $farmName with all views
        view()->share('farmName', $farmName, 
                      'barangayName', $barangayName);

        return $next($request);
    }
}
