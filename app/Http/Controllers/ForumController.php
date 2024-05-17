<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProfileSettings;
use Illuminate\Validation\Rule;
use App\Events\MyEvent;
use App\Notifications\PostLiked;
class ForumController extends Controller
{
    public function index()
    {


        $comments = Comment::all();
        $profileSettings = ProfileSettings::where('user_id', auth()->id())->first();
        session(['profileSettings' => $profileSettings]);
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

        return view('pages.forum', compact('questions', 'posts', 'comments', 'profileSettings'));
    }


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function likeForum(Forum $forum)
    {
        $user = Auth::user();

        if (!$forum->likes()->where('user_id', $user->id)->exists()) {
            $forum->likes()->create(['user_id' => $user->id]);
             // Notify the forum owner
               // Notify the post author
        $forum->user->notify(new PostLiked($forum, $user));
        }

        return response()->json(['message' => 'Forum liked successfully']);
    }

    public function unlikeForum(Forum $forum)
    {
        $user = Auth::user();

        $forum->likes()->where('user_id', $user->id)->delete();

        return response()->json(['message' => 'Forum unliked successfully']);
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

        // Validation rules
        $rules = [
            'question' => 'required|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $validationmessage = "The question contains inappropriate language. Please refrain from using offensive words.";
            return redirect()->back()->with('validationmessage', $validationmessage)->with('message_type', 'warning');
        }

        // Update the question
        $question->question = $request->question;
        $question->save();

        $message = "Question updated successfully.";
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

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     [
        //         'cluster' => env('PUSHER_APP_CLUSTER'),
        //         'useTLS' => true,
        //     ]
        // );

        // $data['message'] = "Hell sa imong tanan";

        // $pusher->trigger('my-channel', 'my-event', $data);


        // If successful
        $message = "Question added successfully.";
        return redirect()->back()->with('message', $message)->with('message_type', 'success');
    }

    public function getPost()
    {
        $questions = DB::table('forums')
            ->leftJoin('users', 'users.id', '=', 'forums.user_id')
            ->select('users.*', 'forums.*', 'forums.created_at as question_created_at', DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.forums_id = forums.id) as comment_count'))
            ->orderBy('forums.created_at', 'desc')
            ->get();


        $comments = Comment::all();

        return view('pages.post', compact('questions', 'comments'));
    }
}
