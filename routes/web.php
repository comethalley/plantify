<?php

use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FarmController;
use App\Http\Controllers\EmailVerification;
use App\Http\Controllers\PiuController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Requests\PdfRequest;
use Endroid\QrCode\Writer\Result\PdfResult;
use Illuminate\Http\Request;

use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\SendMessageController;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;




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

Route::get('/', [AuthController::class, 'landingpage']);
Route::get('/dashboard/analytics', [AnalyticsController::class, 'index'])->name('dashboard.analytics')->middleware('auth');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::get('/signup', [AuthController::class, 'viewSignup']);
Route::post('/login/process', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'signup']);
//Route::middleware(['auth'])->get('/authenticated-route', 'AuthController@index');


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
Route::get('/getUom', [InventoryController::class, 'getUom']);
Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/getAllUom', [InventoryController::class, 'getUom']);
Route::post('/edit-uom/{id}', [InventoryController::class, 'updateUom']);
Route::post('/archive-uom/{id}', [InventoryController::class, 'archiveUom']);
Route::get('/getAllStock', [InventoryController::class, 'getAllStock']);
Route::get('/plantifeed', [ForumController::class, 'index']);
Route::get('/inventory/fertilizer', [InventoryController::class, 'fertilizer']);
Route::post('/add-fertilizer', [InventoryController::class, 'addFertilizer']);
Route::get('/get-fertilizer', [InventoryController::class, 'getFertilizer']);
Route::post('/edit-fertilizer/{id}', [InventoryController::class, 'updateFertilizer']);
Route::post('/archive-fertilizer/{id}', [InventoryController::class, 'archiveFertilizer']);
Route::get('/inventory/tools', [InventoryController::class, 'tools']);
Route::get('/send-message', [SendMessageController::class, 'index']);



// routes/web.php



Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');


Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::post('/post', [PostController::class, 'store'])->name('post.store');



Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');



Route::get('/search', [SearchController::class, 'search'])->name('forum.search');
Route::get('/search-results', [SearchController::class, 'index'])->name('pages.search_results');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');

Route::delete('/forum/delete-question/{id}', [ForumController::class, 'deleteQuestion']);
Route::delete('/forum/delete-post/{id}', [PostController::class, 'deletePost']);


Route::post('/edit-question/{id}', [ForumController::class, 'editQuestion']);
Route::put('/edit-question/{id}', [ForumController::class, 'editQuestion'])->name('editQuestion');

Route::post('/edit-post/{id}', [PostController::class, 'editPost']);
Route::put('/edit-post/{id}', [PostController::class, 'editPost'])->name('editPost');

Route::get('/profilefeed', [UserPhotoController::class, 'index']);
Route::get('pages/profilefeed', [UserPhotoController::class, 'index'])->name('profile');

// Route for updating profile information
Route::post('/update-profile', [UserPhotoController::class, 'updateProfile'])->name('update.profile');


// routes/web.php








// Direct Messages
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chat/{messageId}/reply', [ChatController::class, 'storeReply'])->name('chat.storeReply');
Route::get('/chat/users', [ChatController::class, 'displayChatUsers'])->name('chat.displayUsers');
Route::post('/create-thread/{userId}', [ThreadController::class, 'createThread'])->name('create.thread');
Route::get('/thread', [ThreadController::class, 'index'])->name('thread.index');
Route::get('/thread/{threadId}', [ThreadController::class, 'showThread'])->name('show.thread');
Route::post('/thread/{threadId}/store-message', [ThreadController::class, 'storeMessage'])->name('store.message');
Route::delete('/delete-message/{messageId}', [ThreadController::class, 'deleteMessage'])->name('delete.message');
Route::post('/mark-messages-as-read/{userId}', [ChatController::class, 'markMessagesAsRead']);
Route::get('/search-users', [ChatController::class, 'searchUsers']);
Route::get('/threads/{threadId}/messages', [ThreadController::class, 'fetchMessages']);

// Group Chats
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/{groupId}', [GroupController::class, 'show'])->name('groups.show'); // Make the farmId parameter optional
Route::post('/groups/{group}/join', [GroupController::class, 'join'])->name('groups.join');
Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
Route::post('/store-group-message/{groupId}', [GroupController::class, 'storeGroupMessage'])->name('store.group.message');
Route::delete('/delete-group-message/{messageId}', [GroupController::class, 'deleteMessage'])->name('delete.group.message');
Route::post('/mark-group-messages-as-read/{groupId}', [GroupController::class, 'markGroupMessagesAsRead']);
Route::get('/fetch-messages/{groupId}', [GroupController::class, 'fetchMessages'])->name('fetch.messages');

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
Route::get('/get_maps', [qcmaps::class, 'getMaps']);
Route::post('/farm_locations', [qcmaps::class, 'store']);

// Start Full Calender=================================================================
Route::get('/schedules', [EventController::class, 'index']);
Route::get('/schedulesget', [EventController::class, 'getEvents']);
Route::get('/schedulesdata/{id}', [EventController::class, 'getdata']);
Route::delete('/scheduledelete/{id}', [EventController::class, 'deleteEvent']);
Route::put('/scheduleupdate/{id}', [EventController::class, 'update']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/events/search', [EventController::class, 'search']);
Route::get('/upcomingevent', [EventController::class, 'notifyUpcomingEvents']);

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
Route::get('/calendar_list', [PlantCalendar::class, 'calendar_list']);

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
//PES=======================================================================
Route::get('/pesticides', [PlantInfoController::class, 'pesticides']);
Route::post('/pupdate/{id}', [PlantInfoController::class, 'pupdate']);
Route::post('/pesticides', [PlantInfoController::class, 'pstore']);
Route::get('/pedit/{id}', [PlantInfoController::class, 'pedit']);
Route::post('/pesarchive/{id}', [PlantInfoController::class, 'pesarchive']);
//FER=======================================================================
Route::get('/fertilizers', [PlantInfoController::class, 'fertilizers']);
Route::post('/fertilizers', [PlantInfoController::class, 'fstore']);
Route::post('/fupdate/{id}', [PlantInfoController::class, 'fupdate']);
Route::get('/fedit/{FertID}', [PlantInfoController::class, 'fedit']);
Route::post('/fertarchive/{id}', [PlantInfoController::class, 'fertarchive']);

//For farm management =======================================================

//index farm-mamangement//
Route::get('/Farms-District-5', [FarmController::class, 'index']);
Route::post('/add-farms', [FarmController::class, 'addFarms'])->name('add.farms');
Route::get('/archive-farm/{id}', [FarmController::class, 'archiveFarm'])->name('archive.farm');

//view farm-management//
Route::get('/Farm-Management-High', [FarmController::class, 'viewFarms'])->name('farms.view');
Route::get('/Farm-Management', [FarmController::class, 'viewFarms3'])->name('farms.view3');
Route::get('/farms/filterByStatus', [FarmController::class, 'filterByStatus']);
Route::post('/update-status/{id}', [FarmController::class, 'updateStatus'])->name('update.status');


//view pdf/img farm-management//
// Route::get('/view-pdf/{id}/{title?}', [FarmController::class, 'viewPdf'])->name('view.pdf');
// Route::get('/view-image/{id}', [FarmController::class, 'viewImage'])->name('view.image');
// Route::get('/view-image1/{id}', [FarmController::class, 'viewImage1'])->name('view.image');
// Route::get('/view-image2/{id}', [FarmController::class, 'viewImage2'])->name('view.image');

//xfarms farm-management//
Route::get('/view-archivefarms', [FarmController::class, 'viewArchiveFarms'])->name('archivefarms.xfarms');
Route::get('/farms/filterByStatus1', [FarmController::class, 'filterByStatus1']);
Route::get('/farm/{id}/details', [FarmController::class, 'getFarmDetails']);
Route::post('/update-farm-status-cancel/{id}', [FarmController::class, 'updateStatusCancel']);
Route::post('/update-farms/{id}', [FarmController::class, 'updateFarm'])->name('farms.update');
Route::post('/set-date-farm/{id}', [FarmController::class, 'SetDateStatus'])->name('set.date.farm');



//=============================================================================================    

//TASK MANAGEMENT ============================================================================
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.monitoring');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::post('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::get('taskshow', [TaskController::class, 'showCompleted'])->name('taskshow');
Route::get('/missingtasks', [TaskController::class, 'missingTasks']);
Route::get('/taskassign', [TaskController::class, 'tasksAssignedToMe']);
Route::get('/task/filterByStatus', [TaskController::class, 'filterBystatus']);
Route::post('/tasks/{task}/archive', [TaskController::class, 'archive'])->name('tasks.archive');
Route::get('/archived', [TaskController::class, 'showArchived'])->name('archived');
Route::post('/tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
//============================================================================================

//EXPENSES MANAGEMENT ====================================================================================
Route::get('/expense', [ExpenseController::class, 'index']);
Route::post('/expenses/add-budget', [ExpenseController::class, 'addBudget']);
Route::post('/expenses/save-expense', [ExpenseController::class, 'saveExpense'])->name('saveExpense');
Route::get('/expenses/get-last-amount', [ExpenseController::class, 'getLastAmount']);
Route::get('/compute-total-expenses', [ExpenseController::class, 'computeTotalExpenses'])->name('compute-total-expenses');
Route::get('/expenses/get-dashboard-data', [ExpenseController::class, 'getDashboardData']);
Route::get('/expenses/get-expenses-by-category', [ExpenseController::class, 'getExpensesByCategory']);
// Route::get('/expenses', [ExpenseController::class, 'getExpenses']);
//===========================================================================================================

//Email Verification ===================================================
Route::get('/verify-email', [EmailVerification::class, 'emailVerification']);
Route::get('/empty-code/{id}', [EmailVerification::class, 'emptyCode']);
Route::get('/resend-code/{id}', [EmailVerification::class, 'resendCode']);
Route::post('/confirm-code/{id}', [EmailVerification::class, 'verifyEmail']);
Route::get('/landing-page', [AuthController::class, 'landingpage']);
Route::post('/change-password/{id}', [EmailVerification::class, 'changePassword']);
//===========================================================================================================

//Botaknows Userside ===================================================
Route::get('/piu/piu', [PiuController::class, 'index']);
Route::get('/piu/show/{id}', [PiuController::class, 'show']);


Route::get('/piu/pes', [PiuController::class, 'pes']);
Route::get('/piu/showpes/{id}', [PiuController::class, 'showpes']);

Route::get('/piu/fiu', [PiuController::class, 'fer']);
Route::get('/piu/showfiu/{id}', [PiuController::class, 'showfiu']);




//===========================================================================================================

Route::middleware(['auth', 'checkrole:1,2,3'])->group(function () {
    Route::get('/analytics', [AnalyticsController::class, 'index']);
});
Route::get('/analytics/count', [AnalyticsController::class, 'count']);
Route::get('/analytics/pdf', [AnalyticsController::class, 'downloadPdf'])->name('analytics.pdf');



Route::get('api/farms', [FarmController::class, 'fetchFarmsByBarangay'])->name('api.farms');
Route::get('/farmsAnalytics/{slug}', [AnalyticsController::class, 'getFarms']);
Route::get('/farmsAnalyticsData/{num}', [AnalyticsController::class, 'getFarmsData']);

Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
});

//PLANTIFEED ===============================================

Route::get('/getPost', [ForumController::class, 'getPost']);
Route::get('/getComment/{num}', [CommentController::class, 'getComment']);
Route::get('/getReply/{num}', [CommentController::class, 'getReply']);
Route::post('/reply/store', [CommentController::class, 'createReply']);
