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
            'title_land' => $farms->title_land,
            'picture_land' => $farms->picture_land,
            // Add other attributes as needed
        ]);

        // Delete the Barangay from the "barangays" table
        $farms->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Barangay archived successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        // Validate the request if needed
        $request->validate([
            'status' => 'required|in:For-Investigation,For-Visiting,Approved,Disapproved',
        ]);

        // Find the farm by ID
        $farms = Farm::find($id);

        if (!$farms) {
            // Handle the case when the farm is not found
            return response()->json(['error' => 'Farm not found'], 404);
        }

        // Update the status
        $farms->status = $request->input('status');
        $farms->save();

        // You can return a response as needed
        return response()->json(['message' => 'Status updated successfully']);
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
            'title_land' => 'required|file|mimes:pdf,png,jpg|max:2048',
            'picture_land' => 'required|file|mimes:jpeg,png|max:2048',
            'status' => 'string|max:255',
        ]);

        $barangayName = $request->input('barangay_name');
        $farmName = $request->input('farm_name');
        $address = $request->input('address');
        $area = $request->input('area');
        $farmLeader = $request->input('farm_leader');
        $status = $request->input('status', 'Created');

        // Handle file uploads and store file content
        $titleLandContent = file_get_contents($request->file('title_land')->getRealPath());
        $pictureLandContent = file_get_contents($request->file('picture_land')->getRealPath());

        // Extract file names without directory path
        $titleLandFileName = $request->file('title_land')->getClientOriginalName();
        $pictureLandFileName = $request->file('picture_land')->getClientOriginalName();

        Farm::create([
            'barangay_name' => $barangayName,
            'farm_name' => $farmName,
            'address' => $address,
            'area' => $area,
            'farm_leader' => $farmLeader,
            'status' => $status,
            'title_land' => $titleLandFileName,
            'picture_land' => $pictureLandFileName,
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

