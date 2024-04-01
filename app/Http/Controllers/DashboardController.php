<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $data = Dashboard::all();
        return view('dashboard', compact('data'));
    }
}
