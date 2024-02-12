<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
        //dd($events);
        
        $data = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
        return view('pages.eventscalendar', ['events' => $events, 'data' => $data]);
    }
    public function create(Request $request)
    {
        $item = new Event();
        $item->title = $request->title;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->location = $request->location;
        $item->description = $request->description;
        $item->status = 1;
        $item->save();

        return redirect('/schedules');
    }


    public function getEvents()
    {
       $events = Event::where('status', '!=', 0)->get();
        
        return response()->json($events);
    }

    public function getdata($id)
    {
        $data = DB::table('events')->where('id', $id)->orderBy('id', 'DESC')->get();
        //return view('pages.eventscalendar',['data'=>$data]);
        //dd($data);
        return view('pages.eventscalendar', ['data' => $data]);
    }


    public function deleteEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        if (!$event) {
            return response()->json(['message' => 'The supplier does not exist'], 422);
        }

        $event->update([
            'status' => 0,
        ]);
        return response()->json(['message' => 'Supplier Archive successfully']);
    }

    public function update(Request $request, $id)
    { 
        $events = Event::find($request->id);
        $events->title = $request->input('updatetitle');
        $events->start = $request->input('updatestart');
        $events->end = $request->input('updateend');
        $events->location = $request->input('updatelocation');
        $events->description = $request->input('updatedescription');
        $events->update();

       return response()->json(['events' => $events]);

      
    }
    public function resize(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $newEndDate = Carbon::parse($request->input('end'))->setTimezone('UTC');
        $event->update(['end' => $newEndDate]);

        return response()->json(['message' => 'Event resized successfully.']);
    }

    public function search(Request $request)
    {
        $searchKeywords = $request->input('title');

        $matchingEvents = Event::where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }
}
