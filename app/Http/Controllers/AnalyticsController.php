<?php


namespace App\Http\Controllers;

use App\Models\CalendarPlanting;
use App\Models\Expense;
use App\Models\Farm;
use App\Models\Harvest;
use App\Models\Barangay; 
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AnalyticsController extends Controller
{
    public function index()
    {
         $user = auth()->user();
    $barangays = Barangay::all(['id', 'barangay_name'])->toArray();

    if ($user->role_id == 3) {
        // Fetch only data for farm leaders
        $expensesData = collect();
        $plantingData = collect();
        $farmsData = collect();

    } else {
        // Fetch data for super admin and admin roles
        $expensesData = Expense::all(['description', 'amount', 'created_at'])->toJson();
        $plantingData = CalendarPlanting::all(['title', 'start', 'harvested', 'destroyed', 'start'])->toJson();

        // Retrieve all farms and their farm_names
        $barangayId = $user->barangay_id;
        $farmsData = Farm::where('barangay_id', $barangayId)->with('barangay')->get()->toJson();

    }

    $barangayOptions = [];
    foreach ($barangays as $barangay) {
        $barangayOptions[] = [
            'value' => $barangay['id'],
            'text' => $barangay['barangay_name']
        ];
    }

    return view('pages.analytics', compact('expensesData', 'plantingData', 'farmsData', 'barangayOptions'));
    }

    public function getFarms($barangayName)
    {
        $farms = Farm::where('barangay_name', $barangayName)->get();
        
        return response()->json(['farms' => $farms]);
    }

    public function getFarmsData(Request $request, $id)
    {
        $year = $request->has('year') ? $request->year : now()->year;
    
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthlyData = array_fill_keys($months, ['harvested' => 0, 'destroyed' => 0]);
    
        // Fetch the farm data for the selected year
        $farms = DB::table('createplantings')
                   ->where('farm_id', $id)
                   ->whereYear('start', $year)
                   ->get();
    
        // Aggregate harvested and destroyed data for each month
        foreach ($farms as $farm) {
            $month = Carbon::parse($farm->start)->format('F');
            if (array_key_exists($month, $monthlyData)) {
                $monthlyData[$month]['harvested'] += $farm->harvested;
                $monthlyData[$month]['destroyed'] += $farm->destroyed;
            }
        }
    
        // Sum the 'harvested' and 'destroyed' columns for the selected year
        $totalHarvested = array_sum(array_column($monthlyData, 'harvested'));
        $totalDestroyed = array_sum(array_column($monthlyData, 'destroyed'));
    
        return response()->json([
            'farms' => $farms,
            'totalHarvested' => $totalHarvested,
            'totalDestroyed' => $totalDestroyed,
            'monthlyData' => $monthlyData
        ]);
    }
    
    
}
    