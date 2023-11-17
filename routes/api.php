<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\farmcontroller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/users', UserController::class);
});

Route::post('/signup', [AuthController::class, "signup"]);
Route::post('login', [AuthController::class, "login"]);

Route::get('/index', [farmcontroller::class, "index"]);
Route::post('/index', [farmcontroller::class, "create"]);
Route::put('/index/{id}', [farmcontroller::class, "update"]);
Route::patch('/index/{id}', [farmcontroller::class, "update"]);
Route::delete('/index/{id}', [farmcontroller::class, "delete"]);