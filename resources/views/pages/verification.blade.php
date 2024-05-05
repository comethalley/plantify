<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Verification | Plantify</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/rounded.png" class="img-fluid" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <style>
        body,
        html {
            height: 100%;
            background: #066903;
            /* Prevent scrollbars */
        }

        .container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-one-bg-position {
            /* position: fixed; */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <!-- <div class="bg-overlay"></div> -->
        <canvas class="particles-js-canvas-el" width="100%" height="100%" style="width: 100%; height: 100%;"></canvas>
    </div>

    <div class="auth-page-content d-flex justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mx-auto">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div class="mb-4">
                                        <a href="/" class="d-block">
                                            <img src="assets/images/plantifeedpics/landing-page.png" alt="" class="img-fluid">

                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <div class="card-body p-1">
                                            <h5 class="text-center" style="color:#066903;">Email Confirmation</h5>
                                            <p class="text-muted text-center">We send a verification code to {{$farmLeaders->email}} to verify your account.</p>
                                        </div><br>

                                        <div class="mt-4">
                                            <form id="verification-form" action="/verification-confirm/{{$farmLeaders->id}}" method="POST">
                                                @csrf
                                                @if ($errors->any())
                                                <div class="alert alert-danger text-center">

                                                    @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                    @endforeach

                                                </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Enter Verification Code</label>
                                                    <input type="text" class="form-control" id="username" name="email" placeholder="Enter Verification Code">
                                                </div>



                                                <div class="mt-5">

                                                    <button type="submit" class="btn btn-link text-white w-100" style="background-color:#066903;" href="">Confirm</a>
                                                </div>

                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>

                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


    </div>
    <!-- end row -->
    </div>
    <!-- end container -->
    </div>




    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>

    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#verification-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data
                var url = $(this).attr('action'); // Get form action URL

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle successful response, if needed
                        var response = JSON.parse(JSON.stringify(response));
                        console.log(response)
                        alert(response.message)
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>