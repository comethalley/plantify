<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantInfo;

class PlantinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantinfo = Plantinfo::all();
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
        return view('plantinfo.edit')->with('plantinfo', $plantinfo);
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
        $plantinfo = Plantinfo::find($id);
        $input = $request->all();
        $plantinfo->update($input);
        return redirect('/plantinfo')->with('flash_message', 'Plant Updated!');
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

    
}
