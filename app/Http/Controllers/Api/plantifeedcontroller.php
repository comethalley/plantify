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

    public function create(Request $request)
    {
        $data = $request->validate([
            'post_title'  => 'required|string|max:55',
            'body'  => 'required|string|max:55',
            'image' => 'required|string|max:55',
            'createdby' => 'required|string|max:55',
        ]);
        $plantifeed = Plantifeed::create([
            'post_title'  => $data['post_title'],
            'body'  => $data['body'],
            'image' => $data['image'],
            'createdby' => $data['createdby'],
            'status' => 1
        ]);

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

    public function archive(Request $request, $id)
    {

        $plantifeed = Plantifeed::findOrFail($id);

        $data = $request->validate([
            'post_title'  => 'required|string|max:55',
            'body'  => 'required|string|max:55',
            'image' => 'required|string|max:55',
            'createdby' => 'required|string|max:55',
            
        ]);
        $plantifeed->update([
            'status' => 0
        ]);

        return response()->json($plantifeed, 202);
    }
}
