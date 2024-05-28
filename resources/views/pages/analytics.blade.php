@include('templates.header')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/analytics.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('assets/css/weather.css') }}" rel="stylesheet" type="text/css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.debug.js" integrity="sha512-+dBKPkFZW8e2RJv00jKz8d5MsWjI9g6I78I/zfE6hW7dPWGw/DLtCeEI+X3k/tEs+cOjDvg6Tbz5JG+LnVQQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
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

        @media (max-width: 600px) {
            .cards {
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: flex-start;
            }

            .cards .card {
                width: calc(50% - 20px);
                margin-bottom: 20px;
            }
        }

        .suggestions {
            height: 350px;
            /* Adjust this value according to your design */
            overflow-y: auto;
            /* Add scrollbars if content overflows */
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
                            @if(session('user') && session('user')->role_id != 5)
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-soft-success material-shadow-none" onclick="downloadPDF()"><i class="ri-add-circle-line align-middle"></i>Download Report</button>
                                        </div>
                                        <!--end row-->
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div><!-- end card header -->
                    </div>
                    <br>
                    <!--end col-->



                    <div class="row ">
                        <div class="col-xl-4 d-inline-block">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase fw-medium text-warning text-truncate mb-2"> Total Harvest</p>
                                    <center>
                                        <h1><span class="counter-value">{{ $totalHarvested }} </span>kg </h1>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 d-inline-block">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase fw-medium text-danger text-truncate mb-2"> Total Withered</p>
                                    <center>
                                        <h1><span class="counter-value">{{ $totalDestroyed }} </span>kg </h1>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 d-inline-block">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase fw-medium text-truncate mb-2" style="color: #57AA2C;"> Total Planted</p>
                                    <center>
                                        <h1><span class="counter-value">{{ $totalPlanted }} </span>g</h1>
                                    </center>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Farming Community Overview</strong></span></h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-3">
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
                                        <div class="col-xl-3" id="farmLeadersSection">
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
                                        <div class="col-xl-3">
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
                                        <div class="col-xl-3">
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
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"><strong>Farms with the highest yield</strong></span></h2>
                                    <hr>
                                    <div style="height: 40vh; width: 100%">
                                        <canvas id="horizontalChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="mb-4 text-center"><span style="color: #57AA2C;"> <strong>Quezon City District 5 Farms</strong></span></h2>
                                    <hr>

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

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center"><span style="color: #57AA2C;"><strong>Suggestion and Tips to improve your harvest !</strong></span></h2>
                <hr>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:center;gap:5px;">
                                <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="col-12">
                                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($destroyedCrops->chunk(3) as $key => $chunk)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($chunk as $crop)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <div class="card-body suggestions">
                                                            <h4 class="card-title">Destroyed crop: {{ $crop->title }}</h4>
                                                            <h4 class="card-title">Planting period: {{ $crop->start }} to {{ $crop->end }}</h4>
                                                            <hr>
                                                            <h4 class="card-title">Reasons: {{ $crop->reason }}</h4>
                                                            <p class="card-text">Tips and Suggestions: {{ $crop->suggestions }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center"><span style="color: #57AA2C;"><strong>Harvesting Metrics</strong></span></h2>
                <hr>
                <div style="display:flex;justify-content:center;height: 450px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center"><span style="color: #57AA2C;"><strong>Most Harvested Crops</strong></span></h2>
                <hr>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center"><span style="color: #57AA2C;"><strong>Most Withered Crops</strong></span></h2>
                <hr>
                <canvas id="destroyedPieChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center"><span style="color: #57AA2C;"><strong>Common Reason of Withered Crops</strong></span></h2>
                <hr>
                <ul>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                    <li>High Temperature - 83 cases</li>
                </ul>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
        document.addEventListener('DOMContentLoaded', (event) => {
            const horizontalChart = document.getElementById('horizontalChart').getContext('2d');
            const barChart = document.getElementById('barChart').getContext('2d');
            const pieChart = document.getElementById('pieChart').getContext('2d');
            const destroyedPieChart = document.getElementById('destroyedPieChart').getContext('2d');

            $.ajax({
                url: '/highestYield',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Extract data from the response
                    var farmWithHighestYield = response.farmWithHighestYield;

                    // Initialize arrays to store farm IDs and total harvested amounts
                    var labels = [];
                    var data = [];
                    var backgroundColors = []; // Array to store different background colors

                    // Define an array of colors (you can customize this array)
                    var colors = [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ];

                    // Iterate over each object in the response array
                    farmWithHighestYield.forEach(function(farm, index) {
                        // Extract farm ID and total harvested amount
                        labels.push(farm.farm_name);
                        data.push(farm.total_harvested);

                        // Assign a different color to each bar
                        backgroundColors.push(colors[index % colors.length]);
                    });

                    // Update the horizontal bar chart dataset
                    var chartData = {
                        labels: labels,
                        datasets: [{
                            label: 'Total Harvested',
                            data: data,
                            backgroundColor: backgroundColors,
                            borderColor: backgroundColors,
                            borderWidth: 1
                        }]
                    };

                    // Create the horizontal bar chart
                    new Chart(horizontalChart, {
                        type: 'bar',
                        data: chartData,
                        options: {
                            indexAxis: 'y', // This option makes the bar chart horizontal
                            scales: {
                                x: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });



            const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $.ajax({
                url: '/harvestingMetrics',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var metricsData = response.harvestingMetrics;
                    var harvestedData = new Array(12).fill(0); // Initialize an array with 12 zeros
                    var destroyedData = new Array(12).fill(0); // Initialize an array with 12 zeros

                    metricsData.forEach(function(metric) {
                        var monthIndex = labels.indexOf(metric.month);
                        if (monthIndex !== -1) {
                            harvestedData[monthIndex] = metric.total_harvested;
                            destroyedData[monthIndex] = metric.total_destroyed;
                        }
                    });

                    new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Harvested',
                                    data: harvestedData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgb(75, 192, 192)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Withered',
                                    data: destroyedData,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


            var pieChartColors = [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)'
            ];

            $.ajax({
                url: '/harvestedCrops',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Extract data from the response
                    var cropsData = response.topHarvestedCrops;
                    var labels = [];
                    var data = [];

                    // Populate arrays for labels and data
                    cropsData.forEach(function(crop) {
                        labels.push(crop.title);
                        data.push(crop.total_harvested);
                    });

                    // Create the pie chart
                    new Chart(pieChart, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Top Harvested Crops',
                                data: data,
                                backgroundColor: pieChartColors, // Use predefined colors
                                hoverOffset: 4
                            }]
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $.ajax({
                url: '/witheredCrops',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Extract data from the response
                    var cropsData = response.topDestroyedCrops;
                    var labels = [];
                    var data = [];

                    // Populate arrays for labels and data
                    cropsData.forEach(function(crop) {
                        labels.push(crop.title);
                        data.push(crop.total_destroyed);
                    });

                    // Create the pie chart
                    new Chart(destroyedPieChart, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Top Destroyed Crops',
                                data: data,
                                backgroundColor: pieChartColors, // Use predefined colors
                                hoverOffset: 4
                            }]
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });
    </script>
    <script>
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

        $(document).ready(function() {
            // Fetch farm locations from the server on page load
            $.ajax({
                url: '/get_maps',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Farm locations retrieved successfully:', data);
                    displayFarmLocations(data); // Display farm locations on the map
                },
                error: function(xhr, status, error) {
                    console.error('Error retrieving farm locations:', error);
                },
            });
        });

        // Function to display farm locations on the map
        function displayFarmLocations(farmLocations) {
            farmLocations.forEach(function(location) {
                if (location.latitude && location.longitude) {
                    // Create a custom HTML string for the popup content
                    var popupContent = "<b>Farm Name: " + location.location_name + "</b><br>Address: " + location.address;

                    // Create a marker and bind a popup with custom content
                    L.marker([parseFloat(location.latitude), parseFloat(location.longitude)], {
                            icon: redIcon
                        })
                        .addTo(map)
                        .bindPopup(popupContent);
                }
            });
        }
    </script>
</body>

</html>