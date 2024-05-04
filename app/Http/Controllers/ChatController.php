<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Message;
use App\Models\Reply;
use App\Models\User;
use App\Models\Group;
use App\Models\ProfileSettings;
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

        // Filter the users based on whether there is a thread between them and the current user
        $filteredUsers = $users->filter(function ($user) use ($currentUser) {
            return Thread::where('user_id_1', $currentUser->id)
                ->where('user_id_2', $user->id)
                ->orWhere(function ($query) use ($currentUser, $user) {
                    $query->where('user_id_1', $user->id)
                        ->where('user_id_2', $currentUser->id);
                })
                ->exists();
        });

        // Add your logic to retrieve chat threads (modify as per your actual implementation)
        $threads = Thread::with('messages')->get();

        $profileSettings = ProfileSettings::where('user_id', $currentUser->id)->first();

        // Get a list of groups
        $groups = Group::all();

        $id = Auth::user()->id;
        $farmLeaders = DB::table('farms')
            ->where('status', 1)
            ->where('farm_leader', $id)
            ->select("*")
            ->first();

        return view('pages.chat', compact('filteredUsers', 'threads', 'groups', 'farmLeaders', 'profileSettings'));
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


    public function searchUsers(Request $request)
    {
        $term = $request->input('term');

        // Perform a case-insensitive search on the firstname and lastname columns
        $users = User::where('firstname', 'LIKE', '%' . $term . '%')->orWhere('lastname', 'LIKE', '%' . $term . '%')->get();

        return response()->json($users);
    }
}
