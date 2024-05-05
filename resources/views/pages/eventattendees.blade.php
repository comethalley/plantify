@include('templates.header')
<style>
    /* Style for the table */
    #attendeesTable {
        width: 100%;
        border-collapse: collapse;
    }
    
    /* Style for table header */
    #attendeesTable th {
        background-color: #f2f2f2;
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }
    
    /* Style for table body */
    #attendeesTable td {
        border: 1px solid #dddddd;
        padding: 8px;
    }
    
    /* Alternate row color */
    #attendeesTable tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Responsive table */
    .table-responsive {
        overflow-x: auto;
    }
</style>
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
    <p style="font-size: 14px;"><strong>Date:</strong> {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</p>
    <p style="font-size: 14px;"><strong>Time:</strong> {{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</p>
    <p style="font-size: 14px;"><strong>Location:</strong> {{ $event->location }}</p>
    <p style="font-size: 14px;"><strong>Description:</strong>{{ $event->description }}</p>
</div>

                 
        </div>
                <hr>
                <div class="row mb-2">
    <div class="col-md-12 mb-2">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="search-box">
                    <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true" data-status="1">
                            Pre-Registered
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#registered" role="tab" aria-selected="false" data-status="2">
                            Registered
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-2">
                <button class="btn btn-primary btn-block" id="downloadBtn"><i class="fas fa-download mr-1"></i>Download</button>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <button class="btn btn-primary btn-block" id="update-status-btn">Saved</button>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <div class="col">
        <div class="row">

    <div class="tab-content text-muted">
        <div class="tab-pane fade show active" id="home" role="tabpanel">
            <div class="table-responsive">
                <table class="table" id="attendeesTable">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>Barangay</th>
                            <th>Status</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Pre-Registered table body goes here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="registered" role="tabpanel">
            <div class="table-responsive">
                <table class="table" id="attendeesTable">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>Barangay</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Registered table body goes here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var eventId = urlParams.get('id');
    if (eventId) {
        fetchAttendees(eventId, 1); // Fetch pre-registered attendees by default
    }

    function fetchAttendees(eventId, status) {
        $.ajax({
            url: '/fetch-attendees/' + eventId,
            method: 'GET',
            success: function(response) {
                $('#attendeesTable tbody').empty(); // Clear existing rows
                if (response.length > 0) {
                    response.forEach(function(attendee) {
                        if (attendee.status == status) {
                            $('#attendeesTable tbody').append('<tr><td>' + attendee.first_name + ' ' + attendee.last_name + '</td><td>' + attendee.email + '</td><td>' + attendee.barangay + '</td><td>' + attendee.status + '</td><td><input type="checkbox" class="attendee-checkbox" data-id="' + attendee.id + '"></td></tr>');

                        }
                    });
                } else {
                    $('#attendeesTable tbody').append('<tr><td colspan="4">No attendees found for this event ID.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching attendees:', error);
            }
        });
    }

    // Click event handler for the filter options
    $('.nav-link').click(function(e) {
        e.preventDefault();
        var status = $(this).data('status'); // Assuming data-status attribute is set in the HTML
        fetchAttendees(eventId, status);
    });
});

   


      document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search');
    const attendeesTable = document.getElementById('attendeesTable').getElementsByTagName('tbody')[0];

    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        filterAttendees(searchText);
    });

    function filterAttendees(searchText) {
        const rows = attendeesTable.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const name = row.cells[0].innerText.toLowerCase();
            const email = row.cells[1].innerText.toLowerCase();
            const barangay = row.cells[2].innerText.toLowerCase();
            const status = row.cells[3].innerText.toLowerCase();

            if (name.includes(searchText) || email.includes(searchText) || barangay.includes(searchText) || status.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const downloadBtn = document.getElementById('downloadBtn');

    downloadBtn.addEventListener('click', function() {
        downloadFile();
    });

    function downloadFile() {
        // Get the table element
        const table = document.getElementById('attendeesTable');

        // Get the table rows
        const rows = table.querySelectorAll('tbody tr');

        // Initialize data array with header row
        const data = [['Name', 'Email', 'Barangay', 'Status']];

        // Loop through each row and extract cell data
        rows.forEach(row => {
            const rowData = [];
            // Get cell data for each row
            row.querySelectorAll('td').forEach(cell => {
                rowData.push(cell.textContent.trim());
            });
            // Add row data to data array
            data.push(rowData);
        });

        // Create a new workbook
        const workbook = XLSX.utils.book_new();

        // Convert data array to worksheet
        const worksheet = XLSX.utils.aoa_to_sheet(data);

        // Add the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Attendees');

        // Generate Excel file
        const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

        // Convert Excel buffer to Blob
        const blob = new Blob([excelBuffer], { type: 'application/octet-stream' });

        // Create a download link
        const url = URL.createObjectURL(blob);

        // Create a link element and trigger the download
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'Attendees.xlsx'); // Set the filename
        document.body.appendChild(link);
        link.click();

        // Clean up
        URL.revokeObjectURL(url);
        document.body.removeChild(link);
    }
});



</script>
<script>
    $(document).ready(function() {
        $('#update-status-btn').click(function() {
            // Loop through each selected checkbox
            $('.attendee-checkbox:checked').each(function() {
                var attendeeId = $(this).data('id');
                // Perform an AJAX request to update the status
                $.ajax({
                    url: '{{ route("update-attendee-status") }}',
                    type: 'POST',
                    data: {
                        attendeeId: attendeeId
                    },
                    success: function(response) {
                        // Update the status in the table
                        $('.attendee-checkbox[data-id="' + attendeeId + '"]').closest('tr').find('td:last').text('Status 2');
                    },
                    error: function() {
                        alert('Error updating status.');
                    }
                });
            });
        });
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

 <!-- JAVASCRIPT -->
 <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>


@include('templates.footer')