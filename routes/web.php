<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlantController;
use App\Http\Controllers\Api\FullCalendarController;

Route::get('/', [AuthController::class, 'test']);

Route::get('/planting', [PlantController::class, 'index']);
Route::post('/planting/create', [PlantController::class, 'create']);
Route::put('/planting/update/{id}', [PlantController::class, 'update']);
Route::delete('/planting/delete/{id}', [PlantController::class, 'destroy']);

Route::get('/fullcalendar', [FullCalendarController::class, 'index']);
Route::post('/fullcalendar/action', [FullCalendarController::class, 'action']);
