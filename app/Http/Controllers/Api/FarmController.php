<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmController extends Controller
{

    public function index()
    {
        $farms = Farm::all();
    return view('pages.farms.index')->with('farms', $farms);
    }

    public function getFarms(Request $request)
{
    $farms = Farm::all();

    return response('pages.farms.index')->json(['farms' => $farms]);
}

public function saveFarms(Request $request)
    {
        $data = $request->validate([
            'farm_name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'address'=> 'required|string|max:255',
            'farm_leader'=> 'required|string|max:255',
            'createdBy'=> 'required|string|max:255',
            'status'=> 'required|string|max:255',
            // Add more validation rules if needed
        ]);

        Farm::create([
            'farm_name' => $data['farm_name'],
            'area' => $data['area'],
            'address' => $data['address'],
            'farm_leader' => $data['farm_leader'],
            'createdBy' => $data['createdBy'],
            'status' => $data['status'],
            // Add more fields as needed
        ]);

        return redirect('/')->with('success', 'Farm added successfully');
    }
}

