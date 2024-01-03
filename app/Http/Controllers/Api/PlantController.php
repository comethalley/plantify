<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planting;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        // Retrieve events from your database and return as JSON
        $plantings = Planting::all();
        return view("pages.plantingcalendar", ['plantings' => $plantings]);
    }

    public function store(Request $request)
    {
        // Create a new event in your database
        $planting = Planting::create($request->all());
        return response()->json($planting);
    }

    public function update(Request $request, $id)
    {
        // Update an existing event in your database
        $planting = Planting::findOrFail($id);
        $planting->update($request->all());
        return response()->json($planting);
    }

    public function destroy($id)
    {
        // Delete an event from your database
        $planting = Planting::findOrFail($id);
        $planting->delete();
        return response()->json(null, 204);
    }
}
