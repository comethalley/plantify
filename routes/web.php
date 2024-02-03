<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\plantifeedcontroller;
use App\Http\Controllers\PlantinfoController;
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
Route::get('/', function () {
    return view('welcome');
});
 
Route::resource("/plantinfo", PlantinfoController::class);

Route::get('/', [AuthController::class, 'index'])->middleware('auth');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::get('/signup', [AuthController::class, 'viewSignup']);
Route::post('/login/process', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'signup']);

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

Route::get('/edit/{id}', [PlantinfoController::class, 'edit']);