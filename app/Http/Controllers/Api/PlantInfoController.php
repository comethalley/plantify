<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Pesticides;

class PlantinfoController extends Controller
{
    public function index()
    {
        $plantinfo = DB::table('plant_infos')
            ->where('status', 1)
            ->select(
                "*"
            )
            ->get();
        //return view('plantinfo.index')->with('plantinfo', $plantinfo);
        //dd($plantinfo);
        return view("pages.plantinfo.index", ['plantinfo' => $plantinfo]);
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
        // Validate the request
        $request->validate([
            'plant_name' => 'required',
            'seasons' => 'required',
            'information' => 'required',
            'companion' => 'required',
            'days_harvest' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
        ]);

        // Retrieve all input data
        $input = $request->all();

        // Move the uploaded image to a specific directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }

        // Create new plant info record
        plantinfo::create($input);

        return redirect('plant-info')->with('flash_message', 'Plant Added!');
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
    $plantinfo = PlantInfo::where('id', $id)->where('status', 1)->first(); // Add first() to retrieve the record

    $validator = Validator::make($request->all(), [
        'edit_plant_name' => 'required|string|max:55',
        'edit_image' => 'required|string|max:55',
        'edit_seasons' => 'required|string|max:55',
        'edit_information' => 'required|string|max:55',
        'edit_companion' => 'required|string|max:55',
        'edit_days_harvest' => 'required|string|max:55'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $data = $validator->validated(); // Use validated() to retrieve validated data

    $plantinfo->update([
        "plant_name" => $data['edit_plant_name'],
        "image" => $data['edit_image'],
        "seasons" => $data['edit_seasons'], // Corrected field name
        "information" => $data['edit_information'],
        "companion" => $data['edit_companion'],
        "days_harvest" => $data['edit_days_harvest'] // Added days_harvest field
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

    public function restore()
    {
        $plantinfo = DB::table('plant_infos')
            ->where('status', 0)
            ->select(
                "*"
            )
            ->get();
        //return view('plantinfo.index')->with('plantinfo', $plantinfo);
        //dd($plantinfo);
        return view("pages.plantinfo.restore", ['plantinfo' => $plantinfo]);
    }

    public function unarchive(Request $request, $id)
    {
        // $plantinfo = Plantinfo::find($id);
        // $input = $request->all();
        // $plantinfo->update($input);
        // return redirect('/plantinfo')->with('flash_message', 'Plant Updated!');

        $plantinfo = PlantInfo::where('id', $id)->where('status', 0);



        $plantinfo->update([
            "status" => 1

        ]);
        return response()->json(['plantinfo' => $plantinfo], 200);
    }

    public function pesticides()
    {
        $pesticides = DB::table('pesticides')
        ->where('pes_status', 1)
        ->select(
            "*"
        )
        ->get();

        return view('pages.plantinfo.pesticides', ['pesticides' => $pesticides]);
    }

    public function pstore(Request $request)
    {
        // Validate the request
        $request->validate([
            'pes_name' => 'required',
            'pes_information' => 'required',
            'pes_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
        ]);

        // Retrieve all input data
        $input = $request->all();

        // Move the uploaded image to a specific directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }
        $input['pes_status'] = 1;

        // Create new plant info record
        Pesticides::create($input);

        return redirect('pesticides')->with('flash_message', 'Plant Added!');
    }

    public function fertilizers()
    {

        $fertilizers = DB::table('fertilizers')
            ->where('status', 1)
            ->select(
                "*"
            )
            ->get();

        return view('pages.plantinfo.fertilizers' , ['fertilizers' => $fertilizers]);
    }

    


}
