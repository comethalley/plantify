<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;
use App\Events\MyEvent;
use Pusher\Pusher;

class ForumController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        $questions = DB::table('forums')
            ->leftJoin('users', 'users.id', '=', 'forums.user_id')
            ->select('users.*', 'forums.*', 'forums.created_at as question_created_at') // Ilagay ang 'created_at' sa forum table bilang 'question_created_at'
            ->orderBy('forums.created_at', 'desc')
            ->get();

        $posts = DB::table('posts')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*', 'posts.created_at as post_created_at') // Ilagay ang 'created_at' sa post table bilang 'post_created_at'
            ->orderBy('posts.created_at', 'desc')

            ->get();

        return view('pages.forum', compact('questions', 'posts', 'comments'));
    }


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function deleteQuestion($id)
    {
        $question = Forum::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $question->delete();

        $message = "Question deleted successfully.";
        session()->flash('message', $message); // Save the message to session

        return response()->json(['message' => $message]);
    }



    public function editQuestion(Request $request, $id)
    {
        $question = Forum::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        // Gumawa ng validation rules
        $rules = [
            'question' => 'required|string',
        ];

        // Gumawa ng custom validation rule para sa bad words
        Validator::extend('bad_words', function ($attribute, $value, $parameters, $validator) {
            $badWords = ['badword1', 'badword2', 'badword3']; // Ilagay dito ang mga bad words
            foreach ($badWords as $word) {
                if (stripos($value, $word) !== false) {
                    return false;
                }
            }
            return true;
        });

        // Mag-validate ng request
        $validator = Validator::make($request->all(), $rules);
        $validator->sometimes('question', 'bad_words', function ($input) {
            return true; // Dito mo mase-set kung kailan mo gustong i-apply ang custom validation rule
        });

        if ($validator->fails()) {
            $validationmessage = "The question contains inappropriate language. Please refrain from using offensive words.";
            return redirect()->back()->with('validationmessage', $validationmessage)->with('message_type', 'warning');
        }

        // Update ang tanong mula sa request
        $question->question = $request->question;
        $question->save();

        $message = "Question updated successfully.";
        return redirect()->back()->with('message', $message)->with('message_type', 'success');
    }






    public function store(Request $request)
    {

        $id =  Auth::user()->id;


        Validator::extend('no_bad_words', function ($attribute, $value, $parameters, $validator) {
            $badWords = ['mura', 'badword2', 'badword3'];
            foreach ($badWords as $badWord) {
                if (stripos($value, $badWord) !== false) {
                    return false;
                }
            }
            return true;
        });

        // Validate request
        $validator = Validator::make($request->all(), [
            'askquestions' => ['required', 'string', 'no_bad_words'], // Apply custom validation rule here
            'language' => 'required|string',
        ], [
            'askquestions.required' => 'The question field is required.',
            'askquestions.no_bad_words' => 'The question contains inappropriate language.',
            'language.required' => 'The language field is required.',
        ]);

        // If validation fails
        if ($validator->fails()) {
            $validationmessage = "The question contains inappropriate language. Please refrain from using offensive words.";
            return redirect()->back()->with('validationmessage', $validationmessage)->with('message_type', 'warning');
        }

        // Create forum post if validation passes
        $forum =  Forum::create([
            'user_id' => $id,
            'question' => $request->askquestions,
            'language' => $request->language,
        ]);

        $hey = "Hello world";
        // print $hey;
        // exit;

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $data['message'] = "Hell sa imong tanan";

        $pusher->trigger('my-channel', 'my-event', $data);


        // If successful
        $message = "Question added successfully.";
        return redirect()->back()->with('message', $message)->with('message_type', 'success');
    }

    public function getPost()
    {
        $questions = DB::table('forums')
            ->leftJoin('users', 'users.id', '=', 'forums.user_id')
            ->select('users.*', 'forums.*', 'forums.created_at as question_created_at') // Ilagay ang 'created_at' sa forum table bilang 'question_created_at'
            ->orderBy('forums.created_at', 'desc')
            ->get();

        $comments = Comment::all();

        return view('pages.post', compact('questions', 'comments'));
    }
}
