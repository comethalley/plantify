<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Message;
use App\Models\Reply;
use App\Models\User;
use App\Models\Farm;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ThreadController extends Controller
{
    /**
     * Display all threads.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Assuming you have the authenticated user available
        $user = auth()->user();
    
        // Fetch the user's associated farm (if any)
        $farm = Farm::where('farm_leader', $user->id)->first();
    
        // Pass the user and farm data to the view
        return view('pages.thread', compact('user', 'farm'));
    }

/**
 * Display the chat list and messages in the thread view.
 *
 * @param  int  $threadId
 * @return \Illuminate\View\View
 */
public function showThread($threadId)
{
    // Retrieve the thread and related messages
    $thread = Thread::with('messages')->findOrFail($threadId);

    // Get the currently logged-in user
    $currentUser = Auth::user();

    $user = auth()->user();

    $farm = Farm::where('farm_leader', $user->id)->first();

    // Retrieve all other users for the chat list (excluding the logged-in user)
    $users = User::where('id', '!=', $currentUser->id)->get();

    // Filter users based on their participation in threads with the current user
    $filteredUsers = $users->filter(function ($user) use ($currentUser) {
        return Thread::where('user_id_1', $currentUser->id)
            ->where('user_id_2', $user->id)
            ->orWhere(function ($query) use ($currentUser, $user) {
                $query->where('user_id_1', $user->id)
                    ->where('user_id_2', $currentUser->id);
            })
            ->exists();
    });

    // Retrieve messages for the current thread
    $messages = $thread->messages;

    // Get a list of groups
    $groups = Group::all();

    $id = Auth::user()->id; 
    $farmLeaders = DB::table('farms')
        ->where('status', 1)
        ->where('farm_leader', $id)
        ->select("*")
        ->first();

    // Return to the view with the updated data
    return view('pages.thread', compact('thread', 'filteredUsers', 'messages', 'groups', 'farmLeaders', 'farm', 'user'));
}





    

public function storeMessage(Request $request, $threadId)
{
    // Validate the incoming request data
    $request->validate([
        'text_content' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Adjust the validation rules as needed
    ]);

    // Check if an image is included in the request
    if ($request->hasFile('photo')) {
        // Handle image upload
        $photo = $request->file('photo');
        $imagePath = $request->file('photo')->store('images', 'public');

        // Create a new message with image path
        $message = Message::create([
            'thread_id' => $threadId,
            'sender_id' => auth()->user()->id,
            'image_path' => $imagePath,
            'create_date' => now(),
        ]);
    } else {
        // Create a new message with text content
        $message = Message::create([
            'thread_id' => $threadId,
            'sender_id' => auth()->user()->id,
            'text_content' => $request->input('text_content'),
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

    $pusher->trigger('chat', 'new-message', $message);

    // Return a success response
    return response()->json(['success' => true]);
}


    public function deleteMessage($messageId)
{
    $message = Message::find($messageId);

    if ($message) {
        // Update the status of the message to false
        $message->update(['status' => false]);
        return response()->json(['success' => true]);
    } else {
        return response()->json(['error' => 'Message not found'], 404);
    }
}


    /**
     * Store a reply to a message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $messageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeReply(Request $request, $messageId)
    {
        // Validation and reply creation logic
        // ...

        return back();
    }

/**
     * Create a new thread for the given user ID.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createThread($userId)
    {
        // Get the current user ID (assuming you're using authentication)
        $currentUserId = auth()->id();

        // Check if a thread already exists for the two users
        $existingThread = Thread::where(function ($query) use ($currentUserId, $userId) {
            $query->where('user_id_1', $currentUserId)
                  ->where('user_id_2', $userId);
        })->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('user_id_1', $userId)
                  ->where('user_id_2', $currentUserId);
        })->first();

        if ($existingThread) {
            // Return the existing thread ID as JSON response
            return response()->json(['thread_id' => $existingThread->id]);
        }

        // Create a new thread
        $thread = Thread::create([
            'user_id_1' => $currentUserId,
            'user_id_2' => $userId,
            'create_date' => now(), // You may adjust the creation date as needed
        ]);

        // Return the newly created thread ID as JSON response
        return response()->json(['thread_id' => $thread->id]);
    }

}