<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Barangay;
use App\Models\BarangayArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class FarmController extends Controller
{

    public function index()
    {
        $barangays = Barangay::all();
    return view('pages.farms.index')->with('barangays', $barangays);
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


public function createFarms(Request $request)
{
    try {
        $request->validate([
            'barangay-name' => 'required|string|max:55',
        ]);

        $barangayName = $request->input('barangay-name');

        $existingBarangay = Barangay::where('barangay_name', $barangayName)->first();

        if ($existingBarangay) {
            return response()->json(['success' => false, 'errors' => ['barangay-name' => ['Barangay already exists.']]], 422);
        }

        Barangay::create([
            'barangay_name' => $barangayName,
        ]);

        return response()->json(['success' => true]);
    } catch (QueryException $e) {
        // Log the exception for debugging
        \Log::error($e);

        // Return a response indicating a failure
        return response()->json(['success' => false, 'errors' => ['database' => ['Error saving data.']]], 500);
    }
}

public function archiveBarangay(Request $request, $id)
    {
        // Find the Barangay to be archived
        $barangays = Barangay::findOrFail($id);

        // Create a new entry in the "barangays_archive" table
        BarangayArchive::create([
            'barangay_name' => $barangays->barangay_name,
            // Add other attributes as needed
        ]);

        // Delete the Barangay from the "barangays" table
        $barangays->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Barangay archived successfully.');
    }

}

