<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planting;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
{
    // Retrieve events from your database
    $plantings = Planting::select(['id', 'title', 'start_date as start', 'end_date as end'])->get();

    // If the request expects JSON, return a JSON response
    if (request()->expectsJson()) {
        return response()->json($plantings, 200);
    }

    // If it's a regular request, render the Blade view
    return view("pages.plantingcalendar", ['plantings' => $plantings]);
}

    
    public function create(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:55',
        'start_date' => 'required|string|max:55',
        'type' => 'required|string|max:55',
        'location' => 'required|string|max:55',
        'description' => 'required|string|max:55',
    ]);

    $planting = Planting::create([
        'title' => $data['title'],
        'start_date' => $data['start_date'],
        'end_date' => 1,
        'type' => $data['type'],
        'location' => $data['location'],
        'description' => $data['description'],
        'status' => 1
    ]);

    return response()->json(['planting' => $planting], 200);
}


    public function update(Request $request, $id)
    {

        $planting = Planting::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:55',
            'start_date' => 'required|string|max:55',
            'type' => 'required|string|max:55',
            'location' => 'required|string|max:55',
            'description' => 'required|string|max:55',
        ]);
        $planting->update([
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'type' => $data['type'],
            'location' => $data['location'],
            'description' => $data['description'],
        ]);

        return response()->json(['planting' => $planting], 200);
    }


    public function destroy($id)
    {
        // Delete an event from your database
        $planting = Planting::findOrFail($id);
        $planting->delete();
        return response()->json(null, 204);
    }

  

}
