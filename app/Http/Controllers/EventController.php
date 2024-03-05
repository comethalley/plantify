<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Message_notif;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
class EventController extends Controller

{
    //
    public function index()
    {
        $events = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
        //dd($events);
        $notifications = DB::select("SELECT users.id, users.firstname, users.lastname, users.email, COUNT(is_read) AS unread FROM users LEFT JOIN message_notifs ON users.id = message_notifs.from AND message_notifs.is_read = 0 WHERE users.id = ".Auth::id()." GROUP BY users.id, users.firstname, users.lastname, users.email");
        $data = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
        return view('pages.eventscalendar', ['events' => $events, 'data' => $data, 'notifications' => $notifications]);
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
        
        $title = $request->title;

        $message = new Message_notif();
        $message->from = Auth::user()->id;
        $id = $message->from;
        $message->message = $title;
        $message->save();

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );


        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );


        $data = ['from' => $id];
        $pusher->trigger('my-channel', 'my-event', $data);

        if($item->save()) {

        return redirect('/schedules');
        }
    }


    public function getEvents()
    {
        $event = Event::all();
        return response()->json($event);
    }

    public function getdata($id)
    {
        $data = DB::table('events')->where('id', $id)->orderBy('id', 'DESC')->get();
        //return view('pages.eventscalendar',['data'=>$data]);
        //dd($data);
        return response()->json($data);
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

        $newEndDate = Carbon::parse($request->input('end_date'))->setTimezone('UTC');
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
