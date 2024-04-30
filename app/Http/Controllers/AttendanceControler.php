<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\EventAttendance;
class AttendanceControler extends Controller
{
    public function index()
    {
        $events = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
        //dd($events);
        
        $data = DB::table('events')->where('status', '1')->orderBy('id', 'DESC')->get();
       

        return view('pages.eventattendance', ['events' => $events, 'data' => $data]);
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
        'name' => 'required|string',
        'age' => 'required|integer',
        'email' => 'required|email',
        'contact' => 'required|string',
        'address' => 'required|string',
        'barangay' => 'required|string',
        // Add more validation rules for other fields as needed
    ]);

    // Find the event
    $event = Event::find($event_id);

    // Create a new EventAttendance model instance and populate it with the form data
    $attendance = new EventAttendance();
    $attendance->name = $validatedData['name'];
    $attendance->age = $validatedData['age'];
    $attendance->email = $validatedData['email'];
    $attendance->contact = $validatedData['contact'];
    $attendance->address = $validatedData['address'];
    $attendance->barangay = $validatedData['barangay'];
    // Add more fields as needed

    // Save the model instance to the database
    $event->attendees()->save($attendance);

    // Redirect the user to a success page or display a success message
    return redirect()->route('pages.form');
}

}
