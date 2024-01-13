<?php

namespace App\Http\Controllers;

use App\Models\Eventcalendar;
use Illuminate\Http\Request;

class EventCalendarController extends Controller
{
    public function index()
    {
        return view("pages.eventcalendar");
    }
    public function createEvent(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:55',
            'title' => 'required|string|max:55',
            'event-date' => 'required|date',
            'start-time' => 'required|timestamp',
            'end-time' => 'required|timestmp',
            'event-location' => 'required|string|max:55',
            'description' => 'required|string|max:55'
        ]);

        // if ($validator->fails()) {
        //     return redirect('/inventory')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        Eventcalendar::create([
            'name' => $data['supplier-name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'status' => 1
        ]);

        return redirect('/inventory');
    }

}
