<!DOCTYPE html>
<html lang="en">


<meta charset="utf-8" />
<title>Forgot Password | PlantiCUAI</title>
<link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/rounded.png" class="img-fluid" />
<head>

    <meta charset="utf-8" />
    <title>Sign Up | Velzon - Admin & Dashboard Template</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </script>
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
            display: grid;
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




<body data-bs-spy="scroll" data-bs-target="#navbar-example">

<div class="auth-one-bg-position auth-one-bg" id="auth-particles">
<!-- <div class="bg-overlay"></div> -->
        <canvas class="particles-js-canvas-el" width="100%" height="100%" style="width: 100%; height: 100%;"></canvas></div>
        
        <!-- auth-page content -->

       
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                  
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0">

                            
                            <div class="col-lg-6">

                                <div class="container-fluid">
                                    <a href="login" class="btn btn-success waves-effect waves-light mt-2" style="background-color: darkgreen; border-color: darkgreen;">
                                        <i class="ri-arrow-left-line" style="color: white;"></i>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img src="assets/images/plantifeedpics/landing-page.png" alt="" class="img-fluid">
                                </div>

                            </div>



                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        @if ($errors->any())
                                        <div class="alert alert-danger text-center">

                                            @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                            @endforeach

                                        </div>
                                        @endif

                                        @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                        @endif

                                        <div>
                                        <h5 class="text-black">Forgot Password?</h5>
                                            <div class="mt-2 text-center">
                                            <lord-icon
                                                src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary: #066903" class="avatar-xl">
                                            </lord-icon>
                                        </div>
                                            <div class="alert border-0 alert-warning text-center mb-0 mx-0" role="alert">
                                            Enter your email and instructions will be sent to you!
                                        </div>
                                           

                                        </div><br>
                                        <form action="/forgot-password" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="useremail" placeholder="Enter email address" required name="email">
                                                <div class="invalid-feedback">
                                                    Please enter email
                                                </div>
                                                <br>



                                                <button type="submit" class="btn btn-success w-100" id="sendResetLinkButton" style="background-color:#066903;">
                                                    <i class=""></i> Send Reset Link
                                                </button>

                                            </div>
                                        </form>

                                        <!-- <div class="mt-1 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="/signup" class="fw-semibold text-decoration-underline" style="color:#066903;"> SignUp</a> </p>
                                        </div> -->

                                    </div>

                                </div>
                            </div>
                        </div>
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
</div>
  
 
        <!-- end Footer -->

<script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
</body>

</html>

