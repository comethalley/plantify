<?php

namespace App\Http\Controllers;

use App\Models\events;
use Illuminate\Http\Request;

class eventcontroller extends Controller
{
    public function create (Request $request){
        $data = $request->validate([
            'events_title'  => 'required|string|max:55',
            'body' => 'required|string|max:55',
            'createdBy' => 'required|string|max:55',
        ]);

        $events = events::create([
            'events_title' => $data['events_title'],
            'body' => $data['body'],
            'createdBy' => $data['createdBy'],
            'status' => 1
        ]);

        return response(compact('events'));
    }
 
    public function edit($id)
    {
        $events = events::findOrFail($id);
        return view('events.edit', compact('events'));
    }

    public function update(Request $request, $id)
    {
        $events = events::findorfail($id);

        if (!$events) {
            return response()->json(['message' => 'event not found'], 404);
             }

             $validatedData = $request->validate([
            'event_title'  => 'required|string|max:55',
            'body' => 'required|string|max:55',
            'createdBy' => 'required|string|max:55',
            
         ]);

        $events->update($validatedData);

        return redirect()->route('events.index')->with('success', 'events updated successfully');
    }
   
   

    // Update the plant with the validated data
  

    
}
