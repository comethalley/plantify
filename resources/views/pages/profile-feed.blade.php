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
                <div class="  flex-column profile-foreground position-relative mx-n4 mt-n4 d-flex justify-content-center align-items-center" style="height: 250px; overflow: hidden;">
                    @if($profileSettings && $profileSettings->cover_image)
                    <img src="{{ asset('storage/images/' . $profileSettings->cover_image) }}" alt="Cover Image" class="profile-wid-img" style="width: 100%; height: auto;">
                    @else
                    <img src="{{ asset('assets/images/plantifeedpics/nocover.png') }}" alt="Default Cover Image" class="profile-wid-img" style="width: 80px; height: 80px ">
                    <p class="mt-3" style="color: grey; font-size:15px;">No cover available</p>
                    @endif
                </div>


                <div class="pt-4 mb-4 mb-lg-1 pb-1">
                    <div style="background-color:white; margin-top:2px; padding:15px;" class="g-4 row">
                        <div style="
    margin-top: 0px;
    padding-top: 7px;
" class="col-auto">
                            @if($profileSettings->profile_image)
                            <img src="{{ asset('storage/images/' . $profileSettings->profile_image) }}" alt="Profile Image" class="rounded-circle avatar-xl img-thumbnail user-profile-image">
                            @else
                            <div class="avatar-lg">
                                <img style="padding: 2px; border: 3px solid #006400;" src="assets/images/plantifeedpics/profile-default.png" alt="user-img" class="img-thumbnail rounded-circle">
                            </div>

                            @endif
                        </div>


                        <div class="col" style="
    margin-top: 10px;
">
                            <div class="p-2">
                                <h3 class="text-black mb-1">
                                    @if (Auth::check())
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                    @endif
                                </h3>
                                <p class="text-black text-opacity-75">
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

                                <div class="d-flex justify-content-between">

<div class="flex-shrink-0 ms-auto">
    <a class="btn btn-success " href="{{ route('profilesettings') }}" style="background-color: #006400;" onmouseover="this.style.backgroundColor='darkgreen'" onmouseout="this.style.backgroundColor='green'">
        <i class="ri-edit-box-line align-bottom"></i> Edit Profile
    </a>
</div>
</div>

                            </div>
                        </div>

                        
                    </div>
                </div>

            </div>
            <div class="tab-content pt-3 text-muted">
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
                                <div style="padding:10px; border-radius:4px; " class="row bg-white">
                                    <div style="padding:10px;" class="col-lg-12">
                                        <div>
                                            

                                        </div>
                                    </div>

                                    <div class="card-body" style="display: flex; justify-content: space-between; font-size: 14x;">
                                        <div style="flex: 1;">
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
                                                            <td class="text-muted">{{ $profileSettingsOther->age ?? 'None' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Sex :</th>
                                                            <td class="text-muted">
                                                                {{ optional($profileSettingsOther)->sex ? ucfirst($profileSettingsOther->sex) : 'None' }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th class="ps-0" scope="row">City :</th>
                                                            <td class="text-muted">{{ $profileSettingsOther->city ?? 'None' }}</td>
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
                                        <div style="flex: 1; margin-left: 20px;">
                                            <h5 class="card-title mb-3" data-svelte-h="svelte-atvroz">My Bio</h5>
                                            <td class="text-muted">{{ $profileSettingsOther->bio ?? 'No Bio' }}</td>
                                        </div>
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