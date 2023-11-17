<?php

namespace App\Http\Controllers;
use App\Models\farmmodel;
use Illuminate\Http\Request;


class farmcontroller extends Controller
{
    public function index()
    {
        $data = [
            'id' => 'id',
            'farm_name' => 'farm_name',
            'area' => 'area',
            'address' => 'address',
            'createdBy' => 'createdBy',
            'status' => 'status',
        ];
        return response()->json($data, 200);
    }

    public function create(Request $request)
        {
            $data = $request->validate([
                'farm_name' => 'required|string',
                'area' => 'required|string',
                'address' => 'required|string',
                'createdBy' => 'required|string',
                'status' => 'required|string',
            ]);
            $user = farmmodel::create([
                'farm_name' => $data['farm_name'],
                'area' => $data['area'],
                'address' => $data['address'],
                'createdBy' => $data['createdBy'],
                'status' => $data['status'],
            ]);

            return response()->json($data, 200);
        }

    public function update(Request $request, $id)
        {
            $farm = farmmodel::find($id);

            if (!$farm) {
                return response()->json(['message' => 'Farm not found'], 404);
        }

            $data = $request->validate([
                'farm_name' => 'string',
                'area' => 'string',
                'address' => 'string',
                'createdBy' => 'string',
                'status' => 'string',
             ]);

            $farm->update($data);

            return response()->json(['message' => 'Farm updated successfully', 'data' => $data], 200);
        }

        public function delete($id)
        {
            $farm = farmmodel::find($id);
    
            if (!$farm) {
                return response()->json(['message' => 'Farm not found'], 404);
            }
    
            $farm->delete();
    
            return response()->json(['message' => 'Farm deleted successfully'], 200);
        }
    
}
