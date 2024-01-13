<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Message;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display the chat threads.
     *
     * @return \Illuminate\View\View
     */
    public function index()
{
    // Get the currently logged-in user
    $currentUser = Auth::user();

    // Retrieve all other users for the chat list (excluding the logged-in user)
    $users = User::where('id', '!=', $currentUser->id)->get();

    // Add your logic to retrieve chat threads (modify as per your actual implementation)
    $threads = Thread::with('messages')->get();

    return view('pages.chat', compact('users', 'threads'));
}

    /**
     * Display the messages for a specific thread.
     *
     * @param  int  $threadId
     * @return \Illuminate\View\View
     */
    public function showThread($threadId)
    {
        // Retrieve the thread and related messages
        $thread = Thread::with('messages')->findOrFail($threadId);
    
        return view('pages.thread', compact('thread'));
    }
    
    


    /**
     * Store a new message in a thread.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMessage(Request $request, $threadId)
    {
        // Validate the incoming request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new message in the specified thread
        Message::create([
            'thread_id' => $threadId,
            'sender_id' => auth()->user()->id, // Assuming you have user authentication
            'content' => $request->input('content'),
            'create_date' => now(),
        ]);

        return redirect()->route('chat.show', $threadId);
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
        // Validate the incoming request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new reply to the specified message
        Reply::create([
            'message_id' => $messageId,
            'sender_id' => auth()->user()->id, // Assuming you have user authentication
            'content' => $request->input('content'),
            'create_date' => now(),
        ]);

        // Redirect back to the message or thread page
        // You might need to modify this based on your application flow
        return back();
    }

    /**
     * Display the list of users for the chat list.
     *
     * @return \Illuminate\View\View
     */
    public function displayChatUsers()
    {
        // Get the currently authenticated user
        $currentUser = Auth::user();

        // Assuming you have a method to fetch the relevant users based on the current user
        $chatUsers = $this->getChatUsers($currentUser);

        return view('chat.users', ['users' => $chatUsers]);
    }

    /**
     * Get the users to display in the chat list based on the current user.
     *
     * @param  \App\Models\User  $currentUser
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getChatUsers($currentUser)
    {
        // Implement your logic to fetch the relevant users here
        // For example, if you want to display only users not equal to the current user
        return User::where('id', '!=', $currentUser->id)->get();
    }

    public function unread()
    {
        // Assuming you are fetching users somewhere
        $users = User::with(['messages' => function ($query) {
            $query->where('isRead', false);
        }])->get();
    
        // Pass the $users collection to your view
        return view('your.view', compact('users'));
    }
    

    public function markMessagesAsRead($userId)
    {
        $thread = Thread::where(function ($query) use ($userId) {
                $query->where('user_id_1', auth()->id())
                    ->where('user_id_2', $userId);
            })
            ->orWhere(function ($query) use ($userId) {
                $query->where('user_id_1', $userId)
                    ->where('user_id_2', auth()->id());
            })
            ->first();
    
        if ($thread) {
            // Mark messages as read for the current user and the selected user
            $thread->messages()->where('sender_id', $userId)->update(['isRead' => true]);
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false]);
    }
    
    

}