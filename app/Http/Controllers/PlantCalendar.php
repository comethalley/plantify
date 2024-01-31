<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CalendarPlanting;
use Illuminate\Http\Request;

class PlantCalendar extends Controller
{
    //
    public function index()
    {
        $events = DB::table('planting')->orderBy('id', 'DESC')->get();
        //dd($events);
        return view('pages.plantingcalendar', ['planting' => $events]);
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
        $event = CalendarPlanting::all();
        return response()->json($event);
    }

    public function getdata($id)
    {
        $data = DB::table('planting')->where('id', $id)->orderBy('id', 'DESC')->get();
        //return view('pages.eventscalendar',['data'=>$data]);
        //dd($data);
        return response()->json($data);
    }


    public function deleteEvent(Request $request, $id)
    {
        $event = CalendarPlanting::find($request->id)->delete();
        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = CalendarPlanting::findOrFail($id);

        $event->update([
            'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
            'end' => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
        ]);

        return response()->json(['message' => 'Event moved successfully']);
    }

    public function resize(Request $request, $id)
    {
        $event = CalendarPlanting::findOrFail($id);

        $newEndDate = Carbon::parse($request->input('end_date'))->setTimezone('UTC');
        $event->update(['end' => $newEndDate]);

        return response()->json(['message' => 'Event resized successfully.']);
    }

    public function search(Request $request)
    {
        $searchKeywords = $request->input('title');

        $matchingEvents = CalendarPlanting::where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }
}
