<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Attendance Form</title>
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
    <style>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
<div class="container">
    <div class="card">
        <img src="../assets/images/event/{{ $event->image }}" class="card-img-top" alt="Event Image">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Event Attendance Form - {{ $event->title }}</h5>
            <p class="card-text text-center"><strong>Date:</strong> {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</p>
            <p class="card-text text-center"><strong>Time:</strong> {{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</p>
            <hr>
            <form action="{{ route('event.attendance.submit', ['event_id' => $event->id]) }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="barangay" class="form-label">Barangay</label>
                    <input type="text" class="form-control" id="barangay" name="barangay" required>
                </div>
                <!-- Add more fields as needed -->
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
        <img src="../assets/images/event/{{ $event->image }}" class="card-img-top" alt="Event Image">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"></h4>

            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted">Example of vertical form using <code>form-control</code> class. No need to specify row and col class to create vertical form.</p>
                <div class="live-preview">
                    <form action="javascript:void(0);" class="limited-width-form">
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="employeeName" placeholder="Enter employee name">
                        </div>
                        <div class="mb-3">
                            <label for="employeeUrl" class="form-label">Employee Department URL</label>
                            <input type="url" class="form-control" id="employeeUrl" placeholder="Enter employee url">
                        </div>
                        <div class="mb-3">
                            <label for="StartleaveDate" class="form-label">Start Leave Date</label>
                            <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate">
                        </div>
                        <div class="mb-3">
                            <label for="EndleaveDate" class="form-label">End Leave Date</label>
                            <input type="date" class="form-control" data-provider="flatpickr" id="EndleaveDate">
                        </div>
                        <div class="mb-3">
                            <label for="VertimeassageInput" class="form-label">Message</label>
                            <textarea class="form-control" id="VertimeassageInput" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Add Leave</button>
                        </div>
                    </form>
                </div>
                <div class="d-none code-view">
                    <pre class="language-markup" style="height: 375px;">
                    <!-- Your code for the form goes here -->
                    </pre>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
>

</body>

</html>
