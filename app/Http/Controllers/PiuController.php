<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\piu;
use App\Models\piupes;
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
        
        return view("pages.piu.piu", ['piu' => $piu]);
    }

    public function pes()
    {
        $pes = DB::table('pesticides')
        ->where('pes_status', 1)
        ->select("*")
        ->get();

        return view('pages.piu.pes', ['pes' => $pes]);
    }


    public function fer()
    {
        $piu = DB::table('plant_infos')
            ->where('status', 1)
            ->select("*")
            ->get();
        
        return view("pages.piu.fiu", ['piu' => $piu]);
    }

    public function show($id)
    {
        $piu = DB::table('plant_infos')
        ->where('status', 1)
        ->where('id', $id)
        ->select("*")
        ->first();

        //dd($piu);
        
        return view("pages.piu.show", ['piu' => $piu,]);
    }

    public function showfiu($id)
    {
        $piu = DB::table('plant_infos')
        ->where('status', 1)
        ->where('id', $id)
        ->select("*")
        ->first();

        //dd($piu);
        
        return view("pages.fiu.show", ['piu' => $piu,]);
    }

    public function showpes($id)
    {
        $pes = DB::table('pesticides')
        ->where('pes_status', 1)
        ->where('id', $id)
        ->select("*")
        ->first();

        //dd($piu);S
        
        return view("pages.piu.showpes", ['pes' => $pes,]);
    }
    
  
}
