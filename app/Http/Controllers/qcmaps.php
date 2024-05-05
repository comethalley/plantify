<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmLocation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class qcmaps extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        return view('pages.qcmaps');
    }
    
    public function getMaps()
    {
        $farmLocations = FarmLocation::with('farmLeader')->where('status', 1)->get();
        return response()->json($farmLocations);
    }
    


    public function store(Request $request)
    {
        $item = new FarmLocation();
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->location_name = $request->location_name;
        $item->address = $request->address;
        $item->status = $request->status;
        $item->save();

        return redirect('/farm_locations');
    }

    public function index2()
    {
        $id = Auth::user()->id;
        $farm_locations = FarmLocation::where('status', 1)->get(); // Fetch all farm locations
        return view('pages.qcmaps_list', ['farm_locations' => $farm_locations]); 
    }

    public function deleteLocation(Request $request, $id)
    {
        $location = FarmLocation::find($id);
        if (!$location) {
            return response()->json(['error' => 'Farm Location not found'], 404);
        }

        $location->status = 0; // Set status to 0 instead of deleting
        $location->save();

        // Fetch updated list of farm locations
        $updatedLocations = FarmLocation::all();

        return response()->json([
            'message' => 'Farm Location status updated successfully',
            'updatedLocations' => $updatedLocations,
        ]);
    }



}
