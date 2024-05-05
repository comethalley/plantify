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
        $id = Auth::user()->id;
        $farmLocations = FarmLocation::all();
        return response()->json($farmLocations);
    }

    public function store(Request $request)
    {
        $item = new FarmLocation();
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->location_name = $request->location_name;
        $item->address = $request->address;
        $item->save();

        return redirect('/farm_locations');
    }

}
