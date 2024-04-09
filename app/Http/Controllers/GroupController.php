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
    /**
     * Display the chat list and messages in the group view.
     *
     * @param  int  $groupId
     * @return \Illuminate\View\View
     */
    public function show($groupId, $farmId = null)
{
    try {
        // Retrieve the group
        $group = Group::findOrFail($groupId);

        // Initialize $groupThread to null
        $groupThread = null;

        // Check if the group is "Admin and Farm Leaders"
        if ($group->group_name === 'Admin and Farm Leaders') {
            // No need to provide farm ID for Admin, set farmId to null
            $farmId = null;
        } elseif ($group->group_name === 'Farm Leader and Farmers' && (auth()->user()->role_id == 3 || auth()->user()->role_id == 4)) {
            // For Farm Leader and Farmers group, check if user is Farm Leader or Farmer
            // Retrieve the user's farm ID
            $userFarmId = DB::table('farms')
                ->select("id")
                ->where('farm_leader', auth()->user()->id)
                ->first();

            // Set the farmId to the user's farm ID
            $farmId = $userFarmId;
        }

        // Check if there is a group thread for the specified group and farm
        $groupThreadsQuery = GroupThread::where('group_id', $groupId);

        // Check if farmId is not null before adding farm_id condition
        if ($farmId !== null) {
            $groupThreadsQuery->where('farm_id', $farmId->id);
        }

        $groupThreads = $groupThreadsQuery->get();

        // If the group thread does not exist, create a new one
        if ($groupThreads->isEmpty()) {
            $groupThread = GroupThread::create([
                'group_id' => $groupId,
                'farm_id' => $farmId->id,
            ]);
        } else {
            // Retrieve messages for each group thread
            $groupThreads->each(function ($thread) {
                $thread->messages; // This will retrieve messages for each thread
            });

            // Assign the first thread to $groupThread
            $groupThread = $groupThreads->first();
        }

        // Get the currently logged-in user
        $currentUser = Auth::user();

        // Retrieve all other users for the chat list (excluding the logged-in user)
        $users = User::where('id', '!=', $currentUser->id)->get();

        // Filter users based on their participation in group threads with the current user
        $filteredUsers = $users->filter(function ($user) use ($currentUser, $groupId) {
            return GroupThread::where('group_id', $groupId)
                ->whereHas('messages', function ($query) use ($user, $currentUser) {
                    $query->where('sender_id', $user->id)
                        ->orWhere('sender_id', $currentUser->id);
                })
                ->exists();
        });
        

        // Retrieve messages for the current group thread
        $messages = $groupThread ? $groupThread->messages : collect();

        // Get a list of groups
        $groups = Group::all();

        // Retrieve farm leaders
        $id = Auth::user()->id;
        $farmLeaders = DB::table('farms')
            ->where('status', 1)
            ->where('farm_leader', $id)
            ->select("*")
            ->first();

        // Return to the view with the updated data
        return view('pages.groups', compact('groupThread', 'filteredUsers', 'messages', 'groups', 'farmLeaders'));
    } catch (ModelNotFoundException $e) {
        // If the group is not found, return a 404 response
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


public function markGroupMessagesAsRead($groupId)
{
    // Retrieve the group thread for the selected group
    $groupThread = GroupThread::where('group_id', $groupId)->first();

    if ($groupThread) {
        // Mark messages as read for the current user in the group thread
        $groupThread->messages()->where('sender_id', auth()->id())->update(['isRead' => true]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

    // Add more methods as needed for your application
}