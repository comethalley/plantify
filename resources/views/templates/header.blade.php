<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PlantiCUAI</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/plantifeedpics/rounded.png" class="img-fluid" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->

    <!-- Weather config -->
    <!-- ApexChart - Piegraph (Js and cdn) -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/js/donut.js') }}"></script>

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />



    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

    <script src="{{ asset('assets/js/inventory.js') }}"></script>
    <script src="{{ asset('assets/js/uom.js') }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    <script src="{{ asset('assets/js/farmleader.js') }}"></script>
    <script src="{{ asset('assets/js/plantinfo.js') }}"></script>
    <script src="{{ asset('assets/js/forum.js') }}"></script>
    <script src="{{ asset('assets/js/fertilizer.js') }}"></script>
    <script src="{{ asset('assets/js/inventory_fertilizer.js') }}"></script>
    <script src="{{ asset('assets/js/farmers.js') }}"></script>
    <script src="{{ asset('assets/js/restore.js') }}"></script>


    <!--markusread JS-->
    <script src="{{ asset('assets/js/markasread.js') }}"></script>

    <!--Scanner JS-->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <!--Weather JS-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Quill-->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
    <link href="https://unpkg.com/quill-image-uploader@1.2.4/dist/quill.imageUploader.min.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://unpkg.com/quill-image-uploader@1.2.4/dist/quill.imageUploader.min.js"></script>

    <!--Pusher JS-->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <style>
        .tab-content {
            max-height: 400px;
            /* Set maximum height for the notification content area */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        body {
            top: 0 !important;
        }

        #interestButton {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        #starIcon {
            color: black;
            transition: color 0.3s;
        }

        #interestButton.interested #starIcon {
            color: #FFD700;
        }

        #sloading {
            display: none;
            position: fixed;
            height: 100%;
            width: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        #sloading img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            /* Adjust width as needed */
            height: 100px;
            /* Adjust height as needed */
        }
    </style>
</head>

<body onload="">
    <div id='sloading'><!-- Add overlay here -->
        <center><img src='/images/loading.gif'></center>

    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22" />
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="17" />
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22" />
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="17" />
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <span id="current-day"></span>
                            <button id="weather-button" type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" style="color: rgb(5, 5, 5);">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <img id="weather-icon" src="" alt="">
                                <span id="temperature-placeholder">--°C</span>
                            </button>
                            @if(session('user') && (session('user')->role_id == 3 || session('user')->role_id == 4 || session('user')->role_id == 1 ))
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span id="temperature-placeholder">{{ $farmName }}</span></strong>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button id="google_translate_element">

                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen fs-22"></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class="bx bx-moon fs-22"></i>
                            </button>
                        </div>

                        <div class="dropdown topbar-head-dropdown ms-1 header-item" id="markasread">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="markasread" onclick="markNotificationAsRead()" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell fs-22"></i>
                                <span id="reload-section" class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill" id="markasread">
                                    @if(auth()->user())
                                    {{ count(auth()->user()->unreadNotifications) }}
                                    @else
                                    0
                                    @endif
                                    <span class="visually-hidden">
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                                <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0 fs-16 fw-semibold text-white">
                                                    Notifications
                                                </h6>
                                            </div>
                                            <div class="col-auto dropdown-tabs">
                                                <span class="badge bg-light-subtle text-body fs-13">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-2 pt-2">
                                        <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                                    All
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
                                                Message
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
                                                Forum
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content position-relative overflow-auto" id="notificationItemsTabContent">
                                    <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                        @if(auth()->user() && auth()->user()->notifications)
                                        @foreach (auth()->user()->notifications as $notification)
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            @if ($notification->type === 'App\Notifications\NewNotificationEvent')
                                            <div class="d-flex">
                                                <img src="../assets/images/event/event.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <a href="/schedules" class="stretched-link event-notification" data-event-id="{{ $notification->event_id }}">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $notification->data['title']}}</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Check it out we have new events 📆.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
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

                                            </div>
                                            @endif
                                            @if ($notification->type === 'App\Notifications\UserLoginNotification')
                                                    <div class="d-flex">
                                                        <img src="../assets/images/notif/user.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">User Login</h6>
                                                            <div class="fs-13">
                                                                <p class="mb-1">{{ $notification->data['role_name'] }}  {{ $notification->data['lastname'] }} logged in.</p>
                                                            </div>
                                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                        </div>

                                        @endforeach
                                        @else
                                        <p>No notifications found.</p>
                                        @endif
                                    </div>




                                    <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                                    @if(auth()->user() && auth()->user()->notifications)
                                                @foreach (auth()->user()->notifications as $notification)
                                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                                        @if ($notification->type === 'App\Notifications\NewMessageNotification')
                                                            <!-- Your existing event notification code -->
                                                            <div class="d-flex">
                                                                <img src="../assets/images/notif/Message.png" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                                <div class="flex-grow-1">
                                                                    <a href="/thread/1" class="stretched-link">
                                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">New Message </h6>
                                                                    </a>
                                                                    <div class="fs-13 text-muted">
                                                                        <p class="mb-1">You have received a new message.</p>
                                                                    </div>
                                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                        <span><i class="mdi mdi-clock-outline" id="notification-time"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                    </div>
                                    <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                                    <div class="notification-actions" id="notification-actions">
                                        <div class="d-flex text-muted justify-content-center">
                                            Select
                                            <div id="select-content" class="text-body fw-semibold px-1">
                                                0
                                            </div>
                                            Result
                                            <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">

                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{asset('assets/images/plantifeedpics/rounded.png')}}" alt="Header Avatar" />
                                    <span class="text-start ms-xl-2">
                                        @if (Auth::check())
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->firstname }}</span>
                                        @if (Auth::user()->role_id == 1)
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Super Admin</span>
                                        @endif
                                        @if (Auth::user()->role_id == 2)
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Admin</span>
                                        @endif
                                        @if (Auth::user()->role_id == 3)
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Farm Leader</span>
                                        @endif
                                        @if (Auth::user()->role_id == 4)
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Farmer</span>
                                        @endif
                                        @if (Auth::user()->role_id == 5)
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">User</span>
                                        @endif
                                        @endif

                                    </span>
                                </span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                @if (Auth::check())
                                <h6 class="dropdown-header">Welcome {{ Auth::user()->role }}</h6>
                                @endif

                                <a class="dropdown-item" href="/profile-feed"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Profile</span></a>
                                @if(session('user') && session('user')->role_id != 5)
                                <a class="dropdown-item" href="/tasks"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Taskboard</span>
                                </a>
                                @endif

                                <div class="dropdown-divider"></div>

                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" href="#"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout">Logout</span></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu" style="background-color:darkgreen;">

            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color:darkgreen;">
                <!-- Dark Logo-->
                </br>
                <a href="/dashboard/analytics" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/plantifeedpics/rounded.png') }}" alt="" height="20" width="20" />
                    </span>
                    <span class="logo-lg">
                        <div style="display: flex; justify-content: center;">
                            <img src="{{ asset('assets/images/plantifeedpics/cuai.png') }}" alt="" height="50" />
                        </div>
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="/dashboard/analytics" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/plantifeedpics/rounded.png') }}" alt="" height="20" width="20" />
                    </span>

                    <span class="logo-lg">
                        <div style="display: flex; justify-content: center;">
                            <img src="{{ asset('assets/images/plantifeedpics/cuai.png') }}" alt="" height="50" />
                        </div>

                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu"></div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <!-- <li class="menu-title"><span data-key="t-menu" style="color:white;"></span></li> -->
                        <br>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/dashboard/analytics" role="button" style="color:white">
                                <i class="ri-dashboard-2-line"></i>
                                <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>

                        @if(session('user') && session('user')->role_id == 1 || session('user') && session('user')->role_id == 2 || session('user') && session('user')->role_id == 3)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#UsersDropDown" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="UsersDropDown" style="color:white">
                                <i class="ri-account-circle-line"></i> <span>Users</span>
                            </a>
                            <div class="collapse menu-dropdown" id="UsersDropDown">
                                <ul class="nav nav-sm flex-column">
                                    @if(session('user') && session('user')->role_id == 1)
                                    <li class="nav-item">
                                        <a href="/users/admin" class="nav-link" style="color:white"> Admin </a>
                                    </li>
                                    @endif

                                    @if(session('user') && session('user')->role_id == 1 || session('user') && session('user')->role_id == 2)
                                    <li class="nav-item">
                                        <a href="/users/farm-leader" class="nav-link" style="color:white"> Farm Leaders </a>
                                    </li>
                                    @endif

                                    @if(session('user') && session('user')->role_id == 3 || session('user') && session('user')->role_id == 1 || session('user') && session('user')->role_id == 2)
                                    <li class="nav-item">
                                        <a href="/users/farmers" class="nav-link" style="color:white"> Farmers </a>
                                    </li>
                                    @endif

                                    @if(session('user') && session('user')->role_id == 1 || session('user') && session('user')->role_id == 2)
                                    <li class="nav-item">
                                        <a href="/users/archived" class="nav-link" style="color:white"> Restore Users </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @endif

                        <!-- @if(session('user') && session('user')->role_id == 1 || session('user') && session('user')->role_id == 2)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/Farms-District-5" role="button" style="color:white">
                                <i class="ri-home-4-line"></i>
                                <span data-key="t-dashboards">Farms</span>
                            </a>
                        </li>
                        @endif -->


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards" style="color:white">
                                <i class="ri-calendar-2-line"></i> <span>Calendar</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">

                                    <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarAccount" data-key="t-level-1.2" style="color:white">Planting Calendar</a>
                                    <div class="menu-dropdown collapse" id="sidebarAccount">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="/plantcalendar" class="nav-link" style="color:white">Planting Monitoring</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/calendar_list" class="nav-link" style="color:white">Planting List</a>
                                            </li>

                                        </ul>
                                    </div>



                                    <a href="#sidebarAccount1" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarAccount" data-key="t-level-1.2" style="color:white">Event Calendar</a>
                                    <div class="menu-dropdown collapse" id="sidebarAccount1">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="/schedules" class="nav-link" style="color:white"> Event Calendar </a>
                                            </li>

                                            @if(session('user') && session('user')->role_id == 1 || session('user') && session('user')->role_id == 2)
                                            <li class="nav-item">

                                                <a href="/attendance" class="nav-link" style="color:white">Event Registration</a>

                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="faq.html" role="button" style="color:white">
                                <i class="ri-question-line"></i>
                                <span data-key="t-faqs">FaQs</span>
                            </a>
                        </li> -->


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#weather" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards" style="color:white">
                                <i class="ri-sun-foggy-fill"></i> <span>Weather Monitoring</span>
                            </a>
                            <div class="collapse menu-dropdown" id="weather">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/weather" class="nav-link" style="color:white"> Weather Today </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/pastweather" class="nav-link" style="color:white"> Past Weather </a>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->


                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/weather" role="button">
                                <i class=" ri-sun-foggy-fill"></i>
                                <span data-key="t-faqs">Weather</span>
                            </a>
                            
                        </li> -->
                        @if(session('user') && (session('user')->role_id == 1 || session('user')->role_id == 2 || session('user')->role_id == 3))
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#inventoryDashboard" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="inventoryDashboard" style="color:white">
                                <i class="ri-archive-line"></i> <span>Inventory</span>
                            </a>
                            <div class="collapse menu-dropdown" id="inventoryDashboard">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/inventory/supplier" class="nav-link" style="color:white"> Supplier </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/inventory/stocks" class="nav-link" style="color:white"> Stocks </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="/inventory/uom" class="nav-link" style="color:white"> Unit of Measurements </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="/inventory/fertilizer" class="nav-link" style="color:white">Fertilizer</a>
                                    </li>-->
                                    <!-- <li class="nav-item">
                                        <a href="/inventory/tools" class="nav-link" style="color:white">Tools</a>
                                    </li> -->
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        @endif

                        @if(session('user') && session('user')->role_id == 3)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/Tools-District-5" role="button" style="color:white">
                                <i class="ri-tools-fill"></i>
                                <span data-key="t-dashboards">Tools and Seedlings Request</span>
                            </a>
                        </li>
                        @endif

                        @if(session('user') && session('user')->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/requests" role="button" style="color:white">
                                <i class="ri-tools-fill"></i>
                                <span data-key="t-dashboards">Tools and Seedlings Request</span>
                            </a>
                        </li>
                        @endif

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="task.html" role="button" style="color:white">
                                <i class="ri-task-line"></i>
                                <span data-key="t-task">Task</span>
                            </a>
                        </li> -->
                        <!-- @if( session('user') && session('user')->role_id == 3)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/expense" role="button" style="color:white">
                                <i class="ri-coins-line "></i>
                                <span data-key="t-dashboards">Expenses</span>
                            </a>
                        </li>
                        @endif -->

                        @if( session('user') && session('user')->role_id != 5)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/chat" role="button" style="color:white">
                                <i class="ri-wechat-line"></i>
                                <span data-key="t-faqs">Chat</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('tasks.monitoring') }}" role="button" style="color:white">
                                <i class="ri-task-line"></i>
                                <span data-key="t-faqs">Task</span>
                            </a>
                        </li>
                        @endif

                        @if(session('user') && (session('user')->role_id == 1 || session('user')->role_id == 2))
                        <li class="nav-item">

                            <a class="nav-link menu-link" href="#pimaintenance" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards" style="color:white">
                                <i class="ri-leaf-line"></i> <span>Crop Production Maintenance</span>

                            </a>
                            <div class="collapse menu-dropdown" id="pimaintenance">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/plant-info" class="nav-link" style="color:white"> Plant Information </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse menu-dropdown" id="pimaintenance">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/fertilizers" class="nav-link" style="color:white"> Fertilizer </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif


                        <li class="nav-item">

                            <a class="nav-link menu-link" href="#piuser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards" style="color:white">
                                <i class="ri-leaf-line"></i> <span>Crop Production</span>

                            </a>
                            <div class="collapse menu-dropdown" id="piuser">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/piu/piu" class="nav-link" style="color:white"> Plant Information </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse menu-dropdown" id="piuser">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/piu/fiu" class="nav-link" style="color:white"> Fertilizers </a>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/plantifeed" role="button" style="color:white">
                                <i class="ri-plant-line"></i>
                                <span data-key="t-faqs">Community Forum</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/analytics" role="button" style="color:white">
                                <i class="ri-wechat-line"></i>
                                <span data-key="t-faqs">Analytics</span>
                            </a>
                        </li> -->



                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#farmlocation" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards" style="color:white">
                                <i class="ri-map-pin-line"></i>
                                <span data-key="t-faqs">Farm Location</span>
                            </a>
                            <div class="collapse menu-dropdown" id="farmlocation">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/farm_locations" class="nav-link" style="color:white">Map </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/farm_list" class="nav-link" style="color:white">List </a>

                                    </li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </div>
                <!-- Sidebar -->
                <div class="sidebar-background" style="background-color:#57aa2c;"></div>
            </div>


        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <div class="main-content">


            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Center For Urban Agriculture and Innovation.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                CUAI
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-projects.init.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/header.js') }}"></script>

    <script src="{{ asset('assets/js/header.js') }}"></script>


    <!-- list.js min js -->
    <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>

    <!--list pagination js-->
    <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- ecommerce-order init js -->
    <script src="{{ asset('assets/js/pages/ecommerce-order.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
       
        function googleTranslateElementInit() {
            // Initialize Google Translate element
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,tl',
                autoDisplay: false, // Set autoDisplay to false
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');

            // Wait for the translate iframe to load
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                        // Check if the added node is the Google Translate iframe
                        var iframe = document.querySelector('.goog-te-banner-frame.skiptranslate');
                        if (iframe) {
                            // Hide the "Skip Translate" option
                            iframe.style.display = 'none';
                            // Disconnect the observer since we don't need to listen for changes anymore
                            observer.disconnect();
                        }
                    }
                });
            });

            // Observe changes in the document
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }

        $(document).ready(function() {
        // Function to mark notifications as read
        function markNotificationAsRead(notificationCount) {
            if (notificationCount !== '0') {
                $.get('/markAsRead');
            }
        }

        // Function to update badge color based on notification count
        function updateBadgeColor() {
            var notificationCount = $('#reload-section').text().trim();
            if (notificationCount !== '0') {
                $('#reload-section').addClass('bg-danger');
            } else {
                $('#reload-section').removeClass('bg-danger');
            }
        }

        // Click event handler for marking notifications as read
        $('#markasread').on('click', function() {
            $('#reload-section').load(location.href + ' #reload-section', function() {
                updateBadgeColor();
            });
        });

        // Call updateBadgeColor on document ready
        updateBadgeColor();

        // Scroll down to the bottom of the notification content
        $('#notificationItemsTabContent').scrollTop($('#notificationItemsTabContent')[0].scrollHeight);
    });
    </script>
    <script>


    </script>

    <div id="google_translate_element"></div>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>