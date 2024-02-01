<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CalendarPlanting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlantCalendar extends Controller
{
    public function index()
    {
        $events = CalendarPlanting::orderBy('id', 'DESC')->get();

        return view('pages.plantingcalendar', ['createplantings' => $events]);
    }

    public function create(Request $request)
    {
        $item = new CalendarPlanting();
        $item->title = $request->title;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->status = $request->status;
        $item->description = $request->description;
        $item->save();

        return redirect('/plantcalendar');
    }

    public function getEvents()
    {
        $events = CalendarPlanting::all();

        // Include additional details in the response
        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'status' => $event->status,
                'description' => $event->description,
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

        $start = $request->input('start') ? Carbon::parse($request->input('start'))->format('Y-m-d H:i:s') : null;
        $end = $request->input('end') ? Carbon::parse($request->input('end'))->format('Y-m-d H:i:s') : null;

        $event->update([
            'title' => $request->input('title'),
            'start' => $start,
            'end' => $end,
            'status' => $request->input('status'),
            'description' => $request->input('description'),
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

    

    
}
