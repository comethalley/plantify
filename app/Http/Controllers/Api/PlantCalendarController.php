<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlantCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantCalendarController extends Controller
{
    public function index()
    {
        $plantingCalendar = DB::table('plant_calendars')->where('status', 1)->get();
        return response()->json($plantingCalendar);
    }
    public function create(Request $request)
    {
        $data = $request->validate([
            'crops'  => 'required|string|max:55',
            'planting_month'  => 'required|string|max:55',
            'planting_date' => 'required|string|max:55',
            'harvest_date' => 'required|string|max:55',
            'companion' => 'required|string|max:55'
        ]);
        $plant = PlantCalendar::create([
            'crops'  => $data['crops'],
            'planting_month'  => $data['planting_month'],
            'planting_date' => $data['planting_date'],
            'harvest_date' => $data['harvest_date'],
            'companion' => $data['companion'],
            'status' => 1
        ]);

        return response(compact('plant'));
    }

    public function update(Request $request, $id)
    {

        $plant = PlantCalendar::findOrFail($id);

        $data = $request->validate([
            'crops'  => 'required|string|max:55',
            'planting_month'  => 'required|string|max:55',
            'planting_date' => 'required|string|max:55',
            'harvest_date' => 'required|string|max:55',
            'companion' => 'required|string|max:55'
        ]);
        $plant->update([
            'crops'  => $data['crops'],
            'planting_month'  => $data['planting_month'],
            'planting_date' => $data['planting_date'],
            'harvest_date' => $data['harvest_date'],
            'companion' => $data['companion'],
        ]);

        return response(compact('plant'));
    }

    public function archive(Request $request, $id)
    {

        $plant = PlantCalendar::findOrFail($id);

        $plant->update([
            'status' => 0
        ]);

        return response(compact('plant'));
    }
}
