<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CalendarPlanting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PlantInfo;
use App\Notifications\NewplantingNotification;


class PlantCalendar extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        // $user = Auth::user();
        // $user->farm.id
        $id = Auth::user()->id;
        $plantInfo = PlantInfo::pluck('days_harvest', 'plant_name');
        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        // If the user is authenticated and is a farm leader
        if ($user->role_id === '3') {
            // Retrieve events for the farm associated with the farm leader
            $events = CalendarPlanting::where('farm_id', $user->farm_id)->orderBy('id', 'DESC')->get();
        } elseif ($user->role_id === '5') {
            $events = CalendarPlanting::where('farm_id', "00" . $user->id)->orderBy('id', 'DESC')->get();
        } else {
            // If the user is not a farm leader, retrieve all events
            $events = CalendarPlanting::orderBy('id', 'DESC')->get();
        }

        return view('pages.plantingcalendar', [
            'createplantings' => $events,
            'plantInfo' => $plantInfo
        ]);
    }

    public function create(Request $request)

    {
        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();
        
        $farm_id = "";

        if($user->role_id == "5"){
            $farm_id  = "00".$user->id;
            
        }else{
            $farm_id = $user->farm_id;
        }

        // dd($farm_id);

        $item = new CalendarPlanting();
        $item->title = $request->title;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->status = $request->status;
        $item->farm_id = $farm_id;
        $item->seed = $request->seed;
        $item->harvested = $request->harvested;
        $item->destroyed = $request->destroyed;
        $item->save();

        $title = $request->title;

        // $users = auth()->user();
        //     $users = User::all();
        
                $planting = new CalendarPlanting();
                $planting->title = $title;
                $user->notify(new NewplantingNotification($planting));
        return redirect('/plantcalendar');
    }

    public function getEvents()
    {
        // $events = CalendarPlanting::all();

        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        // If the user is authenticated and is a farm leader
        if ($user->role_id === '3') {
            // Retrieve events for the farm associated with the farm leader
            $events = CalendarPlanting::where('farm_id', $user->farm_id)->orderBy('id', 'DESC')->get();
        } elseif ($user->role_id === '5') {
            $events = CalendarPlanting::where('farm_id', "00" . $user->id)->orderBy('id', 'DESC')->get();
        } else {
            // If the user is not a farm leader, retrieve all events
            $events = CalendarPlanting::orderBy('id', 'DESC')->get();
        }

        // Include additional details in the response
        $formattedEvents = $events->map(function ($event) {

            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'status' => $event->status,
                'farm_id' => $event->farm_id,
                'harvested' => $event->harvested,
                'destroyed' => $event->destroyed,
                'seed' => $event->seed,
                // Add other fields as needed
                
            ];
        
        });

        return response()->json($formattedEvents);
    }

    public function getdata($id)
    {
        $data = CalendarPlanting::findOrFail($id);

        return response()->json($data);
    }

    public function deleteEvent(Request $request, $id)
    {
        $event = CalendarPlanting::find($id)->delete();

        $updatedEvents = CalendarPlanting::all();

        return response()->json([
            'message' => 'Planting deleted successfully',
            'events' => $updatedEvents,
        ]);

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = CalendarPlanting::findOrFail($id);

        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        $start = $request->input('start') ? Carbon::parse($request->input('start'))->format('Y-m-d') : null;
        $end = $request->input('end') ? Carbon::parse($request->input('end'))->format('Y-m-d') : null;

        $event->update([
            'title' => $request->input('title'),
            'start' => $start,
            'end' => $end,
            'status' => $request->input('status'),
            'farm_id' => $user->farm_id,
            'harvested' => $request->input('harvested'),
            'destroyed' => $request->input('destroyed'),
            'seed' => $request->input('seed'),
        ]);

        $updatedEvents = CalendarPlanting::all();

        return response()->json([
            'message' => 'Planting updated successfully',
            'events' => $updatedEvents,
        ]);

        return response()->json(['message' => 'Planting updated successfully']);
    }


    public function resize(Request $request, $id)
    {
        $event = CalendarPlanting::findOrFail($id);

        $newEndDate = Carbon::parse($request->input('end'))->setTimezone('UTC');
        $event->update(['end' => $newEndDate]);

        return response()->json(['message' => 'Event resized successfully']);
    }

    public function search(Request $request)
    {
        $searchKeywords = $request->input('title');

        $matchingEvents = CalendarPlanting::where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }

    public function calendar_list(Request $request)
    {
        // Retrieve the authenticated user
        // $user = Auth::user();
        // $user->farm.id
        $id = Auth::user()->id;
        $plantInfo = PlantInfo::pluck('days_harvest', 'plant_name');
        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        // If the user is authenticated and is a farm leader
        if ($user->role_id === '3') {
            // Retrieve events for the farm associated with the farm leader
            //$events = CalendarPlanting::where('farm_id', $user->farm_id)->orderBy('id', 'DESC')->get();

            $events = DB::table('createplantings')
                ->leftJoin('farms', 'createplantings.farm_id', '=', 'farms.id')
                ->select(
                    'createplantings.*',
                    'farms.farm_name',
                    'farms.barangay_name'
                )
                ->where('createplantings.farm_id', $user->farm_id)
                ->orderBy('createplantings.id', 'DESC')
                ->get();
        } elseif ($user->role_id === '5') {
            $farmID = (int)$user->id;

            $events = DB::table('createplantings')
                ->leftJoin('users', 'createplantings.farm_id', '=', 'users.id')
                ->select('createplantings.*')
                ->where('users.id', $farmID)
                ->orderBy('createplantings.id', 'DESC')
                ->get();
        } else {
            // If the user is not a farm leader, retrieve all events
            // $events = CalendarPlanting::orderBy('createplantings.id', 'DESC')
            // ->leftjoin('farms', 'createplantings.farm_id', '=', 'farms.id')
            // ->get();

            $events = DB::table('createplantings')
                ->leftJoin('farms', 'createplantings.farm_id', '=', 'farms.id')
                ->select(
                    'createplantings.*',
                    'farms.farm_name',
                    'farms.barangay_name'
                )
                ->orderBy('createplantings.id', 'DESC')
                ->get();
        }

        //   var_dump($events);

        return view('pages.calendar_list', [
            'createplantings' => $events,
            'plantInfo' => $plantInfo
        ]);
    }
}