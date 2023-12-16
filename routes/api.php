<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CropsPlantedController;
use App\Http\Controllers\Api\FarmController;
use App\Http\Controllers\Api\PlantCalendarController;
use App\Http\Controllers\Api\PlantInfoController;
use App\Http\Controllers\CropsInfoController;
use App\Http\Controllers\eventcontroller;
use App\Http\Controllers\Api\plantifeedcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

    // Route::apiResource('/users', UserController::class);
});

Route::post('/signup', [AuthController::class, "signup"]);
Route::post('login', [AuthController::class, "login"]);
Route::get('/get-user', [AuthController::class, "index"]);
Route::get('/get-farmleader', [AuthController::class, "farmLeaders"]);

// Route::get('/sendmail', [AuthController::class, 'emailInvitation']);

Route::post('/edit-user/{id}', [AuthController::class, "update"]);
Route::post('/archive-user/{id}', [AuthController::class, "archive"]);

Route::post('/create-calendar', [PlantCalendarController::class, "create"]);
Route::get('/get-calendar', [PlantCalendarController::class, "index"]);
Route::post('/edit-calendar/{id}', [PlantCalendarController::class, "update"]);
Route::post('/archive-calendar/{id}', [PlantCalendarController::class, "archive"]);

Route::post('/create-farm', [FarmController::class, "create"]);
Route::get('/get-farm', [FarmController::class, "index"]);
Route::post('/edit-farm/{id}', [FarmController::class, "update"]);
Route::post('/archive-farm/{id}', [FarmController::class, "archive"]);
Route::get('/get-farminfo/{id}', [FarmController::class, "farmInfo"]);

Route::get('/get-plant', [PlantInfoController::class, "index"]);
Route::post('/create-plant', [PlantInfoController::class, "create"]);
Route::post('/edit-plant/{id}', [PlantInfoController::class, "update"]);
Route::post('/archive-plant/{id}', [PlantInfoController::class, "archive"]);

Route::get('/get-crops/{id}', [CropsPlantedController::class, "index"]);
Route::post('/create-crops', [CropsPlantedController::class, "create"]);
Route::post('/edit-crops/{id}', [CropsPlantedController::class, "update"]);
Route::post('/archive-crops/{id}', [CropsPlantedController::class, "archive"]);

// Route::get('/farm', function () {
//     return "hello";
// });
