<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CropsPlanted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CropsPlantedController extends Controller
{
    public function index($id)
    {
        $crops = DB::table('crops_planteds')->where('status', 1)->where('farm_id', $id)->select()->get();

        return response()->json($crops);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'farm_id'  => 'required|string|max:55',
            'crops'  => 'required|string|max:55',
            'area' => 'required|string|max:55',
            'date_planted' => 'required|string|max:55',
            'target_harvest' => 'required|string|max:55'
        ]);

        $crops = CropsPlanted::create([
            'farm_id'  => $data['farm_id'],
            'crops'  => $data['crops'],
            'area' => $data['area'],
            'date_planted' => $data['date_planted'],
            'target_harvest' => $data['target_harvest'],
            'harvested_date' => "",
            'companion' => "",
            'status' => 1
        ]);

        return response()->json($crops);
    }

    public function update(Request $request, $id)
    {
        $crops = CropsPlanted::findOrFail($id);
        $data = $request->validate([
            'farm_id'  => 'required|string|max:55',
            'crops'  => 'required|string|max:55',
            'area' => 'required|string|max:55',
            'date_planted' => 'required|string|max:55',
            'target_harvest' => 'required|string|max:55'
        ]);
        $crops->update([
            'farm_id'  => $data['farm_id'],
            'crops'  => $data['crops'],
            'area' => $data['area'],
            'date_planted' => $data['date_planted'],
            'target_harvest' => $data['target_harvest']
        ]);

        return response()->json($crops);
    }

    public function archive(Request $request, $id)
    {
        $crops = CropsPlanted::findOrFail($id);

        $crops->update([
            'status'  => 0
        ]);

        return response()->json($crops);
    }
}
