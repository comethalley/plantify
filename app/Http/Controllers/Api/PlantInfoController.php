<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantInfoController extends Controller
{
    public function index()
    {
        $plantinfo = DB::table('plant_infos')->where('status', 1)->orderBy('id', 'desc')->get();
        return response()->json($plantinfo);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'plant_name' => 'required|string|max:55',
            'planting_date' => 'required|string|max:55',
            'information' => 'required|string',
            'companion' => 'required|string'
        ]);
        $plantinfo = PlantInfo::create([
            'plant_name' => $data['plant_name'],
            'planting_date' => $data['planting_date'],
            'information' => $data['information'],
            'companion' => $data['companion'],
            'status' => 1
        ]);

        return response(compact('plantinfo'));
    }

    public function update(Request $request, $id)
    {
        $plantinfo = PlantInfo::findOrFail($id);
        $data = $request->validate([
            'plant_name' => 'required|string|max:55',
            'planting_date' => 'required|string|max:55',
            'information' => 'required|string|max:55',
            'companion' => 'required|string|max:55',
        ]);
        $plantinfo->update([
            'plant_name' => $data['plant_name'],
            'planting_date' => $data['planting_date'],
            'information' => $data['information'],
            'companion' => $data['companion']
        ]);

        return response(compact('plantinfo'));
    }

    public function archive(Request $request, $id)
    {
        $plantinfo = PlantInfo::findOrFail($id);
        $plantinfo->update([
            'status' => 0
        ]);

        return response(compact('plantinfo'));
    }
}
