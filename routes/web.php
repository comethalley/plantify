<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlantController;
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

// Route::get('/', function () {
//     return view('email.email');
// });

Route::get('/', [AuthController::class, 'test']);


Route::get('/planting', [PlantController::class, 'index']);
Route::post('/planting/create', [PlantController::class, 'store'])->name('planting.store');
Route::put('/planting/update/{id}', [PlantController::class, 'update'])->name('planting.update');
Route::delete('/planting/delete/{id}', [PlantController::class, 'destroy'])->name('planting.destroy');

// Route::namespace('Api')->group(function () {
//     Route::get('/plant', 'PlantController@index');
//     Route::post('/plant/create', 'PlantController@store');
//     Route::put('/plant/update/{id}', 'PlantController@update');
//     Route::delete('/plant/delete/{id}', 'PlantController@destroy');
// });

// Route::get('/sendmail', [AuthController::class, 'emailInvitation']);
