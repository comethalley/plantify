<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return view("pages.team");
    }

    public function privacy()
    {
        return view("pages.privacy");
    }

    public function team2()
    {
        return view("pages.teamv2");
    }
}
