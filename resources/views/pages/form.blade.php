<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Attendance Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <img src="https://via.placeholder.com/600x200" class="card-img-top" alt="Event Image">
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
                        <label for="contact" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="Email" required>
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
</body>

</html>
