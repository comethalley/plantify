<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Pre-Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;

        }

    
        .custom-title {
        font-family: Arial, sans-serif; /* Custom font family */
        font-weight: bold; /* Make the title bold */
    }

    body {
            background-color: #9ACD32; /* Yellow-green background color */
        }
        .custom-title {
            font-family: Arial, sans-serif; /* Custom font family */
            font-weight: bold; /* Make the title bold */
        }

</style>
    </style>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #c8c8cd;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
           
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            max-height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            padding: 8px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        hr {
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>

    
</head>

<body>


 <div class="row">
    <div class="col-xl-12">
        <div class="card card-lg">
            <div class="card-header align-items-center d-flex" style="background-color:#25A90B;">
                <h1 class="card-title text-center text-justify custom-title" style="font-size: 1rem; color: white;"><strong>Fill Up Form</strong></h1><br>      
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md"></div>       
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="card-title-container justify-text-center">
                    <h1 class="card-title text-center text-justify custom-title" style="font-size: 1.3rem; margin-bottom: 15px;"><strong>Pre-Registration Form</strong></h1>
                    <h5 class="card-title text-center mb-2 "><strong>Event Name: {{ $event->title }}</strong></h5>
                    <p class="card-text text-center mb-2 "><strong>Date: {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</strong> </p>
                    <p class="card-text text-center" style="border-bottom: 1px solid #000;"><strong>{{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</strong></p>
                    <hr>
         
                    <form action="{{ route('register', ['event_id' => $event->id]) }}" method="POST">
                        @csrf
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="middleInitial" class="form-label">M.I</label>
                                                <input type="text" class="form-control" id="middleInitial" name="middle_initial" placeholder="M.I">
                                            </div>
                                        </div>
                                    </div><!-- end row -->
                                </div><!-- end col -->
                            </div><!-- end row -->
                                                                            
                            <!--end col-->
                            <div class="row gy-4">
                                <div class="col">
                                    <div>
                                        <label for="iconInput" class="form-label">Email Address</label>
                                        <div class="form-icon">
                                            <input type="email" class="form-control form-control-icon" id="iconInput" name="email" placeholder="example@gmail.com">
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="placeholderInput" name="contact" placeholder="09*********">
                                    </div>
                                </div>
                            </div>
                                          
                            <!--end col-->
                            <div class="row gy-4">
                                <div class="col">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="placeholderInput" name="age" placeholder="18">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!--end col-->
                                <div class="row gy-4">
                                    <div class="col">
                                        <div>
                                            <label for="placeholderInput" class="form-label">Complete Address</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="address" placeholder="Complete address">
                                        </div>
                                    </div>
                                </div><!--end row-->
                                <div class="row gy-4">
                                    <div class="col">
                                    <label for="barangay" class="form-label">Barangay:</label>
                                        <select class="form-select" id="barangay" name="barangay" required>
                                            <option value="" disabled selected>Select your barangay</option>
                                            <option value="Barangay 1">Barangay 1</option>
                                            <option value="Barangay 2">Barangay 2</option>
                                            <option value="Barangay 3">Barangay 3</option>
                                            
                                        </select>
                                    </div>
                                </div><!--end row-->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap JS (optional) -->
  





</body>

</html>
