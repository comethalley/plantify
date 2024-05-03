<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Notifications\NewNotificationEvent;
use App\Events\EventCreated;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Interest;
use App\Notifications\UpcomingEventNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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

    
    public function generateRegistrationForm($id) {
        // Fetch event details based on the $id from the database
        $event = Event::find($id);
        // Pass the event details to the blade view
        return view('pages.form', ['event' => $event]);
    
    }
    public function storeInterested(Request $request, $eventId)
    {
        // Get the event
        $event = Event::findOrFail($eventId);
        
        // Store the interest
        $event->interestedUsers()->attach(auth()->id());
    
        return response()->json(['message' => 'Interest stored successfully']);
    }
    public function show($id)
    {
        $event = Event::findOrFail($id); // Assuming Event is your model representing events

        return response()->json($event);
    }
    public function create(Request $request)
    {
        $item = new Event();
        $item->title = $request->title;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->starttime = $request->starttime;
        $item->endtime = $request->endtime;
        $item->visibility = $request->visibility;
        $item->location = $request->location;
        $item->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assests/images/event'), $imageName);
            //$input['image'] = $imageName;
        }


        $item->image = $imageName;
        $item->status = 1;
        $item->save();

        $title = $request->title;

        $users = auth()->user();
            $users = User::all();
        
            foreach ($users as $user) {
                $event = new Event();
                $event->title = $title;
                $user->notify(new NewNotificationEvent($event));
            }
            sleep(3);

           
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
        return response()->json($data);
    }


    public function deleteEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $updatedEvents = Event::all();
        if (!$event) {
            return response()->json(['message' => 'The supplier does not exist'], 422);
        }

        $event->update([
            'status' => 0,
        ]);
        return response()->json([
            'message' => 'Planting deleted successfully',
            'events' => $updatedEvents,]);
    }

    public function update(Request $request, $id)
    {
       // Validate the incoming request data
       $request->validate([
        'title' => 'required|string|max:255',
        'start' => 'required|date',
        'end' => 'required|date',
        'location' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Find the event by ID
    $event = Event::findOrFail($id);

    // Update the event with the new data
    $event->update([
        'title' => $request->title,
        'start' => $request->start,
        'end' => $request->end,
        'location' => $request->location,
        'description' => $request->description,
    ]);

    // Optionally, you can return a response indicating success
    return response()->json(['message' => 'Event updated successfully']);

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
        $ $searchKeywords = $request->input('title');

        $matchingEvents = CalendarPlanting::where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }
    
}
