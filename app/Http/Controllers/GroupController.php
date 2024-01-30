<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupThread;
use App\Models\GroupMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GroupController extends Controller
{
    public function index()
    {    
        return view('pages.groups');
    }

    public function create()
    {
        // Show a form to create a new group
        return view('groups.create');
    }

    /**
     * Display the chat list and messages in the group view.
     *
     * @param  int  $groupId
     * @return \Illuminate\View\View
     */
    public function show($groupId, $farmId)
    {
        try {
            // Retrieve the group
            $group = Group::findOrFail($groupId);
    
            // Check if there is a group thread for the specified group and farm
            $groupThread = GroupThread::where('group_id', $groupId)
                ->where('farm_id', $farmId)
                ->first();
    
            if (!$groupThread) {
                // If no group thread is found, return a 404 response
                abort(404);
            }
    
            // Get the currently logged-in user
            $currentUser = Auth::user();
    
            // Retrieve all other users for the chat list (excluding the logged-in user)
            $users = User::where('id', '!=', $currentUser->id)->get();
    
            // Retrieve messages for the current group thread
            $messages = $groupThread->messages;
    
            // Get a list of groups
            $groups = Group::all();
    
            // Return to the view with the updated data
            return view('pages.groups', compact('groupThread', 'users', 'messages', 'groups'));
        } catch (ModelNotFoundException $e) {
            // If the group or farm is not found, return a 404 response
            abort(404);
        }
    }
    
    

    /**
     * Store a new group message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $groupId
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeGroupMessage(Request $request, $threadId)
    {
        // Validate the incoming request data
        $request->validate([
            'content' => 'required|string',
        ]);
    
        // Create a new message in the specified group thread
        GroupMessage::create([
            'thread_id' => $threadId, // Use the correct thread ID
            'sender_id' => auth()->user()->id,
            'content' => $request->input('content'),
            'create_date' => now(),
        ]);
    
        // You might need to return a response or redirect based on your application flow
        return response()->json(['success' => true]);
    }
    
    
    

    

    public function join(Group $group)
    {
        // Add the authenticated user to the group
        GroupMember::create([
            'group_id' => $group->group_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('groups.show', ['group' => $group->group_id]);
    }




    public function redirectToGroupChat($farmId, $groupId)
{
    // Logic to retrieve the group thread based on $farmId and $groupId
    $groupThread = GroupThread::where('farm_id', $farmId)
        ->where('group_id', $groupId)
        ->first();

    if ($groupThread) {
        // Redirect to the group chat using the group thread ID
        return redirect('/group/' . $groupThread->id);
    } else {
        // Handle error (e.g., group thread not found)
        return redirect('/home')->with('error', 'Group chat not found.');
    }
}
    // Add more methods as needed for your application
}