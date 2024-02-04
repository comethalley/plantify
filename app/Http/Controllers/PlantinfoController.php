<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlantinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantinfo= DB::table('plant_infos')
            ->where('status', 1)
            ->select(
                "*"
            )
            ->get();
        //return view('plantinfo.index')->with('plantinfo', $plantinfo);
        //dd($plantinfo);
        return view("plantinfo.index", ['plantinfo' => $plantinfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantinfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        plantinfo::create($input);
        return redirect('plantinfo')->with('flash_message', 'Plant Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plantinfo = Plantinfo::find($id);
        return view('plantinfo.index')->with('plantinfo', $plantinfo);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plantinfo = Plantinfo::find($id);
        // return view('plantinfo.edit')->with('plantinfo', $plantinfo);
        return response()->json(['plantinfo' => $plantinfo], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $plantinfo = Plantinfo::find($id);
        // $input = $request->all();
        // $plantinfo->update($input);
        // return redirect('/plantinfo')->with('flash_message', 'Plant Updated!');

        $plantinfo = PlantInfo::where('id', $id)->where('status', 1);

        $validator = Validator::make($request->all(), [
            'edit_plant_name' => 'required|string|max:55',
            'edit_planting_date' => 'required|string|max:55',
            'edit_information' => 'required|string|max:55',
            'edit_companion' => 'required|string|max:55'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        };

        $data = $validator->validate();

        $plantinfo->update([
            "plant_name" => $data['edit_plant_name'],
            "planting_date" => $data['edit_planting_date'],
            "information" => $data['edit_information'],
            "companion" => $data['edit_companion']
        ]);
        return response()->json(['plantinfo' => $plantinfo], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plantinfo::destroy($id);
        return redirect('plantinfo')->with('flash_message', 'Plant deleted!');
    }


    public function archive(Request $request, $id)
    {
        // $plantinfo = Plantinfo::find($id);
        // $input = $request->all();
        // $plantinfo->update($input);
        // return redirect('/plantinfo')->with('flash_message', 'Plant Updated!');

        $plantinfo = PlantInfo::where('id', $id)->where('status', 1);

    

        $plantinfo->update([
            "status" => 0

        ]);
        return response()->json(['plantinfo' => $plantinfo], 200);

    }

    
}
