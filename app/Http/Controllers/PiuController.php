<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\piu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PiuController extends Controller
{
    public function index()
    {
        $piu = DB::table('plant_infos')
            ->where('status', 1)
            ->select("*")
            ->get();
        
        return view("pages.piu", ['piu' => $piu]);
    }

    public function show($id)
    {
        $piu = DB::table('plant_infos')
        ->where('status', 1)
        ->where('id', $id)
        ->select("*")
        ->first();

        //dd($piu);
        
        return view("pages.show", ['piu' => $piu,]);
    }
  
}
