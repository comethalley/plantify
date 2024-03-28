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
        $plantingData = CalendarPlanting::all(['title', 'start', 'harvested', 'destroyed', 'created_at'])->toJson();

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

    public function getFarmsData($id)
{
    $farms = DB::table('createplantings')->where('farm_id', $id)->get();
    
    return response()->json(['farms' => $farms]);
}
}
    