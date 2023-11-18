<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\cropsplantedcontroller;
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

Route::post('/view-crops', [cropsplantedcontroller::class, "index"]);
Route::post('/create-crops', [cropsplantedcontroller::class, "create"]);
Route::post('/update-crops/{id}', [cropsplantedcontroller::class, "update"]);
Route::post('/archive-crops/{id}', [cropsplantedcontroller::class, "archive"]);
