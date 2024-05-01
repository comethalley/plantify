@include('templates.header')


<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .tab-pane.active {
            overflow: hidden !important;

        }

        .tab-content {
            overflow-y: auto;
            /* Enable vertical scrolling within the tab content */
            max-height: 800px;

            /* Adjust the max-height as needed */
        }

        .avatar-xs:hover {
            transform: scale(1.2);
            /* Increase the size of the avatar on hover */
        }

        .avatar-xs {
            transition: transform 0.3s ease;
            /* Add transition for smooth scaling */
        }
    </style>

</head>

<body>


    <div class="main-content" id="maincontent">
        <div class="page-content">
            <div class="container-fluid">
                <div class="profile-foreground position-relative mx-n4 mt-n4">
                    <div class="profile-wid-bg">
                        @if($profileSettings && $profileSettings->profile_image)
                        <img src="{{ asset('storage/images/' . $profileSettings->profile_image) }}" alt="Profile Image" class="profile-wid-img">
                        @else
                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Profile Image" class="profile-wid-img">
                        @endif
                    </div>
                </div>

                <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                    <div class="g-4 row">
                        <div class="col-auto">
                            @if($profileSettings->profile_image)
                            <img src="{{ asset('storage/images/' . $profileSettings->profile_image) }}" alt="Profile Image" class="rounded-circle avatar-xl img-thumbnail user-profile-image">
                            @else
                            <div class="avatar-lg">
                                <img style="padding:15px;" src="assets/images/plantifeedpics/profile-default.png" alt="user-img" class="img-thumbnail rounded-circle">
                            </div>
                            @endif
                        </div>


                        <div class="col">
                            <div class="p-2">
                                <h3 class="text-white mb-1">
                                    @if (Auth::check())
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                    @endif
                                </h3>
                                <p class="text-white text-opacity-75">
                                    @if (Auth::check())
                                    @if (Auth::user()->role_id == 1)
                                    Super Admin
                                    @elseif (Auth::user()->role_id == 2)
                                    Admin
                                    @elseif (Auth::user()->role_id == 3)
                                    Farm Leader
                                    @elseif (Auth::user()->role_id == 4)
                                    Farmer
                                    @elseif (Auth::user()->role_id == 5)
                                    User
                                    @endif
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- <div class="col-12 col-lg-auto order-last order-lg-0">
                            <div class="row text text-white-50 text-center">
                                <div class="col-lg-6 col-4">
                                    <div class="p-2">
                                        <h4 class="text-white mb-1">24.3K</h4>
                                        <p class="fs-14 mb-0">Followers</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-4">
                                    <div class="p-2">
                                        <h4 class="text-white mb-1">1.3K</h4>
                                        <p class="fs-14 mb-0">Following</p>
                                    </div>


                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="d-flex">
                                <ul class="animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1 nav nav-pills">
                                    <li class="nav-item"><a href="#" class="fs-14 nav-link active"><i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span></a></li>
                                    <!-- <li class="nav-item"><a href="#" class="fs-14 nav-link"><i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Activities</span></a></li>
                                    <li class="nav-item"><a href="#" class="fs-14 nav-link"><i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Projects</span></a></li>
                                    <li class="nav-item"><a href="#" class="fs-14 nav-link"><i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Documents</span></a></li> -->
                                </ul>
                                <div class="flex-shrink-0"><a class="btn btn-success" href="{{ route('profilesettings') }}"><i class="ri-edit-box-line align-bottom"></i> Edit
                                        Profile</a></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content pt-4 text-muted">
                <!-- <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#" class="nav-link"> </a></li>
                    <li class="nav-item"><a href="#" class="nav-link"> </a></li>
                    <li class="nav-item"><a href="#" class="nav-link"> </a></li>
                    <li class="nav-item"><a href="#" class="nav-link"> </a></li>
                </ul> -->
                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                    <div class="row">
                        <div class="col-xxl-3">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-5" data-svelte-h="svelte-1aky7av">Complete Your Profile</h5>
                                    <div class="progress animated-progress custom-progress progress-label" data-svelte-h="svelte-157tnr">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 30%">
                                            <div class="label">30%</div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3" data-svelte-h="svelte-1hac74q">Info</h5>
                                    <div class="table-responsive" data-svelte-h="svelte-1pojm4x">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Full Name :</th>
                                                    <td class="text-muted"> @if (Auth::check())
                                                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="ps-0" scope="row">Email :</th>
                                                    <td class="text-muted"> @if (Auth::check())
                                                        {{ Auth::user()->email }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Age :</th>
                                                    <td class="text-muted">{{ $profileSettings->age ?? 'None' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Sex :</th>
                                                    <td class="text-muted">
                                                        @if($profileSettings->sex)
                                                        {{ ucfirst($profileSettings->sex) }}
                                                        @else
                                                        None
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="ps-0" scope="row">City :</th>
                                                    <td class="text-muted">{{ $profileSettings->city ?? 'None' }}</td>
                                                </tr>

                                                <tr>
                                                    <th class="ps-0" scope="row">Joining Date :</th>
                                                    <td class="text-muted"> @if (Auth::check())
                                                        {{ \Carbon\Carbon::parse(Auth::user()->created_at)->toDateString() }}
                                                        @endif
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4" data-svelte-h="svelte-lh5a3">Social Media Accounts</h5>
                                    <!-- Facebook -->

                                    <div class="mb-3 d-flex gap-2">
                                        <!-- Facebook -->
                                        <div>
                                            @if($profileSettings->facebook)
                                            <a href="{{ $profileSettings->facebook }}" class="avatar-xs d-block">
                                                <span class="avatar-title rounded-circle fs-16 bg-dark text-light" data-svelte-h="svelte-av7thz">
                                                    <i class="ri-facebook-fill"></i> <!-- Assuming Facebook icon -->
                                                </span>
                                            </a>
                                            @else
                                            <span class="avatar-xs d-block">
                                                <span class="avatar-title rounded-circle fs-16 bg-dark text-light" data-svelte-h="svelte-av7thz">
                                                    <i class="ri-facebook-fill"></i> <!-- Assuming Facebook icon -->
                                                </span>
                                            </span>
                                            @endif
                                        </div>

                                        <!-- Twitter -->
                                        <div>
                                            @if($profileSettings->twitter)
                                            <a href="{{ $profileSettings->twitter }}" class="avatar-xs d-block">
                                                <span class="avatar-title rounded-circle fs-16 bg-primary" data-svelte-h="svelte-13ylivj">
                                                    <i class="ri-twitter-fill"></i> <!-- Assuming Twitter icon -->
                                                </span>
                                            </a>
                                            @else
                                            <span class="avatar-xs d-block">
                                                <span class="avatar-title rounded-circle fs-16 bg-primary" data-svelte-h="svelte-13ylivj">
                                                    <i class="ri-twitter-fill"></i> <!-- Assuming Twitter icon -->
                                                </span>
                                            </span>
                                            @endif
                                        </div>

                                        <!-- Instagram -->
                                        <div>
                                            @if($profileSettings->instagram)
                                            <a href="{{ $profileSettings->instagram }}" class="avatar-xs d-block">
                                                <span class="avatar-title rounded-circle fs-16 bg-success" data-svelte-h="svelte-1wzau7r">
                                                    <i class="ri-instagram-fill"></i> <!-- Assuming Instagram icon -->
                                                </span>
                                            </a>
                                            @else
                                            <span class="avatar-xs d-block">
                                                <span class="avatar-title rounded-circle fs-16 bg-success" data-svelte-h="svelte-1wzau7r">
                                                    <i class="ri-instagram-fill"></i> <!-- Assuming Instagram icon -->
                                                </span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3" data-svelte-h="svelte-atvroz">My Bio</h5>
                                    <td class="text-muted">{{ $profileSettings->bio ?? 'No Bio' }}</td>

                                    <!-- <div>
                                        <h2>Cover Image:</h2>
                                        @if($profileSettings->cover_image)
                                        <img src="{{ asset('storage/images/' . $profileSettings->cover_image) }}" alt="Cover Image">
                                        @else
                                        <p>No cover image available.</p>
                                        @endif
                                    </div> -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>


@include('templates.footer')