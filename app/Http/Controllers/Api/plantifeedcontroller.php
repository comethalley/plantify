<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plantifeed;

class plantifeedcontroller extends Controller
{
    public function index()
    {
        $plantifeeds = Plantifeed::all();
        return response()->json($plantifeeds);
    }

    public function store(Request $request)
    {
        $plantifeed = Plantifeed::create($request->all());
        return response()->json($plantifeed, 201);
    }

    public function show($id)
    {
        $plantifeed = Plantifeed::findOrFail($id);
        return response()->json($plantifeed);
    }

    public function update(Request $request, $id)
    {
        $plantifeed = Plantifeed::findOrFail($id);
        $plantifeed->update($request->all());
        return response()->json($plantifeed, 200);
    }

    public function destroy($id)
    {
        $plantifeed = Plantifeed::findOrFail($id);
        $plantifeed->update($request->status("0"));
        return response()->json(null, 204);
    }
}
