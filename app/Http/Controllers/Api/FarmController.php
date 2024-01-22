<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmController extends Controller
{

    public function index()
    {
        $barangays = Barangay::all();
    return view('pages.farms.index')->with('barangays', $barangays);
    }

    public function viewFarms(Request $request)
{
    $barangayName = $request->input('barangay_name');

    // Fetch farms based on barangay_name
    $farms = DB::table('farms')
        ->join('barangays', 'farms.barangay_name', '=', 'barangays.barangay_name')
        ->where('farms.barangay_name', '=', $barangayName)
        ->select('farms.*')
        ->get();

    return view('pages.farms.view', compact('farms', 'barangayName'));
}

}

