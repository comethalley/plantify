@include('templates.header')

<head>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        .tab-content {
            max-height: 800px;
            /* Adjust the max-height as needed */
            overflow: hidden !important;
        }

        
    </style>
</head>

<div class="main-content" id="maincontent">
    <div class="page-content">
        <div class="container-fluid">
            
            <div class="position-relative mx-n4 mt-n4" >
                <div class="profile-wid-bg profile-setting-img">
                    <img src="@if($profileSettings && $profileSettings->cover_image) {{ asset('storage/images/' . $profileSettings->cover_image) }} @else {{ asset('https://velzon-svelte-saas.vercel.app/_app/immutable/assets/profile-bg.da0d9401.jpg') }} @endif" class="profile-wid-img" alt="Cover Image" >
                    <div class="overlay-content">
                        <form id="uploadCoverForm" method="POST" action="/upload-cover" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="text-end p-3">
                                <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                    <input id="profile-foreground-img-file-input" class="profile-foreground-img-file-input form-control" type="file" name="cover_image">
                                    <label class="profile-photo-edit btn btn-light form-label" for="profile-foreground-img-file-input">
                                        <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xxl-3">
                <div class="mt-n5 card">
                    <div class="p-4 card-body">
                        <div class="text-center">
                            <form id="uploadProfileImageForm" method="POST" action="/upload-cover" enctype="multipart/form-data">
                                @csrf
                                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                    @if($profileSettings?->profile_image)
                                    <img src="{{ asset('storage/images/' . $profileSettings->profile_image) }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="Profile Image">
                                    @else
                                    <div class="avatar-lg">
                                        <img style="padding:15px;" src="assets/images/plantifeedpics/profile-default.png" alt="user-img" class="img-thumbnail rounded-circle">
                                    </div>
                                    @endif
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" class="profile-img-file-input form-control" type="file" name="profile_image" style="display: none;">
                                        <label class="profile-photo-edit avatar-xs form-label" for="profile-img-file-input">
                                            <span class="avatar-title rounded-circle bg-light text-body"><i class="ri-camera-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </form>

                            <h5 class="fs-16 mb-1">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </h5>
                            <p class="text-muted mb-0">
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
                </div>
                <!-- <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Complete Your Profile</h5>
                                </div>
                                <div class="flex-shrink-0"><a class="badge bg-light text-primary fs-12"><i class="ri-edit-box-line align-bottom me-1"></i> Edit</a></div>
                            </div>
                            <div class="progress animated-progress custom-progress progress-label">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="label">30%</div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-xxl-9">
                <div class="mt-xxl-n5 card">
                    <div class="card-header">
                        <ul role="tablist" class="nav-tabs-custom rounded card-header-tabs border-bottom-0 nav">
                            <li class="nav-item"><a href="#" id="personalDetailsTab" class="nav-link">Personal Details</a></li>

                            <li class="nav-item">
                                <a href="#" class="nav-link" id="changePasswordTab">Change Password</a>
                            </li>

                        </ul>
                    </div>
                    <div class="p-4 card-body">
                        <div class="tab-content">
                           
                            <div class="tab-pane" id="personalDetailsForm">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mt-4">
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-top:13px; display: flex; align-items:flex-end; justify-content:flex-end;">
                                        <button style="background-color: green; transition: background-color 0.3s;" type="submit" class="btn btn-primary" onmouseover="this.style.backgroundColor='darkgreen'" onmouseout="this.style.backgroundColor='green'">Update Profile</button>
                                    </div>
                                </form>



                            </div>

                            <div class="tab-pane" id="changePasswordForm" style="display: none;">

                            <form method="POST" action="{{ route('profile.updatePassword') }}">
    @csrf

    <div class="form-group row" style="display:grid;">
        <div>
            <label for="old-password" class="col-md-4 col-form-label text-md-right">Old Password</label>

            <div class="col-md-6">
                <input id="old-password" type="password" class="form-control" name="old_password" required autocomplete="current-password">
            </div>
            @if ($errors->has('old_password'))
        <span class="text-danger">{{ $errors->first('old_password') }}</span>
        @endif
        </div>

        <div>
            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
            </div>
        </div>

        <div>
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                <!-- Error Message -->
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
    </div>

    <div style="display: flex; align-items:flex-end; justify-content:flex-end;">
        <button type="submit" class="btn btn-primary" style="background-color: green; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='darkgreen'" onmouseout="this.style.backgroundColor='green'">
            Update Password
        </button>
    </div>
</form>



                                <!-- <div class="mt-4 mb-3 border-bottom pb-2">
                                        <div class="float-end"><a class="link-primary">All Logout</a></div>
                                        <h5 class="card-title">Login History</h5>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18"><i class="ri-smartphone-line"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>iPhone 12 Pro</h6>
                                            <p class="text-muted mb-0">Los Angeles, United States - March 16 at 2:47PM</p>
                                        </div>
                                        <div><a>Logout</a></div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18"><i class="ri-tablet-line"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Apple iPad Pro</h6>
                                            <p class="text-muted mb-0">Washington, United States - November 06 at 10:43AM</p>
                                        </div>
                                        <div><a>Logout</a></div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18"><i class="ri-smartphone-line"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Galaxy S21 Ultra 5G</h6>
                                            <p class="text-muted mb-0">Conneticut, United States - June 12 at 3:24PM</p>
                                        </div>
                                        <div><a>Logout</a></div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18"><i class="ri-macbook-line"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Dell Inspiron 14</h6>
                                            <p class="text-muted mb-0">Phoenix, United States - July 26 at 8:10AM</p>
                                        </div>
                                        <div><a>Logout</a></div>
                                    </div> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="/save-profile-info">
                @csrf
            
                <div class="card">
                    <div class="card-body">
                        <!-- Other Infos -->
                        <h5 class="card-title mb-3">Other Infos</h5>
                        <!-- Facebook -->
                        <div class="row">
                        <!-- City -->
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3"><span class="avatar-title rounded-circle fs-16 bg-info"><i class="ri-building-fill"></i></span></div>
                                <input id="cityInput" class="form-control form-control" type="text" name="city" placeholder="City">
                            </div>
                            <!-- Age -->
                            <div class="col-md-6 mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3"><span class="avatar-title rounded-circle fs-16 bg-warning text-dark"><i class="ri-user-fill"></i></span></div>
                                <input id="ageInput" class="form-control form-control" type="number" name="age" placeholder="Age">
                            </div>
                            <!-- Sex -->
                            <div class="col-md-6 mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-white">
                                        <img src="assets/images/plantifeedpics/sexicon.png" alt="Sex Icon">
                                    </span>
                                </div>
                                <select id="sexSelect" class="form-select"  name="sex">
                                    <option selected disabled>Select Sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <!-- Bio -->
                            <div style="display: grid; grid-template-columns: 49px 1fr; ">
                                <img src="assets/images/plantifeedpics/bio.png" alt="bio" class="me-2" style=" margin:0 !important; width: 32px; height: 32px; ">
                                <textarea style="width:100%; resize:none; " id="bioTextarea" class="form-control" name="bio" placeholder="Bio"></textarea>
                            </div>
                        </div>

                            <!-- Submit button -->
                            <div style="display: flex; align-items:flex-end; justify-content:flex-end; margin-top:10px;">
                                <button type="submit" class="btn btn-primary" style="background-color: green; transition: background-color 0.3s; ;" onmouseover="this.style.backgroundColor='darkgreen'" onmouseout="this.style.backgroundColor='green'">Save</button>
                            </div>
                    </div>
                </div>
                

            </form>




            </div>
            
        </div>
    </div>




</div>


</div>




<script>
    $(document).ready(function() {
        // Show the change password form when the "Change Password" tab is clicked
        $('#changePasswordTab').on('click', function(e) {
            e.preventDefault();
            $('.tab-pane').removeClass('active');
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            $('#changePasswordForm').addClass('active').show();
        });

        // Show the personal details form when the "Personal Details" tab is clicked
        $('#personalDetailsTab').on('click', function(e) {
            e.preventDefault();
            $('.tab-pane').removeClass('active');
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            $('#personalDetailsForm').addClass('active').show();
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Show the Personal Details form when the "Personal Details" tab is clicked
        $('#personalDetailsTab').click(function() {
            $('#personalDetailsForm').show();
            $('#changePasswordForm').hide(); // Hide the Change Password form
        });

        // Show the Change Password form when the "Change Password" tab is clicked
        $('#changePasswordTab').click(function() {
            $('#changePasswordForm').show();
            $('#personalDetailsForm').hide(); // Hide the Personal Details form
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Hide the Change Password form by default
        $('#changePasswordForm').hide();

        // Show the Personal Details form by default
        $('#personalDetailsForm').show();

        // Show the Personal Details form when the "Personal Details" tab is clicked
        $('#personalDetailsTab').click(function() {
            $('#personalDetailsForm').show();
            $('#changePasswordForm').hide(); // Hide the Change Password form
        });

        // Show the Change Password form when the "Change Password" tab is clicked
        $('#changePasswordTab').click(function() {
            $('#changePasswordForm').show();
            $('#personalDetailsForm').hide(); // Hide the Personal Details form
        });
    });
</script>

<script>
    function uploadImage(type) {
        var formData = new FormData();
        var fileInput = document.getElementById(type === 'cover' ? 'profile-foreground-img-file-input' : 'profile-img-file-input');
        var file = fileInput.files[0];
        formData.append('user_id', '{{ auth()->id() }}');
        formData.append('image', file);
        formData.append('type', type); // Idagdag ang uri ng larawan (cover o profile)

        fetch('/upload-image', { // Baguhin ang endpoint na tinatawag
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Gagawin mo ang anumang mga kagustuhan mo dito, tulad ng pagpapakita ng mensahe ng tagumpay
                // Redirect back to the same page after successful upload
                window.location.href = window.location.href;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // I-bind ang function sa pagbabago ng file input para sa cover image
    document.getElementById('profile-foreground-img-file-input').addEventListener('change', () => uploadImage('cover'));

    // I-bind ang function sa pagbabago ng file input para sa profile image
    document.getElementById('profile-img-file-input').addEventListener('change', () => uploadImage('profile'));
</script>





@include('templates.footer')