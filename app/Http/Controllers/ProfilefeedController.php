<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use App\Models\ProfileOtherInfo;
use App\Models\ProfileSettings;
use Illuminate\Http\Request;

class ProfilefeedController extends Controller
{
    public function show()
    {
        // Get the user ID of the current user
        $user_id = auth()->id();

        // Retrieve posts from the Post model
        $posts = Post::orderBy('created_at', 'desc')->get();
        // Retrieve questions from the Forum model
        $questions = Forum::orderBy('created_at', 'desc')->get();

        // Retrieve profile settings from both models
        $profileSettingsOther = ProfileOtherInfo::where('user_id', $user_id)->first();
        $profileSettings = ProfileSettings::where('user_id', $user_id)->first();

        // If profile settings do not exist, create default settings
        if (!$profileSettings) {
            $defaultSettings = [];

            // Create new profile settings using default values
            $profileSettings = new ProfileSettings($defaultSettings);
        }

        // Retrieve questions from the Forum model
        $questions = Forum::orderBy('created_at', 'desc')->get();

        // Return the view with the profile settings, posts, and questions variables
        return view('pages.profile-feed', [
            'profileSettingsOther' => $profileSettingsOther,
            'profileSettings' => $profileSettings,
            'posts' => $posts,
            'questions' => $questions,
        ]);
    }
}
