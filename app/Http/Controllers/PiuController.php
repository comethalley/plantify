<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\piu;
use App\Models\piupes;
use App\Models\piufer;
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

        $fer = DB::table('fertilizers')
            ->where('fer_status', 1)
            ->select(
                "*"
            )
            ->get();

        return view('pages.piu.fiu' , ['fer' => $fer]);
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
        $fer = DB::table('fertilizers')
        ->where('fer_status', 1)
        ->where('id', $id)
        ->select("*")
        ->first();

        //dd($piu);
        
        return view("pages.piu.showfiu", ['fer' => $fer,]);
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

   public function searchpiu()
   {
        $search = $request->plant_name;

        if($search != "")
        {
            $piu = DB::table('plant_infos')
            ->where('name', "LIKE", "%$request")
            ->first("*");
            if($piu)
            {
                return redirect ('piu/'.$piu->show.'/'.$piu->id );
            }
            else
            {
                return redirect ()->back()->with("status", "No plant matched your search");
            }
        }
        else 
        {
            return redirect ()->back();
        }
   }
    
}
