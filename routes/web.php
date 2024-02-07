<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\plantifeedcontroller;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\Api\FarmController;
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

//view farm-management//
Route::get('/view-farms', [FarmController::class, 'viewFarms'])->name('farms.view');
Route::get('/farms/filterByStatus', [FarmController::class, 'filterByStatus']);
Route::post('/update-status/{id}', [FarmController::class, 'updateStatus'])->name('update.status');

//view pdf/img farm-management//
Route::get('/view-pdf/{id}/{title?}', [FarmController::class, 'viewPdf'])->name('view.pdf');
Route::get('/view-image/{id}', [FarmController::class, 'viewImage'])->name('view.image');

//xfarms farm-management//
Route::get('/view-archivefarms', [FarmController::class, 'viewArchiveFarms'])->name('archivefarms.xfarms');

//index farm-mamangement//
Route::get('/farms1', [FarmController::class, 'index']);
Route::get('/farms3', [FarmController::class, 'index1']);
Route::post('/add-farms', [FarmController::class, 'addFarms'])->name('add.farms');
Route::get('/archive-farm/{id}', [FarmController::class, 'archiveFarm'])
    ->name('archive.farm');






