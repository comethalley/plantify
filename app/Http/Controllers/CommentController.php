<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

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
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're allowing only image files and up to 2MB
        ]);

        // Save the comment
        $comment = new Comment();
        $comment->content = $request->input('content');

        // Check if there's an uploaded image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension(); // Generate unique filename
            $image->move(public_path('images'), $imageName); // Move image to storage
            $comment->image = $imageName; // Save image filename to database
        }

        $comment->save();

        return redirect()->back()->with('message', 'Comment saved successfully!');
    }
}
