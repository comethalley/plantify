<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\UserPhoto; // Bagong pangalan ng model
use Illuminate\Support\Facades\Auth;

class UserPhotoController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();

            // Fetch user photos and bio
            $userPhotos = UserPhoto::where('user_id', $user->id)->first();
            $userBio = $userPhotos ? $userPhotos->bio : '';
            // Fetch posts and other information as before
            $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            $userAddress = $userPhotos ? $userPhotos->address : '';
            $userEmail = $userPhotos ? $userPhotos->email : '';
            $userFacebook = $userPhotos ? $userPhotos->facebook : '';
            $userInstagram = $userPhotos ? $userPhotos->instagram : '';
            $userTwitter = $userPhotos ? $userPhotos->twitter : '';

            // Fetch only the questions posted by the logged-in user
            $questions = Forum::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

            // Pass user data and other variables to the view
            return view('pages.profilefeed', compact('user', 'userPhotos', 'userBio', 'userAddress', 'userEmail', 'userFacebook', 'userInstagram', 'userTwitter', 'questions', 'posts'));
        } else {
            // If user is not authenticated, redirect to login page
            return redirect()->route('login')->with('error', 'Please login to view your profile feed.');
        }
    }
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Update user information
            $userPhotoData = [
                'bio' => $request->input('bio'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'facebook' => $request->input('facebook'),
                'instagram' => $request->input('instagram'),
                'twitter' => $request->input('twitter'),
            ];

            // Check if profile photo is uploaded
            if ($request->hasFile('profile_photo')) {
                $request->validate([
                    'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                $image = $request->file('profile_photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/profile_photos', $imageName);

                $userPhotoData['profile_photo'] = $imageName;
            }

            // Check if cover photo is uploaded
            if ($request->hasFile('cover_photo')) {
                $request->validate([
                    'cover_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                $image = $request->file('cover_photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/cover_photos', $imageName);

                $userPhotoData['cover_photo'] = $imageName;
            }

            // Update or create user photo record
            UserPhoto::updateOrCreate(['user_id' => $user->id], $userPhotoData);
            return redirect()->back()->with('message', 'Profile updated successfully.')->with('message_type', 'success');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
}