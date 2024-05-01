@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Event Attendees</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Event Attendees</a></li>

                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
    <div class="col-lg-12">
        <div class="card" id="eventDetails">
            <div class="card-header border-0">
                <div class="row align-items-center gy-3">
                    <div class="col-sm">
                        <h5 class="card-title mb-0">Event Details</h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="/attendance" class="btn btn-primary bg-gradient waves-effect waves-light"><i class=" ri-arrow-left-line"></i> Back to Attendance</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <div class="row">
                <div class="text-end">
    <button class="btn btn-primary invite-btn" data-link="{{ route('event.attendance.form', ['id' => $event->id]) }}">Invite</button>
</div>
                    <div class="col-md-4">
                        <img src="../assests/images/event/{{$event->image}}" alt="Event Image" class="img-fluid">
                    </div>
                   
                    <div class="col-md-8" style="font-size: 16px;">
                        <h3>{{ $event->title }}</h3>
                        <p><strong>Date:</strong> {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</p>
                        <p><strong>Time:</strong> {{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Description:</strong>{{ $event->description }}</p>
                    </div>
                 
        </div>
                <hr>
               
<div class="dropdown text-right">
    <div class="d-flex justify-content-end mb-2">
        <div class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button class="btn  me-2" type="button" id="filterDropdown">
                Filter
            </button>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" onclick="filterAttendees('all')">All</a>
            <a class="dropdown-item" href="#" onclick="filterAttendees('registered')">Registered</a>
            <a class="dropdown-item" href="#" onclick="filterAttendees('pre-registered')">Pre-registered</a>
        </div>
        <button type="button" class="btn btn-primary download-btn"><i class="ri-download-2-line"></i> Download</button>
    </div>
</div>


<h5>Attendance List</h5>
<table class="table" id="attendance-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>johndoe@example.com</td>
            <td><input type="checkbox" data-status="present" checked></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>janesmith@example.com</td>
            <td><input type="checkbox" data-status="absent"></td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>




            </div>
        </div>
    </div>
</div>

            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelector('.dropdown').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the dropdown from closing when clicking inside it
        document.getElementById('dropdownMenuButton').click(); // Manually toggle the dropdown
    });
</script>

<!-- Bootstrap JS (including Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.invite-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var link = this.getAttribute('data-link');
                navigator.clipboard.writeText(link).then(function() {
                    alert('Link copied to clipboard: ' + link);
                }).catch(function() {
                    alert('Failed to copy link to clipboard.');
                });
            });
        });
    });
</script>
<script>
    function filterAttendees(status) {
        const rows = document.querySelectorAll("#attendance-table tbody tr");
        rows.forEach(row => {
            const rowStatus = row.querySelector("td[data-status]").getAttribute("data-status");
            if (status === "all" || rowStatus === status) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }
    function redirectToAttendanceForm(event) {
        event.preventDefault(); // Prevent the default action (e.g., following the link)

        var link = event.target.dataset.link; // Get the data-link attribute value
        window.location.href = link;
    }
</script>

@include('templates.footer')