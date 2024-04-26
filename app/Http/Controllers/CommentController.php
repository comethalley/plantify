<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();
        return view('pages.forum', compact('comments'));
    }


    public function store(Request $request)

    {
        $request->validate([
            'forum_id' => 'required|string',
            'content' => 'required|string',
            //'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're allowing only image files and up to 2MB
        ]);
        $id =  Auth::user()->id;
        // Save the comment
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->forums_id = $request->input('forum_id');
        $comment->commented_by = $id;

        // Check if there's an uploaded image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension(); // Generate unique filename
            $image->move(public_path('images'), $imageName); // Move image to storage
            $comment->image = $imageName; // Save image filename to database
        }

        $comment->save();

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $data['id'] = $request->input('forum_id');

        $pusher->trigger('comment-channel', 'comment-event', $data);

        //return redirect()->back()->with('message', 'Comment saved successfully!');
    }

    public function getComment($id)
    {

        $post = DB::table('forums')
            ->leftJoin('users', 'users.id', '=', 'forums.user_id')
            ->select('users.*', 'forums.*', 'forums.created_at as question_created_at') // Ilagay ang 'created_at' sa forum table bilang 'question_created_at'
            ->where('forums.id', $id)
            ->first();
        // dd($post);

        $comment = DB::table('comments')
            ->leftJoin('forums', 'forums.id', '=', 'comments.forums_id')
            ->leftJoin('users', 'users.id', '=', 'comments.commented_by')
            ->select(
                'comments.*',
                'users.firstname',
                'users.lastname',
            )
            ->where('forums.id', $id)
            ->orderBy('comments.id', 'DESC')
            ->get();

        return view('pages.comment', compact('comment', 'post'));
    }

    public function getReply($id)
    {

        $comment = DB::table('comments')
            // ->leftJoin('forums', 'forums.id', '=', 'comments.forums_id')
            ->leftJoin('users', 'users.id', '=', 'comments.commented_by')
            ->select(
                'comments.*',
                'users.firstname',
                'users.lastname',
            )
            ->where('comments.id', $id)
            ->first();
        // dd($comment);

        $reply = DB::table('forum_replys')
            ->leftJoin('comments', 'comments.id', '=', 'forum_replys.comment_id')
            ->leftJoin('users', 'users.id', '=', 'forum_replys.replied_by')
            ->select(
                'forum_replys.*',
                'comments.*',
                'users.firstname',
                'users.lastname',
            )
            ->where('comments.id', $id)
            ->get();

        //dd($reply);

        return view('pages.reply', compact('comment', 'reply'));
    }

    public function createReply(Request $request)

    {
        $request->validate([
            'comment_id' => 'required|string',
            'content' => 'required|string',
            //'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're allowing only image files and up to 2MB
        ]);
        $id =  Auth::user()->id;
        // Save the comment
        $comment = new ForumReply();
        $comment->reply_content = $request->input('content');
        $comment->comment_id = $request->input('comment_id');
        $comment->replied_by = $id;

        // Check if there's an uploaded image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension(); // Generate unique filename
            $image->move(public_path('images'), $imageName); // Move image to storage
            $comment->image = $imageName; // Save image filename to database
        }

        $comment->save();

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $data['id'] = $request->input('comment_id');

        $pusher->trigger('reply-channel', 'reply-event', $data);

        //return redirect()->back()->with('message', 'Comment saved successfully!');
    }
}
