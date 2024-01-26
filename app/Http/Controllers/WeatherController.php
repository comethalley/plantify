<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('pages.weather.index');
    }

    public function pastweather()
    {
        return view('pages.weather.pastweather');
    }




}
