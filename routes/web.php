<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\plantifeedcontroller;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\InventoryController;

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


// Route::get('/sendmail', [AuthController::class, 'emailInvitation']);

Route::get('/inventory/supplier', [InventoryController::class, 'index']);
Route::get('/inventory/stocks', [InventoryController::class, 'stocks']);

Route::post('/generate-qr', [InventoryController::class, 'generateqr']);
Route::post('/add-supplier', [InventoryController::class, 'createSupplier']);
Route::post('/add-seed', [InventoryController::class, 'addSeedSupplier']);
Route::post('/add-stock', [InventoryController::class, 'receivingStock']);
Route::post('/void-item', [InventoryController::class, 'voidStock']);
Route::post('/remove-stock', [InventoryController::class, 'usingStock']);
Route::get('/getSupplier/{id}', [InventoryController::class, 'getSupplier']);
Route::get('/getSupplierSeeds/{id}', [InventoryController::class, 'getSupplierSeed']);
Route::get('/download-qrCode/{filename}', [InventoryController::class, 'downloadQR'])->name('download.image');
Route::get('/getLogs/{id}', [InventoryController::class, 'logs']);

Route::get('/plantifeed', [ForumController::class, 'index']);

// Example route for displaying the chat threads
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

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










