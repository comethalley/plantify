<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;

class eventcontroller extends Controller
{
      //
      public function index()
      {
          $events = DB::table('events')->orderBy('id', 'DESC')->get();
          return view('pages.eventscalendar',['events'=>$events]);
      }
  
      public function create(Request $request)
      {
          $item = new event();
          $item->title = $request->title;
          $item->start = $request->start;
          $item->end = $request->end;
          $item->location = $request->location;
          $item->description = $request->description;
          $item->save();
  
          return redirect('/fullcalendar');
      }
      
      
      public function getEvents()
      {
          $event = event::all();
          return response()->json($event);
          
      }
      
    
      public function deleteEvent(Request $request, $id)
      {
          $event = event::find($request->id)->delete();
          return response()->json($event);
      }
  
      public function update(Request $request, $id)
      {
          $event = Schedule::findOrFail($id);
  
          $event->update([
              'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
              'end' => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
          ]);
  
          return response()->json(['message' => 'Event moved successfully']);
      }
  
      public function resize(Request $request, $id)
      {
          $event = event::findOrFail($id);
  
          $newEndDate = Carbon::parse($request->input('end_date'))->setTimezone('UTC');
          $event->update(['end' => $newEndDate]);
  
          return response()->json(['message' => 'Event resized successfully.']);
      }
  
      public function search(Request $request)
      {
          $searchKeywords = $request->input('title');
  
          $matchingEvents = Schedule::where('title', 'like', '%' . $searchKeywords . '%')->get();
  
          return response()->json($matchingEvents);
      }
  
      
}
