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
        $farm = DB::table('farms')
            ->leftJoin('users', 'users.id', '=', 'farms.farm_leader')
            ->where('farms.status', 1)
            ->orderBy('farms.id', 'desc')
            ->select(
                'farms.id as farm_id',
                'farms.farm_name as farm_name',
                'users.id as user_id',
                'users.firstname',
                "users.lastname",
                'farms.area',
                'farms.address',
                'farms.farm_leader'
            )
            ->get();

        return response()->json($farm);
    }

    public function farmInfo($id)
    {
        $farm = DB::table('farms')
            ->leftJoin('users', 'users.id', '=', 'farms.farm_leader')
            ->where('farms.status', 1)
            ->where('farms.id', $id)
            ->orderBy('farms.id', 'desc')
            ->select(
                'farms.id as farm_id',
                'farms.farm_name as farm_name',
                'users.id as user_id',
                'users.firstname',
                "users.lastname",
                'farms.area',
                'farms.address',
                'farms.farm_leader'
            )
            ->get();

        return response()->json($farm);
    }


    public function create(Request $request)
    {
        $data = $request->validate([
            'farm_name' => 'required|string|max:55',
            'area' => 'required|string|max:55',
            'address' => 'required|string|max:55',
            'farm_leader' => 'required|string|max:55',
            'createdBy' => 'required|string|max:55'
        ]);
        $farm = Farm::create([
            'farm_name' => $data['farm_name'],
            'area' => $data['area'],
            'address' => $data['address'],
            'farm_leader' => $data['farm_leader'],
            'createdBy' => $data['createdBy'],
            'status' => 1
        ]);

        return response(compact('farm'));
    }

    public function update(Request $request, $id)
    {
        $farm = Farm::findOrFail($id);
        $data = $request->validate([
            'farm_name' => 'required|string|max:55',
            'area' => 'required|string|max:55',
            'address' => 'required|string|max:55',
            'farm_leader' => 'required|int',
        ]);
        $farm->update([
            'farm_name' => $data['farm_name'],
            'area' => $data['area'],
            'address' => $data['address'],
            'farm_leader' => $data['farm_leader'],
        ]);

        return response(compact('farm'));
    }

    public function archive(Request $request, $id)
    {
        $farm = Farm::findOrFail($id);
        $farm->update([
            'status' => 0
        ]);

        return response(compact('farm'));
    }
}
