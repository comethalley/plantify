<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $posts = Post::with('likes')->orderBy('created_at', 'desc')->get();
        $questions = Forum::orderBy('created_at', 'desc')->get();

        return view('pages.forum', compact('questions', 'posts'));
    }

    public function like(Post $post)
    {
        $user = Auth::user();

        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->attach($user->id);
        }

        return response()->json(['message' => 'Post liked successfully']);
    }

    public function unlike(Post $post)
    {
        $user = Auth::user();

        $post->likes()->detach($user->id);

        return response()->json(['message' => 'Post unliked successfully']);
    }

    public function getPostLikes(Post $post)
    {
        $likes = $post->likes()->get(['firstname', 'lastname']);
        return response()->json(['likes' => $likes]);
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
            $badWords = [
                'puta', 'put@', 'gago', 'g@go', 'tang ina', 't4ng in4', 'bobo', 'obob', 'b0bo', 'b0b0',
                'punyeta', 'tanga', 'kingina', 'kinginamo', 'inamo', 'namo', 'inaka', 'suso', 'puke',
                'tite', 'kantot', 'pwet', 'puday', 'kipay', 'pekpek', 'pokpok', 'putangina', 'laspag',
                'bulbol', 'bilat', 'tarantado', 'gaga', 'gagi', 'shet', 'pota', 'tangina', 'baliw',
                'bwakanangina', 'kinanginamo', 'salsal', 'jakol', 'pingger', 'pakyu', 'tae', 'monggoloid',
                'tamod', 'bayag', 'ulol', 'sintosinto', 'siraulo', 'animal', 'inutil', 'demonyo', 'kulangkulang',
                'sayad', 'hayop', 'walangkwenta', 'pakshet', 'burat', 'utong', 'supot', 'hayop', 'p@t@',
                'gaga', 'kiffy', 'deck'
            ];
            // Add your bad words here
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
            $badWords = [
                'puta', 'put@', 'gago', 'g@go', 'tang ina', 't4ng in4', 'bobo', 'obob', 'b0bo', 'b0b0',
                'punyeta', 'tanga', 'kingina', 'kinginamo', 'inamo', 'namo', 'inaka', 'suso', 'puke',
                'tite', 'kantot', 'pwet', 'puday', 'kipay', 'pekpek', 'pokpok', 'putangina', 'laspag',
                'bulbol', 'bilat', 'tarantado', 'gaga', 'gagi', 'shet', 'pota', 'tangina', 'baliw',
                'bwakanangina', 'kinanginamo', 'salsal', 'jakol', 'pingger', 'pakyu', 'tae', 'monggoloid',
                'tamod', 'bayag', 'ulol', 'sintosinto', 'siraulo', 'animal', 'inutil', 'demonyo', 'kulangkulang',
                'sayad', 'hayop', 'walangkwenta', 'pakshet', 'burat', 'utong', 'supot', 'hayop', 'p@t@',
                'gaga', 'kiffy', 'deck'
            ];
            // Add your list of bad words here
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
