<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Barangay;
use App\Models\FarmArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class FarmController extends Controller
{

// index farm-management//
public function index()
    {
        $barangays = Barangay::all();
    return view('pages.farms.index')->with('barangays', $barangays);
    }

    public function viewArchiveFarms()
    {
        $archivefarms = FarmArchive::all();
        return view('pages.farms.xfarms')->with('archivefarms', $archivefarms);
    }

public function archiveFarm(Request $request, $id)
    {
        // Find the Barangay to be archived
        $farms = Farm::findOrFail($id);

        // Create a new entry in the "barangays_archive" table
        FarmArchive::create([
            'old_id' => $farms->id,
            'barangay_name' => $farms->barangay_name,
            'farm_name' => $farms->farm_name,
            'address' => $farms->address,
            'area' => $farms->area,
            'farm_leader' => $farms->farm_leader,
            'status' => $farms->status,
            // Add other attributes as needed
        ]);

        // Delete the Barangay from the "barangays" table
        $farms->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Barangay archived successfully.');
    }


    public function updateStatus($id, $status)
    {
        $farms = Farm::find($id);
    
        if (!$farms) {
            // Handle error, farm not found
            return redirect()->back()->with('error', 'Farm not found.');
        }
    
        // Update the status
        $farms->status = $status;
        $farms->save();
    
        // Redirect back or wherever you want
        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    
    



//view farm-management//

public function filterByStatus(Request $request)
{
    $status = $request->input('status');

    if (strtolower($status) == 'all') {
        $farms = Farm::all();
    } else {
        $farms = Farm::where('status', $status)->get();
    }

    return response()->json(['farms' => $farms]);
}

public function viewFarms(Request $request)
{
    $barangayName = $request->input('barangay_name');


    $farms = DB::table('farms')
        ->join('barangays', 'farms.barangay_name', '=', 'barangays.barangay_name')
        ->where('farms.barangay_name', '=', $barangayName)
        ->select('farms.*')
        ->get();

    return view('pages.farms.view', compact('farms', 'barangayName'));
}

public function addFarms(Request $request)
{
    try {
        $request->validate([
            'barangay_name' => 'required|string|max:255',
            'farm_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'area' => 'required|numeric',
            'farm_leader' => 'required|string|max:255',
        ]);

        $barangayName = $request->input('barangay_name');
        $farmName = $request->input('farm_name');
        $address = $request->input('address');
        $area = $request->input('area');
        $farmLeader = $request->input('farm_leader');
        $status = $request->input('status', 'Created');

        Farm::create([
            'barangay_name' => $barangayName,
            'farm_name' => $farmName,
            'address' => $address,
            'area' => $area,
            'farm_leader' => $farmLeader,
            'status' => $status,
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error($e);

        // Return a response indicating a failure
        return response()->json(['success' => false, 'errors' => ['exception' => [$e->getMessage()]]], 500);
    }
}



}

