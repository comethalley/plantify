<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class qcmaps extends Controller
{
    public function index()  {
        return view ("pages.qcmaps");
    }
}
