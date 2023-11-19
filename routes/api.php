<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CropsInfoController;
use App\Http\Controllers\eventcontroller;
use App\Http\Controllers\Api\plantifeedcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/users', UserController::class);
});

Route::post('/signup', [AuthController::class, "signup"]);
Route::post('login', [AuthController::class, "login"]);
Route::post('/create-crops', [CropsInfoController::class, "create"]);
Route::post('/create-events', [eventcontroller::class, "create"]);
Route::post('/update-events/{id}', [eventcontroller::class, "update"]);
Route::post('/update-crops/{id}', [CropsInfoController::class, "update"]);
Route::post('/archive-crops/{id}', [CropsInfoController::class, "archive"]);


Route::post('/create', [plantifeedcontroller::class, "create"]);
Route::post('/update/{id}', [plantifeedcontroller::class, "update"]);
Route::post('/archive/{id}', [plantifeedcontroller::class, "archive"]);
