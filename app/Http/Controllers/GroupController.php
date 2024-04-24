<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thread;
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
            $farmId = $userFarmId->id; // Use $userFarmId->id instead of $userFarmId
        }

        // Check if there is a group thread for the specified group and farm
        $groupThreadQuery = GroupThread::where('group_id', $groupId);

        // Check if farmId is not null before adding farm_id condition
        if ($farmId !== null) {
            $groupThreadQuery->where('farm_id', $farmId); // Use farm_id instead of farm_id->id
        }

        // Retrieve the first matching group thread
        $groupThread = $groupThreadQuery->first();

        // If the group thread does not exist, create a new one
        if (!$groupThread) {
            $groupThread = GroupThread::create([
                'group_id' => $groupId,
                'farm_id' => $farmId, // Set the farm_id when creating a new thread
            ]);
        } else {
            // Retrieve messages for the group thread
            $groupThread->load('messages'); // Eager load messages
        }

        // Retrieve other necessary data for the view
        $currentUser = Auth::user();
        $users = User::where('id', '!=', $currentUser->id)->get();
        $filteredUsers = $users->filter(function ($user) use ($currentUser) {
            return Thread::where('user_id_1', $currentUser->id)
                ->where('user_id_2', $user->id)
                ->orWhere(function ($query) use ($currentUser, $user) {
                    $query->where('user_id_1', $user->id)
                        ->where('user_id_2', $currentUser->id);
                })
                ->exists();
        });
        $messages = $groupThread ? $groupThread->messages : collect();
        $groups = Group::all();
        $farmLeaders = DB::table('farms')
            ->where('status', 1)
            ->where('farm_leader', $currentUser->id)
            ->first();

        // Return the view with the necessary data
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
    public function storeGroupMessage(Request $request, $groupId)
    {
        // Validate the incoming request data
        $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Adjust the validation rules as needed
        ]);
    
        // Check if an image is included in the request
        if ($request->hasFile('image')) {
            // Handle image upload
            $photo = $request->file('image');
            $imagePath = $request->file('image')->store('images', 'public');
    
            // Create a new message with image path
            GroupMessage::create([
                'thread_id' => $groupId,
                'sender_id' => auth()->user()->id,
                'image_path' => $imagePath,
                'create_date' => now(),
            ]);
        } elseif ($request->filled('content')) {
            // Create a new message with text content only
            GroupMessage::create([
                'thread_id' => $groupId,
                'sender_id' => auth()->user()->id,
                'content' => $request->input('content'),
                'create_date' => now(),
            ]);
        } else {
            // If neither content nor image is provided, return an error response
            return response()->json(['error' => 'Please provide either text or an image'], 400);
        }
    
        // You might need to return a response or redirect based on your application flow
        return response()->json(['success' => true]);
    }
    
    

    
    
    
    public function deleteMessage($messageId)
    {
        $message = GroupMessage::find($messageId);
    
        if ($message) {
            // Update the status of the message to false
            $message->update(['status' => false]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
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