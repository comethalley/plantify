<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
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
    
    public function updateStatus(Request $request)
    {
        // Validate the incoming request
        $attendeeId = $request->input('attendee_id');
    
    // Find the attendee by ID
    $attendee = EventAttendance::find($attendeeId);
    
    // Check if attendee exists
    if (!$attendee) {
        return response()->json(['success' => false, 'message' => 'Attendee not found'], 404);
    }
    
    // Update the status
    $attendee->status = 2; // Assuming 2 represents the new status value
    
    // Save the updated attendee
    $attendee->save();
    
    return response()->json(['success' => true]);
    
    }
    

    public function attendees(Request $request) {
        $eventId = $request->input('id');
     
        // Fetch event details based on the $eventId from the database
        $event = Event::find($eventId);
    
        // Fetch attendees for the event with status value 1
        $attendeesWithStatus1 = EventAttendance::where('event_id', $eventId)
                            ->where('status', 1)
                            ->select('id','first_name', 'last_name', 'email', 'barangay', 'status')
                            ->get();
    
        // Fetch attendees for the event with status value 2 (or any other value as needed)
        $attendeesWithStatus2 = EventAttendance::where('event_id', $eventId)
                            ->where('status', 2)
                            ->select('first_name', 'last_name', 'email', 'barangay', 'status')
                            ->get();
    
        return view('pages.eventattendees', ['event' => $event, 'attendeesWithStatus1' => $attendeesWithStatus1, 'attendeesWithStatus2' => $attendeesWithStatus2]);
    }
    
    
    public function attendanceForm($id) {
        $event = Event::find($id);
    
    // Fetch user details based on the $id from the database
    $user = User::find($id);

    // Check if user exists
    $user = auth()->user();

    // Check if user exists
    if (!$user) {
        // Handle the case where user is not found
        // For example, you can redirect back with an error message
    }

    // Pass the event and user details to the blade view
    return view('pages.form', ['event' => $event, 'user' => $user]);
    }


public function submit(Request $request, $event_id, $user_id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'middle_initial' => 'nullable|string|max:3',
        'email' => 'required|email',
        'contact' => 'required|string',
        'age' => 'required|integer',
        'address' => 'required|string',
        'barangay' => 'required|string',
    ]);

    // Find the event
    $event = Event::find($event_id);
    $user = User::find($user_id);
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
