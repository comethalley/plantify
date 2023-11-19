<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\plantifeedcontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/create', [plantifeedcontroller::class, "create"]);
Route::get('/index', [plantifeedcontroller::class, "index"]);
Route::get('/show/{id}',[plantifeedcontroller::class, "show"]);
Route::post('/update/{id}', [plantifeedcontroller::class, "update"]);
