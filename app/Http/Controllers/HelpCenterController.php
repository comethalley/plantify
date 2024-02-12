<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function helpcenter()
    {
        return view("pages.helpcenter");
    }
}
