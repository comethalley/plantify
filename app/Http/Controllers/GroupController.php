<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thread;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupThread;
use App\Models\GroupMessage;
use App\Models\Farmer;
use App\Models\Farm;
use App\Models\ProfileSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pusher\Pusher;

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
            } elseif ($group->group_name === 'Farm Leader and Farmers') {
                // For Farm Leader and Farmers group, check if user is a farmer
                if (auth()->user()->role_id == 4) {
                    // Retrieve the farm leader for the farmer
                    $farmLeaderId = Farmer::where('farmer_id', auth()->user()->id)->pluck('farmleader_id')->first();
    
                    // Retrieve the farm ID of the farm leader
                    $farmId = Farm::where('farm_leader', $farmLeaderId)->pluck('id')->first();
                } elseif (auth()->user()->role_id == 3) {
                    // Retrieve the farm ID of the farm leader
                    $farmId = Farm::where('farm_leader', auth()->user()->id)->pluck('id')->first();
                }
            }
    
            // Check if there is a group thread for the specified group and farm
            $groupThread = GroupThread::where('group_id', $groupId)->where('farm_id', $farmId)->first();
    
            // If the group thread does not exist, create a new one
            if (!$groupThread) {
                $groupThread = GroupThread::create([
                    'group_id' => $groupId,
                    'farm_id' => $farmId,
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


            $messages = $groupThread ? $groupThread->messages()->with('sender')->get() : collect();
            $messages->load('sender');
    
            $profileSettings = ProfileSettings::where('user_id', $currentUser->id)->first();
            $groups = Group::all();
            $farmLeaders = DB::table('farms')
                ->where('status', 1)
                ->where('farm_leader', $currentUser->id)
                ->first();
    
            // Return the view with the necessary data
            return view('pages.groups', compact('groupThread', 'filteredUsers', 'messages', 'groups', 'farmLeaders', 'profileSettings'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:25000', // Adjust the validation rules as needed
        ]);
    
        $message = null; // Initialize $message variable
    
        // Check if an image is included in the request
        if ($request->hasFile('image')) {
            // Handle image upload
            $photo = $request->file('image');
            $imagePath = $request->file('image')->store('images', 'public');
    
            // Create a new message with image path
            $message = GroupMessage::create([
                'thread_id' => $groupId,
                'sender_id' => auth()->user()->id,
                'image_path' => $imagePath,
                'create_date' => now(),
            ]);
        } else {
            // Create a new message with text content only
            $message = GroupMessage::create([
                'thread_id' => $groupId,
                'sender_id' => auth()->user()->id,
                'content' => $request->input('content'),
                'create_date' => now(),
            ]);
        }
    
        // Broadcast the message using Pusher
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $pusher->trigger('group-channel', 'group-message', $message);
    
        // Return a success response
        return response()->json(['success' => true]);
    }
    

    
    public function fetchMessages(Request $request, $groupId)
    {
        // Retrieve the group thread and related messages, eager loading the sender's information
        $groupThread = GroupThread::with('messages.sender')->findOrFail($groupId);
    
        // Retrieve messages for the current group thread
        $messages = $groupThread->messages;
    
        // Return messages as JSON response
        return response()->json(['messages' => $messages]);
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