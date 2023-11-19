<?php

use App\Http\Controllers\Api\AuthController;
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


Route::post('/create', [plantifeedcontroller::class, "create"]);
Route::post('/update/{id}', [plantifeedcontroller::class, "update"]);
Route::post('/archive/{id}', [plantifeedcontroller::class, "archive"]);

