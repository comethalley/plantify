<?php

namespace App\Http\Controllers;


use App\Models\ProfileOtherInfo;
use App\Models\ProfileSettings;
use Illuminate\Http\Request;

class ProfilefeedController extends Controller
{
    public function show()
    {
        // Get the user ID of the current user
        $user_id = auth()->id();

     
        // Retrieve profile settings from both models
        $profileSettingsOther = ProfileOtherInfo::where('user_id', $user_id)->first();
        $profileSettings = ProfileSettings::where('user_id', $user_id)->first();

        // If profile settings do not exist, create default settings
        if (!$profileSettings) {
            $defaultSettings = [];

            // Create new profile settings using default values
            $profileSettings = new ProfileSettings($defaultSettings);
        }

 

        return view('pages.profile-feed', [
            'profileSettingsOther' => $profileSettingsOther,
            'profileSettings' => $profileSettings,
       
        ]);
    }
}
