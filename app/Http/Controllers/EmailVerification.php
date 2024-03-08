<?php

namespace App\Http\Controllers;

use App\Libraries\PlantifyLibrary;
use Illuminate\Http\Request;

class EmailVerification extends Controller
{
    protected $plantifyLibrary;

    public function __construct(PlantifyLibrary $plantifyLibrary)
    {
        $this->plantifyLibrary = $plantifyLibrary;
    }

    public function emailVerification()
    {

        return view('pages.email-verification');
    }
}
