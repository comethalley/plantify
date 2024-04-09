<?php


namespace App\Http\Controllers;

use App\Models\CalendarPlanting;
use App\Models\Expense;
use App\Models\Farm;
use App\Models\Harvest;
use App\Models\Barangay;
use App\Models\User;
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
        $expensesData = collect();
        $plantingData = collect();
        $farmsData = collect();
    
        if ($user->role_id == 1 || $user->role_id == 2) {
            $expensesData = Expense::all(['description', 'amount', 'created_at', 'budget_id'])->toJson();
            $plantingData = CalendarPlanting::all(['title', 'start', 'harvested', 'destroyed', 'start'])->toJson();
            $farmsData = Farm::with('barangays')->get()->toJson();
        } elseif ($user->role_id == 3 || $user->role_id == 4) {
            $expensesData = Expense::where('budget_id', $user->id)->get(['description', 'amount', 'created_at'])->toJson();
            $farmsData = Farm::where('id', $user->id)->with('barangay')->get()->toJson();
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
    public function count()
    {
        $farmLeaderCount = User::where('role_id', 3)->count();
        $farmerCount = User::where('role_id', 4)->count();
        $totalUserCount = User::count();
        $farmCount = Farm::distinct()->count('id');

        return response()->json([
            'farmLeaderCount' => $farmLeaderCount,
            'farmerCount' => $farmerCount,
            'totalUserCount' => $totalUserCount,
            'farmCount' => $farmCount
        ]);
    }
}
