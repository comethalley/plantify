<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmLocation;

class qcmaps extends Controller
{
    public function index()
    {
        $farmLocations = FarmLocation::all();
    
        $formattedLocations = $farmLocations->map(function ($location) {
            return [
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'location_name' => $location->location_name,
            ];
        });
        return view('pages.qcmaps', compact('formattedLocations'));
    }
    

    public function store(Request $request)
{
    $item = new FarmLocation();
    $item->latitude = $request->latitude;
    $item->longitude = $request->longitude;
    $item->location_name = $request->location_name;
    $item->save();

    return redirect('/farm_locations');
}

}
