<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\EventAttendance;
use App\Mail\WelcomeMail;

use Illuminate\Support\Facades\Mail;

class AttendanceControler extends Controller
{
    public function index()
    {
        $events = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
        //dd($events);
        
        $data = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
       

        return view('pages.eventattendance', ['events' => $events, 'data' => $data]);
    }
    public function fetchAttendees($event_id)
    {
        // Fetch attendees for the specified event ID
        $attendees = EventAttendance::where('event_id', $event_id)

        ->select('first_name', 'last_name', 'email', 'barangay', 'status')
        ->get();
    
    return response()->json($attendees);
    }

    public function changeStatus($id)
    {
        $attendee = EventAttendance::findOrFail($id);
        if (!$attendee) {
            return response()->json(['error' => 'Attendee not found'], 404);
        }
    
        $attendee->update([
            'status' => 2,
        ]);
    
        return response()->json(['message' => 'Attendee status updated successfully', 'attendee' => $attendee]);
    }

      
    
   
    
    public function attendees(Request $request) {
        $eventId = $request->input('id');
        // Fetch event details based on the $eventId from the database
        $event = Event::find($eventId);
        // Pass the event details to the blade view
        return view('pages.eventattendees', ['event' => $event]);
    }
    public function attendanceForm($id) {
        // Fetch event details based on the $id from the database
        $event = Event::find($id);
        // Pass the event details to the blade view
        return view('pages.form', ['event' => $event]);
    }


public function submit(Request $request, $event_id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'middle_initial' => 'nullable|string|max:1',
        'email' => 'required|email',
        'contact' => 'required|string',
        'age' => 'required|integer',
        'address' => 'required|string',
        'barangay' => 'required|string',
    ]);

    // Find the event
    $event = Event::find($event_id);

    // Create a new EventAttendance model instance and populate it with the form data
    $attendance = new EventAttendance();
    $attendance->first_name = $validatedData['first_name'];
    $attendance->last_name = $validatedData['last_name'];
    $attendance->middle_initial = $validatedData['middle_initial'];
    $attendance->email = $validatedData['email'];
    $attendance->contact = $validatedData['contact'];
    $attendance->age = $validatedData['age'];
    $attendance->address = $validatedData['address'];
    $attendance->barangay = $validatedData['barangay'];
    $attendance->status = 1;
    // Add more fields as needed

    // Save the model instance to the database
    $event->attendees()->save($attendance);
   
    // Redirect the atten$attendance to a success page or display a success message
    return redirect('/schedules');
}


}
