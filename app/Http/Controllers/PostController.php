<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Intervention\Image\Facades\Image;
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

        $message = "Post deleted successfully.";
        session()->flash('message', $message); // Save the message to session

        return response()->json(['message' => $message]);
    }

    public function editPost(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Define validation rules
        $rules = [
            'post' => 'required|string',
        ];

        // Define custom validation rule for bad words
        Validator::extend('bad_words', function ($attribute, $value, $parameters, $validator) {
            $badWords = ['badword1', 'badword2', 'badword3']; // Add your bad words here
            foreach ($badWords as $word) {
                if (stripos($value, $word) !== false) {
                    return false;
                }
            }
            return true;
        });

        // Validate the request
        $validator = Validator::make($request->all(), $rules);
        $validator->sometimes('post', 'bad_words', function ($input) {
            return true; // Set when you want to apply the custom validation rule
        });

        if ($validator->fails()) {
            $validationmessage = "The post contains inappropriate language. Please refrain from using offensive words.";
            return redirect()->back()->with('validationmessage', $validationmessage)->with('message_type', 'warning');
        }

        // Update the post content from the request
        $post->createpost = $request->post;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');

            // Resize the image
            $img = Image::make(public_path("storage/{$imagePath}"));
            $img->resize(541, 300);
            $img->save();

            $post->image = $imagePath;
        }

        $post->save();

        $message = "Post updated successfully.";
        return redirect()->back()->with('message', $message)->with('message_type', 'success');
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

        $img = Image::make(public_path("storage/{$imagePath}")); // Load the image
        $img->resize(541, 300); // Set the desired width and height
        $img->save();


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
