<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmController extends Controller
{

    public function index()
    {
        return view("pages.farm");
    }
}
