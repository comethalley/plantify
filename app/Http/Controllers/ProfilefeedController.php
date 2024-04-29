<?php

namespace App\Http\Controllers;

use App\Models\ProfileSettings;
use Illuminate\Http\Request;

class ProfilefeedController extends Controller
{
    // Sa iyong ProfilefeedController.php
    public function show()
    {
        // Get the user ID of the current user
        $user_id = auth()->id();

        // Retrieve the profile settings of the current user
        $profileSettings = \App\Models\ProfileOtherInfo::where('user_id', $user_id)->first();

        // If profile settings do not exist, create default settings
        if (!$profileSettings) {
            $defaultSettings = [
                'facebook' => 'default_facebook',
                'twitter' => 'default_twitter',
                'instagram' => 'default_instagram',
            ];

            // Create new profile settings using default values
            $profileSettings = new \App\Models\ProfileOtherInfo($defaultSettings);
        }

        // Return the view with the $profileSettings variable
        return view('pages.profile-feed', ['profileSettings' => $profileSettings]);
    }
}
