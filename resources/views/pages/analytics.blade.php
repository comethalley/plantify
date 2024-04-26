@include('templates.header')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/analytics.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.debug.js" integrity="sha512-+dBKPkFZW8e2RJv00jKz8d5MsWjI9g6I78I/zfE6hW7dPWGw/DLtCeEI+X3k/tEs+cOjDvg6Tbz5JG+LnVQQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script   script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
    <script src="{{ asset('assets/js/donut.js') }}"></script>
    <script src="assets/js/donut.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/plants.png" class="img-fluid" />
    <script src="https://kit.fontawesome.com/8ff31c595e.js" crossorigin="anonymous"></script>

    <style>

    .main nav .options button {
        border: none;
        background: none;
        font-size: 13px;
        font-weight: 600;
        color: #495057;
        cursor: pointer;
        text-transform: capitalize;
    }
    .main nav .options button.active {
        color: var(--primary-color);
    }

    .main nav .units button {
        width: 28px;
        height: 23px;
        border-radius: 45%;
        color: #1a1a1a;
        background-color: #fff;
    }
    .main nav .units button.active {
        color: #fff;
        background-color: #1a1a1a;
    }

    .main .cards {
    display: flex;
    gap: 25px;
    justify-content: space-between;
    }

    .cards .card {
        width: 100px;
        height: 130px;
        text-align: center;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card h2 {
        font-size: 15px;
        font-weight: 600;
    }
    .card .card-icon {
        width: 50%;
        margin: 0 auto;
    }
    .card .day-temp {
        font-size: 12px;
        display: flex;
        justify-content: center;
    }
        </style>
</head>


<body>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">      
                <div class="col-lg-12">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Dashboard</a></li>
                                    </ol>
                                </div>
                        </div>
                    </div>

                    
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                
                                            @if (Auth::check())
                                            <h4 class="fs-16 mb-1">Welcome back!, {{ Auth::user()->firstname }}!</h4>
                                            @endif

                                                <p class="text-muted mb-0">Here's what's happening with your farm today.</p>
                                            </div>  
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <!--end col-->
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-success material-shadow-none" onclick="downloadPDF()"><i class="ri-add-circle-line align-middle"></i>Download Report</button>
                                                        </div>
                                                        
                                                    <!--end row-->
                                                </form>
                                            </div>                                 
                                        </div><!-- end card header -->
                                    </div>
                                    <br>
                                    <!--end col-->
                    

                
                    <div class="row ">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="sidebar" hidden>
                                        <div>
                                            <div class="weather-icon" >
                                                <img id="icon" src="assets/weather-icon/icons/sun/27.png" alt="" />
                                            </div>
                                            
                                            <div class="temperature">
                                                <h1 id="temp">0</h1>
                                                <span class="temp-unit">°C</span>
                                            </div>
                                            <div class="date-time">
                                                <p id="date-time">Monday, 12:00</p>
                                            </div>
                                            <div class="divider"></div>
                                                <div class="condition-rain">
                                                    <div class="condition">
                                                        <i class="fas fa-cloud"></i>
                                                        <p id="condition">condition</p>
                                                    </div>
                                                    <div class="rain">
                                                        <i class="fas fa-tint"></i>
                                                        <p id="rain">perc - 0%</p>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="location">
                                            <div class="location-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="location-text">
                                                <p id="location">location</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main">
                                    
                                        <nav class="">
                                            <ul class="options" hidden>
                                                <button class="hourly">today</button>
                                                <button class="week active">week</button>
                                            </ul> 
                                            <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Weather Monitoring</strong></span></h2><hr>
                                            <ul class="options units d-flex justify-content-end">
                                                <button class="fahrenheit ">°F</button>
                                                <button class="celcius active" >°C</button>
                                            </ul>
                                        </nav>
                                        <div class="cards" id="weather-cards"></div>
                                            <div id="detailModal" style="display:none;" hidden>
                                                <p>Chance of Rain: <span id="modalRainChance">--</span>%</p>
                                                <p>Humidity: <span id="modalHumidity">--</span>%</p>
                                                <p>Sunrise:  <span id="modalSunrise">--</span></p>
                                                <p>Sunset: <span id="modalSunset">--</span></p>
                                            </div>
                                        <div class="highlights" hidden>
                                        <h2 class="heading">today's highlights</h2>
                                        <div class="cards">
                                        <div class="card2">
                                            <h4 class="card-heading">UV Index</h4>
                                            <div class="content">
                                            <p class="uv-index">0</p>
                                            <p class="uv-text">Low</p>
                                            </div>
                                        </div>
                                        <div class="card2">
                                            <h4 class="card-heading">Wind Status</h4>
                                            <div class="content">
                                            <p class="wind-speed">0</p>
                                            <p class="">Low</p>
                                            </div>
                                        </div>
                                        <div class="card2">
                                            <h4 class="card-heading">Sunrise | Sunset</h4>
                                            <div class="content">
                                            <p class="sun-rise">0</p>
                                            <p class="sun-set">0</p>
                                            </div>
                                        </div>
                                        <div class="card2">
                                            <h4 class="card-heading">Humidity</h4>
                                            <div class="content">
                                            <p class="humidity">0</p>
                                            <p class="humidity-status">Normal</p>
                                            </div>
                                        </div>
                                        <div class="card2">
                                            <h4 class="card-heading">Visibility</h4>
                                            <div class="content">
                                            <p class="visibilty">0</p>
                                            <p class="visibilty-status">Normal</p>
                                            </div>
                                        </div>
                                        <div class="card2">
                                            <h4 class="card-heading">Air Quality</h4>
                                            <div class="content">
                                            <p class="air-quality">0</p>
                                            <p class="air-quality-status">Normal</p>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <script src="{{ asset('assets/js/weather.js') }}"></script>
                                    <script src="https://cdn.db-ip.com/js/dbip.js" data-api-key="p6bcac47ae71f0285cb6343d9697e56e41a2cb92"></script>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Farming Community Overview</strong></span></h2><hr>
                                    <div class="row " style="height: 40vh;">
                                        <div class="col-xl-6">
                                            <div class=" ">
                                                <h5 class="text-muted text-uppercase fs-12">Number of Users</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="bx bx-user-circle display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-0 ms-3">
                                                        <h2 class="mb-0"><span id="totalUserCounter" class="counter-value" data-target="">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 ">
                                            <div class="">
                                                <h5 class="text-muted text-uppercase fs-12">Number of Farm Leaders</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="bx bx-user display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-0 ms-3">  
                                                        <h2 class="mb-0"><span id="farmLeaderCounter" class="counter-value" data-target="">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-xl-6 ">
                                            <div class="">
                                                <h5 class="text-muted text-uppercase fs-12">Number of Farms</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-">
                                                        <i class="ri-plant-line display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-0 ms-3">
                                                        <h2 class="mb-0"><span id="farmCounter" class="counter-value" data-target="">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-xl-6">
                                            <div class="">
                                                <h5 class="text-muted text-uppercase fs-12">Number of Farmers</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-user-6-line display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-0 ms-3">
                                                        <h2 class="mb-0"><span id="farmerCounter" class="counter-value" data-target="">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col-xl-6 -->
                    
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Quezon City District 5 Farms</strong></span></h2><hr>
                    
                                        <div id="leaflet-map" class="leaflet-map" style="height: 40vh; width: 100%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body"> 
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Notifications</strong></span></h2>
                                            <div class="position-relative overflow-auto" style="height: 40vh;" id="notificationItemsTabContent">
                                                <div class="tab-pane fade show active" id="all-noti-tab" role="tabpanel">
                                                    @if(auth()->user() && auth()->user()->notifications)
                                                    @foreach (auth()->user()->notifications as $notification)
                                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                                        @if ($notification->type === 'App\Notifications\NewNotificationEvent')
                                                        <div class="d-flex">
                                                            <img src="../assets/images/event/event.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                            <div class="flex-grow-1">
                                                                <a href="/schedules" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">New Events</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">Check it out we have new events 📆.</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">

                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>

                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\NewplantingNotification')
                                                        <div class="d-flex">


                                                            <img src="../assets/images/event/planting.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/plantcalendar" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">New Planted</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">

                                                                    <p class="mb-1">You have just planted a new plant. 🌱.</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i> {{ $notification->created_at->diffForHumans() }}</span>

                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\UpcomingHarvestNotification')
                                                        <div class="d-flex">
                                                            <img src="../assets/images/event/planting.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                            <div class="flex-grow-1">
                                                                <a href="/plantcalendar" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Upcoming Harvest Alert!</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">{{ $notification->data['message']}}</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i> {{ $notification->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\HarvestTodayNotification')
                                                        <div class="d-flex">
                                                            <img src="../assets/images/event/planting.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                            <div class="flex-grow-1">
                                                                <a href="/plantcalendar" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Harvest Day: Time to Reap the Rewards!</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">{{ $notification->data['message']}}</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i> {{ $notification->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\OutOfStockNotification')
                                                        <div class="d-flex">

                                                            <img src="../assets/images/event/oos1.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/inventory/stocks" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Running out of seeds</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">{{ $notification->data['message']}}.</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\UpcomingEventNotification')
                                                        <div class="d-flex">

                                                            <img src="../assets/images/event/event.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/schedules" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Event Reminder!</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">"{{ $notification->data['message']}}"</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">

                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>

                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\EventTodayNotification')
                                                        <div class="d-flex">

                                                            <img src="../assets/images/event/event.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/schedules" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Event Reminder: Happening Today!</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">"{{ $notification->data['message']}}"</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">

                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>

                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\NewTaskAssignNotification')
                                                        <div class="d-flex">


                                                            <img src="../assets/images/event/nt.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/tasks" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">TASK</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">{{ $notification->data['message']}}.</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">

                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>

                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\CompleteTaskNotification')
                                                        <div class="d-flex">


                                                            <img src="../assets/images/event/complete.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/taskshow" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">TASK</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">{{ $notification->data['message']}}.</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">

                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>

                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        @elseif ($notification->type === 'App\Notifications\MissingTaskNotification')
                                                        <div class="d-flex">


                                                            <img src="../assets/images/event/missing.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">

                                                            <div class="flex-grow-1">
                                                                <a href="/missingtasks" class="stretched-link">
                                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">MISSING TASK</h6>
                                                                </a>
                                                                <div class="fs-13 text-muted">
                                                                    <p class="mb-1">{{ $notification->data['message']}}.</p>
                                                                </div>
                                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">

                                                                    <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                            <!-- <div class="px-2 fs-15">
                                                                <div class="form-check notification-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                                </div>
                                                            </div> -->


                                                        </div>
                                                        @endif
                                                    </div>

                                                    @endforeach
                                                    @else
                                                    <p>No notifications found.</p>
                                                    @endif
                                                </div>



                                                <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">

                                                </div>
                                                <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                                                
                                            </div>
                                        </div>
                                    
                                </div> 
                            </div>
                        </div> --}}

                        <div class="col-xl-12">
                            <div class="card" >
                                <div class="card-body">
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Harvesting Metrics</strong></span></h2>
                                        <div class="row position-relative " style="height: 65vh;">
                                            <div class="col-md-3">
                                                <div class="align-items-center justify-content-center ">
                                                    <div class="col-xl-12 barangaySelector">
                                                        <label for="">Barangay:</label>
                                                        <select id="barangaySelect" class="w-100">
                                                            <option value="" selected disabled>Select Barangay</option>
                                                            @foreach($barangayOptions as $option)
                                                                <option value="{{ $option['text'] }}">{{ $option['text'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mt-3 col-xl-12 barangaySelector">
                                                        <label for="">Farm:</label>
                                                        <select id="farmSelect" class="w-100">
                                                            <option value="" selected disabled>Select Farm</option>
                                                        </select>
                                                    </div>
                                                    <div class="mt-3 col-xl-12 barangaySelector">
                                                        <label for="">Year:</label>
                                                        <select id="yearSelect" class="w-100">
                                                            <option value="" disabled>Select Year</option>
                                                            <option value="2024" selected>2024</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2022">2022</option>
                                                            <!-- Add more years as needed -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-9"> 
                                                <div class="text-muted">                         
                                                    <div id="farmChart"></div>
                                                    <div id="month-details" style="display: none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                     
                            <!-- INSERT HERE NEW ROW  -->
                        

                        
                        
                    <div> <!-- end of row  -->

                    <div class="row justify-content-center">
                        


                    </div><!-- end of row  -->

                <div> <!-- end of OVERALL ROW  -->

                </div> 
            </div>
        </div>
    </div>

    <!-- END layout-wrapper -->




      <!------------------------------------------- Theme Settings ------------------------------------------------------ -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcRharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- Include Leaflet library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    function downloadPDF() {
    window.location.href = '{{ route('analytics.pdf') }}';
}


        function updateCounters() {
            // Make an AJAX request to fetch counts
            $.ajax({
                url: '/analytics/count',
                type: 'GET',
                success: function(data) {
                    // Update farm leader counter
                    $('#farmLeaderCounter').text(data.farmLeaderCount);
                    $('#farmLeaderCounter').attr('data-target', data.farmLeaderCount);

                    // Update farmer counter
                    $('#farmerCounter').text(data.farmerCount);
                    $('#farmerCounter').attr('data-target', data.farmerCount);

                    // Update total user counter
                    $('#totalUserCounter').text(data.totalUserCount);
                    $('#totalUserCounter').attr('data-target', data.totalUserCount);

                    // Update farm counter
                    $('#farmCounter').text(data.farmCount);
                    $('#farmCounter').attr('data-target', data.farmCount);

                    // Update analytics report details paragraph
                    $('#analyticsReportDetails').text(`Total numbers of users: ${data.totalUserCount}, Farms: ${data.farmCount}, Farm Leaders: ${data.farmLeaderCount}, and Farmers: ${data.farmerCount}`);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching counts:', error);
                }
            });
        }
    // Call the function when the page loads
    $(document).ready(function() {
        updateCounters();
    });
    
   document.addEventListener('DOMContentLoaded', function() {
    // Parse the data from the controller
    var expensesData = JSON.parse('{!! $expensesData !!}');
    var plantingData = {!! $plantingData !!};
    var farmsData = {!! $farmsData !!};
    var farmSelector = document.getElementById('farmSelect');
    var barangaySelector = document.getElementById('barangaySelect');
    var plantingChart;
// Populate farm selector options
    farmsData.forEach(function(farm) {
        var option = new Option(farm.farm_name, farm.id);
        farmSelector.add(option);
    });

    $(document).ready(function() {
    $('#barangaySelect').change(function() {
        var selectedOption = $(this).val();

        // Clear existing options in farmSelect, except for a default or placeholder option if you have one
        $('#farmSelect').find('option').not(':first').remove();
        // Perform AJAX request
        $.ajax({
            url: '/farmsAnalytics/' + selectedOption, // Replace with your API endpoint
            method: 'GET', // or 'GET' depending on your API
            success: function(response) {
                // Assume response.farms contains the relevant farms for the selected barangay
                $.each(response.farms, function(index, farm) {
                    $('#farmSelect').append($('<option>', {
                        value: farm.id, // Assuming farm ID is used as value
                        text: farm.farm_name // Assuming farm name is displayed as text
                    }));
                });
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    if (typeof ApexCharts !== 'undefined') {
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                events: {
                    dataPointSelection: function(event, chartContext, config) {
                        var selectedMonth = chartContext.w.config.xaxis.categories[config.dataPointIndex];
                        var detailsHtml = '';
                        if (!window.farmData) {
                            console.error('Farm data is not available.');
                            return;
                        }
                        var selectedYear = $('#yearSelect').val();
                        var details = window.farmData.filter(function(item) {
                            var itemMonth = new Date(item.start).toLocaleString('default', { month: 'long' });
                            var itemYear = new Date(item.start).getFullYear().toString();
                            return itemMonth === selectedMonth && itemYear === selectedYear;
                        });

                        details.forEach(function(item) {
                            var createdDate = new Date(item.start);
                            var formattedCreatedDate = createdDate.toLocaleDateString('en-US', {
                                year: 'numeric', month: 'long', day: 'numeric'
                            }) + ' | ' + createdDate.toLocaleTimeString('en-US', {
                                hour: '2-digit', minute: '2-digit', hour12: true
                            });
                            detailsHtml += `<div><h4>${item.title}</h4><p>Created At: ${formattedCreatedDate}</p><p>Harvested: ${item.harvested}</p><p>Destroyed: ${item.destroyed}</p></div>`;
                        });

                        var monthDetailsElement = document.getElementById('month-details');
                        monthDetailsElement.innerHTML = detailsHtml;
                        monthDetailsElement.style.display = details.length > 0 ? 'block' : 'none';
                    }
                }
            },
            series: [
                {
                    name: 'Harvested',
                    data: []
                },
                {
                    name: 'Destroyed',
                    data: []
                }
            ],
            xaxis: {
                categories: [] // This will be updated dynamically
            }
        };

        var farmChart = new ApexCharts(document.querySelector("#farmChart"), options);
        farmChart.render();

        // Trigger the chart update when the year or farm selection changes
        $('#farmSelect, #yearSelect').change(function() {
            var selectedOption = $('#farmSelect').val();
            var selectedYear = $('#yearSelect').val();

            // Perform AJAX request
            $.ajax({
                url: `/farmsAnalyticsData/${selectedOption}?year=${selectedYear}`,
                method: 'GET',
                success: function(response) {
                    console.log("AJAX response:", response);

                    if (response && response.monthlyData) {
        var harvestedData = [];
        var destroyedData = [];
        var categories = Object.keys(response.monthlyData);

        categories.forEach(function(month) {
            harvestedData.push(parseFloat(response.monthlyData[month].harvested));
            destroyedData.push(parseFloat(response.monthlyData[month].destroyed));
        });

        // Store the farms data in a global variable for access in the dataPointSelection event
        window.farmData = response.farms;

        // Update the chart with new data and months
        farmChart.updateOptions({
            series: [
                {
                    name: 'Harvested',
                    data: harvestedData
                },
                {
                    name: 'Destroyed',
                    data: destroyedData
                }
            ],
            xaxis: {
                categories: categories
            }
        });

        // Generate the PDF with the chart data
        var formData = new FormData();
        formData.append('imageData', chart.exportChart({ format: 'png' }));
        formData.append('monthlyData', JSON.stringify(response.monthlyData));
        formData.append('farms', JSON.stringify(response.farms));

        $.ajax({
            url: '/generatePdf',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(pdfData) {
                console.log("PDF response:", pdfData);
                // Display or download the PDF as needed
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        console.error('Fetched data is not in the expected format', response);
    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    } else {
        console.error('ApexCharts library is not loaded.');
    }
});



    // DONUT CHART  0

        // Prepare the data for the expenses donut chart
        var expensesSeries = expensesData.map(function(data) {
            return parseFloat(data.amount);
        });

        var expensesLabels = expensesData.map(function(data) {
            return data.description;
        });

    // Define the donut chart options
    var donutOptions = {
        series: expensesSeries,
        chart: {
            type: 'donut',
            events: {
                dataPointSelection: function(event, chartContext, config) {
                    // Get the index of the clicked segment
                    var clickedIndex = config.dataPointIndex;
                    var clickedData = expensesData[clickedIndex];

                    // Format the date and time
                    var dateCreated = new Date(clickedData.created_at);
                    var formattedDate = (dateCreated.getMonth() + 1).toString().padStart(2, '0') + '/'
                                        + dateCreated.getDate().toString().padStart(2, '0') + '/'
                                        + dateCreated.getFullYear();
                    var hours = dateCreated.getHours();
                    var minutes = dateCreated.getMinutes().toString().padStart(2, '0');
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; 
                    var formattedTime = hours.toString().padStart(2, '0') + ':' + minutes + ' ' + ampm;

                    var friendlyDateTime = formattedDate + ' | ' + formattedTime;

                    document.getElementById('details-description').textContent = 'Description: ' + clickedData.description;
                    document.getElementById('details-amount').textContent = 'Amount: ₱' + clickedData.amount;
                    document.getElementById('details-created-at').textContent = 'Date: ' + friendlyDateTime;

                    // Make the details section visible
                    var detailsSection = document.getElementById('details-section');
                        detailsSection.style.display = 'block';
                }
            }
        },
        labels: expensesLabels,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                }
            }
        }],
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                               
                                return w.globals.seriesTotals.reduce(function(a, b) {
                                    return a + b;
                                }, 0).toFixed(2); // Format to two decimal places
                            }
                        }
                    }
                }
            }
        }
    };

    var donutChart = new ApexCharts(document.querySelector("#donut-chart"), donutOptions);
    donutChart.render();
    createPlantingBarChart();
});

   
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize the map
    var map = L.map('leaflet-map').setView([14.717499241909843, 121.04829782475622], 14);

    var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© CUAI'
    }).addTo(map);

    $(document).ready(function () {
        // Fetch farm locations from the server on page load
        $.ajax({
            url: '/get_maps',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log('Farm locations retrieved successfully:', data);
                displayFarmLocations(data); // Display farm locations on the map
            },
            error: function (xhr, status, error) {
                console.error('Error retrieving farm locations:', error);
            },
        });
    });

    // Function to display farm locations on the map
    function displayFarmLocations(farmLocations) {
    farmLocations.forEach(function (location) {
        if (location.latitude && location.longitude) {
            // Create a custom HTML string for the popup content
            var popupContent = "<b>Farm Name: " + location.location_name + "</b><br>Address: " + location.address;

            // Create a marker and bind a popup with custom content
            L.marker([parseFloat(location.latitude), parseFloat(location.longitude)], { icon: redIcon })
                .addTo(map)
                .bindPopup(popupContent);
        }
    });
}
</script>
</body>
</html>