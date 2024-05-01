<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign Up | PlantiCUAI</title>
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
            background: darkgreen; */
            Prevent scrollbars
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
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        } 
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

<div class="auth-one-bg-position auth-one-bg" id="auth-particles">
<!-- <div class="bg-overlay"></div> -->
        <canvas class="particles-js-canvas-el" width="100%" height="100%" style="width: 100%; height: 100%;"></canvas></div>
        
    <div class="auth-page-content d-flex justify-content-center">
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-4 auth-one-bg h-100">
                            <div class="position-relative h-100 d-flex flex-column">

                                <a href="/" class="d-block"><br><br><br>
                                    <img src="assets/images/plantifeedpics/landing-page.png" alt="" class="img-fluid">
                                </a>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-md-5 col-lg-5 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <br><br>
                                    <h5 style="color: #066903;">Create new Account</h5>

                                    <p class="text-muted"></p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="/register" method="POST">
                                        @csrf
                                        <!-- Display errors for firstname -->
                                        @if ($errors->has('firstname'))
                                        <p class="text-danger">{{ $errors->first('firstname') }}</p>
                                        @endif

                                        <!-- Display errors for lastname -->
                                        @if ($errors->has('lastname'))
                                        <p class="text-danger">{{ $errors->first('lastname') }}</p>
                                        @endif

                                        <!-- Display errors for email -->
                                        @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif

                                        <!-- Display errors for password -->
                                        <!-- @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                        @endif -->



                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Firstname <span class="text-danger">*</span></label>
                                            <input type="firstname" class="form-control" name="firstname" id="firstname" placeholder="Enter firstname" required>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Lastname <span class="text-danger">*</span></label>
                                            <input type="lastname" class="form-control" name="lastname" id="lastname" placeholder="Enter lastname" required>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>



                                        <div class="mb-3">
                                            <label for="usermail" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="usermail" class="form-control" name="email" id="usermail" placeholder="Enter email address" required>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" required name="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Confirm Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" required name="password_confirmation">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                         <div id="password-contain" class="p-3 bg-light mb-2 rounded" style="display: none;">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-link text-white w-100" style="background-color:#066903;" href="">Sign Up for Public user</a>
                                        </div>
                                        <div class="mt-1 text-center">
                                            <p class="mb-0">Already have an account ? <a href="/login" class="fw-semibold text-decoration-underline" style="color:#066903;"> Sign In</a> </p>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->




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
    </div>
    <!-- end container -->
    </div>
    <!-- end auth page content -->


    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- validation init -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="assets/js/pages/passowrd-create.init.js"></script>
</body>

</html>