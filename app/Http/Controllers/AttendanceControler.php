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
            ->select('first_name', 'last_name', 'email', 'barangay')
            ->get();
        
        return response()->json($attendees);
    }
    public function showAttendanceList($id)
    {
        
    $event = EventAttendance::where('event_id', $id)->get();
    if ($event) {
        return view('pages.eventattendees', ['event' => $event]);
    } else {
        // Handle the case where no attendees are found for the specified event ID
        return view('pages.noattendees');
    }
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
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'middleInitial' => 'nullable|string|max:1',
        'email' => 'required|email',
        'contact' => 'required|string',
        'age' => 'required|integer',
        'address' => 'required|string',
        'barangay' => 'required|string',
        // Add more validation rules for other fields as needed
    ]);

    // Find the event
    $event = Event::find($event_id);

    // Create a new EventAttendance model instance and populate it with the form data
    $attendance = new EventAttendance();
    $attendance->first_name = $validatedData['firstName'];
    $attendance->last_name = $validatedData['lastName'];
    $attendance->middle_initial = $validatedData['middleInitial'];
    $attendance->email = $validatedData['email'];
    $attendance->contact = $validatedData['contact'];
    $attendance->age = $validatedData['age'];
    $attendance->address = $validatedData['address'];
    $attendance->barangay = $validatedData['barangay'];
    // Add more fields as needed

    // Save the model instance to the database
    $event->attendees()->save($attendance);
    Mail::to($request->email)->send(new WelcomeMail());
    // Redirect the user to a success page or display a success message
    return redirect('/schedules');
}


}
