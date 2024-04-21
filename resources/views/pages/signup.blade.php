<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign Up | Plantify</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/plants.png" class="img-fluid" />
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

</head>

<body>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">

                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="index.html" class="d-block"><br><br><br>
                                                <img src="assets/images/plantifeedpics/landing-page.png" alt="" class="img-fluid">

                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->


                            <div class="col-md-8 col-lg-6 col-xl-5">
                                <div class="card mt-4">

                                    <div class="card-body p-4">
                                        <div class="text-center mt-2">
                                            <h5 style="color: #57AA2C;">Create New Account</h5>

                                            <p class="text-muted"></p>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <form action="/register" method="POST">
                                                @csrf
                                                @error('email')
                                                <p class="text-red-500 text-xs p-1">{{$message}}</p>
                                                @enderror


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




                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-link text-white w-100" style="background-color: #57AA2C;" href="">Sign Up</a>

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
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>