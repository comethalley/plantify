<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMessageController extends Controller
{
    public function index()
    {
        return view("pages.send-message");
    }
}