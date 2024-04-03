<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $questions = Forum::orderBy('created_at', 'desc')->get();

        return view('pages.forum', compact('questions', 'posts'));
    }







    public function deletePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
    public function editPost(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Update the post from the request
        $post->createpost = $request->post;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        // Return a JSON response with success message
        return response()->json(['success' => true, 'message' => 'Post updated successfully'], 200);
    }




    public function store(Request $request)
    {


        $id =  Auth::user()->id;


        Validator::extend('no_bad_words', function ($attribute, $value, $parameters, $validator) {
            $badWords = ['badword1', 'badword2', 'badword3']; // Add your list of bad words here
            foreach ($badWords as $badWord) {
                if (stripos($value, $badWord) !== false) {
                    return false; // Return false if a bad word is found
                }
            }
            return true; // Return true if no bad words are found
        });



        $validator = Validator::make($request->all(), [
            'selection' => 'required|string',
            'selectiontwo' => 'required|string',
            'createpost' => ['required', 'string', 'no_bad_words'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ], [
            'selection.required' => 'The question field is required.',
            'selectiontwo.required' => 'The language field is required.',


        ]);

        if ($validator->fails()) {
            $validationmessage = "The question contains inappropriate language. Please refrain from using offensive words.";
            return redirect()->back()->with('validationmessage', $validationmessage)->with('message_type', 'warning');
        }


        $imagePath = $request->file('image')->store('images', 'public');


        Post::create([
            'user_id' => $id,
            'selection' => $request->selection,
            'selectiontwo' => $request->selectiontwo,
            'createpost' => $request->createpost,
            'image' => $imagePath, // Save image path to database
        ]);

        $message = "Question added successfully.";
        return redirect()->back()->with('message', 'Post added successfully.');
    }
}
