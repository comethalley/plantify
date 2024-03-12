<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FarmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlantController;
use App\Http\Controllers\Api\FullCalendarController;
use App\Http\Controllers\Api\plantifeedcontroller;
use App\Http\Controllers\Api\PlantInfoController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\qcmaps;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PlantCalendar;
use App\Http\Controllers\TaskController;

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
Route::get('/getAllAdmin', [AuthController::class, 'getAllAdmin']);
Route::post('/addAdmin', [AuthController::class, 'createAdmin']);
Route::post('/editAdmin/{id}', [AuthController::class, 'updateAdmin']);
Route::post('/archiveAdmin/{id}', [AuthController::class, 'archiveAdmin']);
Route::get('/getAdmin/{id}', [AuthController::class, 'viewAdmin']);
Route::get('/users/farm-leader', [AuthController::class, 'getFarmerLeader']);
Route::get('/getAllFarmLeaders', [AuthController::class, 'farmLeaders']);
Route::get('/getFL/{id}', [AuthController::class, 'viewfarmLeaders']);
Route::post('/addFarmLeader', [AuthController::class, 'createFarmLeader']);
Route::post('/editFarmLeader/{id}', [AuthController::class, 'updateFarmLeader']);
Route::post('/archiveFL/{id}', [AuthController::class, 'archiveFarmLeader']);
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
Route::get('/unread-events', [EventController::class, 'unread']);
Route::view('add-schedule', 'pages.add');
Route::post('create-schedule', [EventController::class, 'create']);

// End Full Calender=================================================================

Route::get('/plantcalendar', [PlantCalendar::class, 'index']);
Route::get('/plantcalendarget', [PlantCalendar::class, 'getEvents']);
Route::get('/plantcalendardata/{eventId}', [PlantCalendar::class, 'getdata']);
Route::delete('/plantcalendardelete/{eventId}', [PlantCalendar::class, 'deleteEvent']);
Route::put('scheduleupdate/{id}',[EventController::class, 'update']);
Route::put('/plantcalendar/{eventId}/resize', [PlantCalendar::class, 'resize']);
Route::get('/plantcalendar/search', [PlantCalendar::class, 'search']);

Route::view('add-plantcalendar', 'pages.add');
Route::post('create-plantcalendar', [PlantCalendar::class, 'create']);

//FOR PLANT INFO ROUTES===========================================
Route::get('/plant-info', [PlantInfoController::class, 'index']);
Route::get('/edit/{id}', [PlantInfoController::class, 'edit']);
Route::post('/update/{id}', [PlantInfoController::class, 'update']);
Route::post('/plantinfo', [PlantInfoController::class, 'store']);
Route::post('/archive/{id}', [PlantInfoController::class, 'archive']);
Route::get('/restore', [PlantInfoController::class, 'restore']);
Route::post('/unarchive/{id}', [PlantInfoController::class, 'unarchive']);
//==========================================================================

//For farm management =======================================================

//view farm-management//
Route::get('/view-farms', [FarmController::class, 'viewFarms'])->name('farms.view');
Route::get('/view-farms3', [FarmController::class, 'viewFarms3'])->name('farms.view3');
Route::get('/farms/filterByStatus', [FarmController::class, 'filterByStatus']);
Route::post('/update-status/{id}', [FarmController::class, 'updateStatus'])->name('update.status');


//view pdf/img farm-management//
Route::get('/view-pdf/{id}/{title?}', [FarmController::class, 'viewPdf'])->name('view.pdf');
Route::get('/view-image/{id}', [FarmController::class, 'viewImage'])->name('view.image');
Route::get('/view-image1/{id}', [FarmController::class, 'viewImage1'])->name('view.image');
Route::get('/view-image2/{id}', [FarmController::class, 'viewImage2'])->name('view.image');

//xfarms farm-management//
Route::get('/view-archivefarms', [FarmController::class, 'viewArchiveFarms'])->name('archivefarms.xfarms');
Route::get('/farms/filterByStatus1', [FarmController::class, 'filterByStatus1']);

//index farm-mamangement//
Route::get('/farms3', [FarmController::class, 'index']);
Route::post('/add-farms', [FarmController::class, 'addFarms'])->name('add.farms');
Route::get('/archive-farm/{id}', [FarmController::class, 'archiveFarm'])
    ->name('archive.farm');
//=============================================================================================    

//TASK MANAGEMENT ============================================================================
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.monitoring');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::get('taskshow', [TaskController::class, 'showCompleted'])->name('taskshow');
Route::get('/missingtasks', [TaskController::class, 'missingTasks']);
Route::get('/taskassign', [TaskController::class, 'tasksAssignedToMe']);
//============================================================================================

//EXPENSES MANAGEMENT ====================================================================================
Route::get('/expense', [ExpenseController::class, 'index']);
Route::post('/expenses/add-budget', [ExpenseController::class, 'addBudget']);
Route::get('/dashboard', 'ExpenseController@showDashboard')->name('dashboard');
Route::post('/expenses/save-expense', [ExpenseController::class, 'saveExpense']);
Route::get('/compute-total-expenses', [ExpenseController::class, 'computeTotalExpenses'])->name('compute-total-expenses');
Route::get('/expenses/get-dashboard-data', [ExpenseController::class, 'getDashboardData']);
// Route::get('/expenses', [ExpenseController::class, 'getExpenses']);
//===========================================================================================================
