<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilefeedController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }
}
