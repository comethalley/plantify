<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cropsplanted;

class cropsplantedcontroller extends Controller
{
    public function index()
    {
        $cropsplanted = cropsplanted::all();
        return response()->json($cropsplanted);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'farm_id' => 'required|string|max:55',
            'crops' => 'required|string|max:55',
            'area' => 'required|string|max:55',
            'date_planted' => 'required|string|max:55',
            'target_harvest' => 'required|string|max:55',
            'harvest_date' => 'required|string|max:55',
            'farm_status_id' => 'required|string|max:55',
        ]);
        $cropsplanted = cropsplanted::create([
            'farm_id' => $data['farm_id'],
            'crops' => $data['crops'],
            'area' => $data['area'],
            'date_planted' => $data['date_planted'],
            'target_harvest' => $data['target_harvest'],
            'harvest_date' => $data['harvest_date'],
            'farm_status_id' => $data['farm_status_id'],
            'status' => 1,
        ]);

        return response()->json($cropsplanted, 201);
    }

    public function show($id)
    {
        $cropsplanted = cropsplanted::findOrFail($id);
        return response()->json($cropsplanted);
    }

    public function update(Request $request, $id)
    {
        $cropsplanted = cropsplanted::findOrFail($id);
        $cropsplanted->update($request->all());
        return response()->json($cropsplanted, 200);
    }

    public function archive(Request $request, $id)
    {

        $cropsplanted = cropsplanted::findOrFail($id);

        $data = $request->validate([
            'farm_id'        => 'required|string', // Assuming farm_id is an integer
            'crops'          => 'required|string|max:55',
            'area'           => 'required|string', // Assuming area is a numeric value
            'date_planted'   => 'required|string', // Assuming date_planted is a date
            'target_harvest' => 'required|string', // Assuming target_harvest is a date
            'harvest_date' => 'required|string', // Assuming harvested_date is a date
            'farm_status_id' => 'required|string', // Assuming farm_status_id is an integer
        ]);
        $cropsplanted->update([
            'status' => 0
        ]);

        return response()->json($cropsplanted, 202);
    }
}