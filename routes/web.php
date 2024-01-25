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
use App\Http\Controllers\WeatherController;

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

// Example route for displaying the chat threads
Route::get('/chat', [ChatController::class, 'index']);

// Example route for displaying the messages in a specific thread
Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.user');

// Example route for storing a new message in a thread
Route::post('/chat/{threadId}/message', [ChatController::class, 'storeMessage'])->name('chat.storeMessage');

// Example route for storing a reply to a message
Route::post('/chat/{messageId}/reply', [ChatController::class, 'storeReply'])->name('chat.storeReply');

Route::get('/chat/users', [ChatController::class, 'displayChatUsers'])->name('chat.displayUsers');

Route::post('/create-thread/{userId}', [ThreadController::class, 'createThread'])->name('create.thread');

Route::get('/thread/{threadId}', [ThreadController::class, 'showThread'])->name('show.thread');

Route::post('/thread/{threadId}/store-message', [ThreadController::class, 'storeMessage'])->name('store.message');

Route::post('/mark-messages-as-read/{userId}', [ChatController::class, 'markMessagesAsRead']);

Route::get('/weather', [WeatherController::class, 'index']);
Route::get('/pastweather', [WeatherController::class, 'pastweather']);
