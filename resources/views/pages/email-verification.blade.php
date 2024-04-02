<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-bs-theme="light" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default">

<head>

    <meta charset="utf-8">
    <title>Two Step Verification | Plantify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin &amp; Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css">
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .bg-image {
            background-image: url('{{ asset("assets/images/plantifeedpics/feedcover.png") }}');
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="bg-image p-lg-5 p-4 h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <img src="{{ asset('assets/images/p-white.png') }}" alt="" height="50">
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-white"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide pointer-event" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15">" In the concrete jungle, seeds of change grow where pavement meets soil. Urban farming is the revolution beneath our feet. "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15">" Cities thrive when rooftops become gardens and alleyways transform into orchards. Urban farming is the heartbeat of sustainable living."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15">" From abandoned lots to bustling farmer's markets, urban farming proves that every corner of the city holds potential for growth and nourishment. "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div class="mb-4">
                                            <div class="avatar-lg mx-auto">
                                                <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                                    <i class="ri-mail-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted text-center mx-lg-3">
                                            <h4 class="">Verify Your Email</h4>
                                            <p>Please enter the 4 digit code sent to <span class="fw-semibold">{{ $user->email }}</span></p>

                                        </div>

                                        <div class="mt-4">
                                            <form autocomplete="off">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                            <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(1, event)" maxlength="1" id="digit1-input">
                                                        </div>
                                                    </div><!-- end col -->

                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                            <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(2, event)" maxlength="1" id="digit2-input">
                                                        </div>
                                                    </div><!-- end col -->

                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                            <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(3, event)" maxlength="1" id="digit3-input">
                                                        </div>
                                                    </div><!-- end col -->

                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                            <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(4, event)" maxlength="1" id="digit4-input">
                                                        </div>
                                                    </div><!-- end col -->
                                                </div>

                                                <div class="mt-3">
                                                    <button type="button" class="btn btn-success w-100" id="confirm">Confirm</button>
                                                </div>

                                            </form>

                                        </div>

                                        <div class="mt-5 text-center">
                                            <p>The code is valid for 5 minutes. Do not share this code with anyone for security reasons </p>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0" id="resend-code">Didn't receive a code ? <a href="#" class="fw-semibold text-primary text-decoration-underline" id="resendCode">Resend</a> </p>
                                            <p class="mb-0" id="available">Resend Code is Available in <span id="time-left"></span> </p>
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

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="text-center">
                            
                        </div> -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript" src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script type="text/javascript" src="assets/libs/flatpickr/flatpickr.min.js"></script>


    <!-- two-step-verification js -->
    <script src="assets/js/pages/two-step-verification.init.js"></script>

    <script>
        $(document).ready(function() {
            // Function to update the countdown timer
            function updateCountdown() {
                // Get the current time and target time
                var currentTime = Date.now();
                var targetTime = localStorage.getItem('timerStartTime') ? parseInt(localStorage.getItem('timerStartTime')) + 300000 : currentTime;

                // Calculate remaining time in milliseconds
                var remainingTime = Math.max(targetTime - currentTime, 0);

                // Convert remaining time to minutes and seconds
                var minutes = Math.floor(remainingTime / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                // Update the display
                if (remainingTime > 0) {
                    $("#available").show();
                    $("#time-left").text(minutes + "m " + seconds + "s");
                } else {
                    // Hide the countdown when time reaches zero
                    $("#available").hide();
                    $("#resend-code").show();
                }

                // If there's still time remaining, update the timer again after 1 second
                if (remainingTime > 0) {
                    setTimeout(updateCountdown, 1000);
                }
            }

            // Initial call to update the countdown
            updateCountdown();
        });
        $(document).ready(function() {
            var timerStartTime = localStorage.getItem('timerStartTime');
            var currentTime = Date.now();

            if (!timerStartTime || currentTime - timerStartTime > 300000) {

                localStorage.setItem('timerStartTime', currentTime);
                timerStartTime = currentTime;
            }


            var elapsedTime = currentTime - timerStartTime;
            var remainingTime = 300000 - elapsedTime;


            remainingTime = Math.max(remainingTime, 0);


            setTimeout(sendAjaxRequest, remainingTime);
        });

        function sendAjaxRequest() {
            $.ajax({
                url: "/empty-code/{{ $user->id }}",
                method: "GET",
                success: function(data) {
                    console.log(data);

                    //localStorage.setItem('timerStartTime', Date.now());
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });
        }

        function resetLocalStorage() {
            localStorage.removeItem('timerStartTime');
        }

        $(document).ready(function() {
            $("#resendCode").click(function() {
                resetLocalStorage()
                $.ajax({
                    url: "/resend-code/{{ $user->id }}",
                    method: "get",
                    success: function(data) {
                        console.log(data)
                        $("#resend-code").hide();
                        $("#available").show();
                        localStorage.setItem('timerStartTime', Date.now());
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#confirm").click(function() {
                var digit1 = $("#digit1-input").val()
                var digit2 = $("#digit2-input").val()
                var digit3 = $("#digit3-input").val()
                var digit4 = $("#digit4-input").val()
                $.ajax({
                    url: "/confirm-code/{{ $user->id }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'digit1': digit1,
                        'digit2': digit2,
                        'digit3': digit3,
                        'digit4': digit4,
                    },
                    success: function(data) {

                        var response = JSON.parse(JSON.stringify(data));
                        console.log(response)
                        alert(response.message)
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                    }
                });
            });
        });
    </script>

</body>

</html>