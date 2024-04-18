<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('searchTerm', ''); // Fetch search term from request, default to empty string if not provided

        // You can fetch any initial data needed for your index page here
        // For example:
        $questions = Forum::all();
        $posts = Post::all();

        $recommendations = []; // Initialize recommendations array

        // Check if a search term was provided
        if (!empty($searchTerm)) {
            // If a search term is provided, perform search and get recommendations
            $questions = Forum::where('question', 'like', '%' . $searchTerm . '%')->get();
            $posts = Post::where('createpost', 'like', '%' . $searchTerm . '%')->pluck('createpost');

            $recommendations = $questions->merge($posts);
        }

        // Pass data to the view
        return view('pages.search_results', compact('recommendations', 'searchTerm', 'questions', 'posts'));
    }

    public function search(Request $request)
    {
        // This method remains unchanged as it handles the JSON response for search suggestions
        $searchTerm = $request->input('searchTerm');

        $questions = Forum::where('question', 'like', '%' . $searchTerm . '%')->pluck('question');
        $posts = Post::where('createpost', 'like', '%' . $searchTerm . '%')->pluck('createpost');

        $recommendations = $questions->merge($posts);

        return $recommendations->toJson();
    }
}
