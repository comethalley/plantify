<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlantController;
use App\Http\Controllers\Api\FullCalendarController;
use App\Http\Controllers\Api\plantifeedcontroller;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\qcmaps;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlantCalendar;

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

Route::get('/', [AuthController::class, 'index'])->middleware('auth');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::get('/signup', [AuthController::class, 'viewSignup']);
Route::post('/login/process', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'signup']);
Route::middleware(['auth'])->get('/authenticated-route', 'AuthController@index');


Route::get('/planting', [PlantController::class, 'index']);
Route::post('/planting/create', [PlantController::class, 'create']);
Route::put('/planting/update/{id}', [PlantController::class, 'update']);
Route::delete('/planting/delete/{id}', [PlantController::class, 'destroy']);

Route::get('/fullcalendar', [FullCalendarController::class, 'index']);
Route::post('/fullcalendar/action', [FullCalendarController::class, 'action']);
Route::get('/inventory/supplier', [InventoryController::class, 'index']);
Route::get('/inventory/stocks', [InventoryController::class, 'stocks']);
Route::get('/all-supplier', [InventoryController::class, 'getAllSupplier']);
Route::post('/generate-qr', [InventoryController::class, 'generateqr']);
Route::post('/add-supplier', [InventoryController::class, 'createSupplier']);
Route::post('/edit-supplier/{id}', [InventoryController::class, 'editSupplier']);
Route::post('/archive-supplier/{id}', [InventoryController::class, 'archiveSupplier']);
Route::post('/add-seed', [InventoryController::class, 'addSeedSupplier']);
Route::post('/edit-qty/{id}', [InventoryController::class, 'editQtySeed']);
Route::post('/add-stock', [InventoryController::class, 'receivingStock']);
Route::post('/void-item', [InventoryController::class, 'voidStock']);
Route::post('/remove-stock', [InventoryController::class, 'usingStock']);
Route::get('/getSupplier/{id}', [InventoryController::class, 'getSupplier']);
Route::get('/getSupplierSeeds/{id}', [InventoryController::class, 'getSupplierSeed']);
Route::get('/download-qrCode/{filename}', [InventoryController::class, 'downloadQR'])->name('download.image');
Route::get('/getLogs/{id}', [InventoryController::class, 'logs']);
Route::get('/inventory/uom', [InventoryController::class, 'uom']);
Route::post('/add-uom', [InventoryController::class, 'addUom']);
Route::get('/getAllUom', [InventoryController::class, 'getUom']);
Route::post('/edit-uom/{id}', [InventoryController::class, 'updateUom']);
Route::post('/archive-uom/{id}', [InventoryController::class, 'archiveUom']);

Route::get('/plantifeed', [ForumController::class, 'index']);

// Direct Messages
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chat/{messageId}/reply', [ChatController::class, 'storeReply'])->name('chat.storeReply');
Route::get('/chat/users', [ChatController::class, 'displayChatUsers'])->name('chat.displayUsers');
Route::post('/create-thread/{userId}', [ThreadController::class, 'createThread'])->name('create.thread');
Route::get('/thread/{threadId}', [ThreadController::class, 'showThread'])->name('show.thread');
Route::post('/thread/{threadId}/store-message', [ThreadController::class, 'storeMessage'])->name('store.message');
Route::post('/mark-messages-as-read/{userId}', [ChatController::class, 'markMessagesAsRead']);

// Group Chats
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/{group}/{farm}', [GroupController::class, 'show'])->name('groups.show');
Route::post('/groups/{group}/join', [GroupController::class, 'join'])->name('groups.join');
Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
Route::post('/group/{groupId}/store-group-message', [GroupController::class, 'storeGroupMessage'])->name('store.group.message');

Route::get('/weather', [WeatherController::class, 'index']);
Route::get('/pastweather', [WeatherController::class, 'pastweather']);

Route::get('/users/admin', [AuthController::class, 'getAdmin']);
Route::get('/users/farm-leader', [AuthController::class, 'getFarmerLeader']);
Route::get('/users/farmers', [AuthController::class, 'getFarmers']);

Route::get('/farm_locations', [qcmaps::class, 'index']);
Route::post('/farm_locations', [qcmaps::class, 'store']);

// Start Full Calender=================================================================
Route::get('/schedules', [EventController::class, 'index']);
Route::get('/schedulesget', [EventController::class, 'getEvents']);
Route::get('/schedulesdata/{id}', [EventController::class, 'getdata']);
Route::delete('/scheduledelete/{id}', [EventController::class, 'deleteEvent']);
Route::put('/schedule/{id}', [EventController::class, 'update']);
Route::put('/schedule/{id}/resize', [EventController::class, 'resize']);
Route::get('/events/search', [EventController::class, 'search']);

Route::view('add-schedule', 'pages.add');
Route::post('create-schedule', [EventController::class, 'create']);
// End Full Calender=================================================================

Route::get('/plantcalendar', [PlantCalendar::class, 'index']);
Route::get('/plantcalendarget', [PlantCalendar::class, 'getEvents']);
Route::get('/plantcalendardata/{eventId}', [PlantCalendar::class, 'getdata']);
Route::delete('/plantcalendardelete/{eventId}', [PlantCalendar::class, 'deleteEvent']);
Route::put('/plantcalendar/{id}', [PlantCalendar::class, 'update']);
Route::put('/plantcalendar/{eventId}/resize', [PlantCalendar::class, 'resize']);
Route::get('/plantcalendar/search', [PlantCalendar::class, 'search']);

Route::view('add-plantcalendar', 'pages.add');
Route::post('create-plantcalendar', [PlantCalendar::class, 'create']);


