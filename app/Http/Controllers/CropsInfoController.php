<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

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

    public function update(Request $request, $id){
        
        // Validation rules for the input data
        $rules = [ 
            'plant_name'  => 'required|string|max:55',
            'information' => 'required|string|max:55',
            'companion' => 'required|string|max:55',
        ];


        // Find the crop by ID
        $crops = Crop::find($id);


        // Update the crop with the new data
        $crops->update([
            'plant_name' => $request->input('plant_name', $crops->plant_name),
            'information' => $request->input('information', $crops->information),
            'companion' => $request->input('companion', $crops->companion),
        ]);

        // Reload the model to get the updated data
        $crops->refresh();

        return response(compact('crops'));

    }
    public function archive(Request $request, $id){
        

        $data = $request->validate([
            'plant_name'  => 'required|string|max:55',
            'information' => 'required|string|max:55',
            'companion' => 'required|string|max:55',
        ]);
        // Validation rules for the input data



        // Find the crop by ID
        $crops = Crop::find($id);


        // Update the crop with the new data
        $crops->update([
            'status' => 0
        ]);

        // Reload the model to get the updated data
        $crops->refresh();

        return response(compact('crops'));

    }

    
}
