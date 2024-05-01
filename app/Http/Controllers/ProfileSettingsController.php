<?php

namespace App\Http\Controllers;

use App\Models\ProfileOtherInfo;
use App\Rules\NotCommonPassword;
use App\Rules\NotSameAsCurrentPassword;
use App\Rules\NotSameAsName;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\ProfileSettings;
use Illuminate\Http\Request;


class ProfileSettingsController extends Controller
{
    public function show()
    {
        $profileSettings = ProfileSettings::where('user_id', auth()->id())->first();
        return view('pages.profilesettings', ['profileSettings' => $profileSettings]);
    }

    public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|exists:users,id', // Verify if the user exists
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
            'type' => 'required|in:cover,profile', // Specify if the image is a cover image or a profile image
        ]);

        // Save the image to the database
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $fileName);

            // Update or create the image in the database for the specified user
            $profileSettings = ProfileSettings::where('user_id', $request->user_id)->first();
            if ($profileSettings) {
                if ($request->type === 'cover') {
                    $profileSettings->cover_image = $fileName;
                } elseif ($request->type === 'profile') {
                    $profileSettings->profile_image = $fileName;
                }
                $profileSettings->save();
            } else {
                // If the profile settings for the user do not exist, create a new entry
                $profileSettings = new ProfileSettings();
                $profileSettings->user_id = $request->user_id;
                if ($request->type === 'cover') {
                    $profileSettings->cover_image = $fileName;
                } elseif ($request->type === 'profile') {
                    $profileSettings->profile_image = $fileName;
                }
                $profileSettings->save();
            }

            // Return success response
            return response()->json(['message' => ucfirst($request->type) . ' image uploaded successfully'], 200);
        }

        // Return error response if no file is provided
        return response()->json(['error' => 'No image provided'], 400);
    }

    public function saveOrUpdate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'sex' => 'nullable|in:male,female',
            'bio' => 'nullable|string|max:500',
        ]);

        // Find or create the profile other info for the current user
        $profileOtherInfo = ProfileOtherInfo::updateOrCreate(
            ['user_id' => auth()->id()], // Search criteria
            $validatedData // Data to update or create
        );


        return redirect()->back()->with('success', 'Profile Info updated successfully.');
    }



    public function updateProfile(Request $request)
    {
        // Kunin ang kasalukuyang user
        $user = auth()->user();

        // Validate the request
        $request->validate([
            'firstname' => 'required|string|max:55',
            'lastname' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email,' . $user->id, // Idagdag ang user ID dito
        ]);

        // Update ang mga detalye ng user
        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]);



        // I-return ang response
        return redirect()->back()->with('success', 'Profile details updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Kunin ang kasalukuyang user
        $user = auth()->user();

        // Validate the request
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:6',
                new StrongPassword,
                new NotCommonPassword,
                new NotSameAsCurrentPassword,
                new NotSameAsName($user->firstname, $user->lastname),
            ],
        ]);

        // Update ang password ng user
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // I-return ang response
        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
