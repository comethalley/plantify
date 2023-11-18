<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropsInfoController extends Controller
{
    public function create (Request $request){
        $data = $request->validate([
            'plant_name'  => 'required|string|max:55',
            'information' => 'required|string|max:55',
            'companion' => 'required|string|max:55',
        ]);

        $crops = Crop::create([
            'plant_name' => $data['plant_name'],
            'information' => $data['information'],
            'companion' => $data['companion'],
            'status' => 1
        ]);

        return response(compact('crops'));
    }
}
