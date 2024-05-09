@include('templates.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <a href="/attendance" class="btn btn-primary bg-gradient waves-effect waves-light"><i class=" ri-arrow-left-line"></i> Back to Event List</a>
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
        </div>
    </div>
</div>





<div class="row">
    <div class="col">
    <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="search-box">
                    <input type="text" class="form-control search" placeholder="Search for order Name, email, barangay or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-2 col-auto ms-auto">
                <button class="btn btn-success btn-block m-2" id="downloadBtn"><i class="fas fa-download mr-1"></i>Download</button>
            </div>
    <div class="tab-content text-muted">
        <div class="tab-pane fade show active" id="home" role="tabpanel">
            <div class="table-responsive">
            <table class="table" id="attendeesTable">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Email</th>
                <th>Barangay</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendeesWithStatus1 as $attendee)
            <tr>
                
                <td>{{ $attendee->first_name }} {{ $attendee->last_name }} </td>
                <td>{{ $attendee->email }}</td>
                <td>{{ $attendee->barangay }}</td>
                <td>
                <button class="btn btn-primary" id="update-status-btn" data-id="{{ $attendee->id }}">Set As Registered</button>
            </td>  <!-- Add action buttons here -->
             
            </tr>
            @endforeach
        </tbody>
    </table>
            </div>
        </div>
        <div class="tab-pane fade" id="registered" role="tabpanel">
            <div class="table-responsive">
                <table class="table" id="attendeesTable1">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>Barangay</th>
                           
                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($attendeesWithStatus2 as $attendee)
            <tr>
                <td>{{ $attendee->first_name }} {{ $attendee->last_name }} </td>
                <td>{{ $attendee->email }}</td>
                <td>{{ $attendee->barangay }}</td>
                
            </tr>
            @endforeach
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

// $(document).ready(function() {
//     // Setting up CSRF token for AJAX requests
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     var urlParams = new URLSearchParams(window.location.search);
//     var eventId = urlParams.get('id');
//     if (eventId) {
//         fetchAttendees(eventId, 1); // Fetch pre-registered attendees by default
//     }

//     function fetchAttendees(eventId, status) {
//         $.ajax({
//             url: '/fetch-attendees/' + eventId,
//             method: 'GET',
//             success: function(response) {
//                 $('#attendeesTable tbody').empty(); // Clear existing rows
//                 if (response.length > 0) {
//                     response.forEach(function(attendee) {
//                         if (attendee.status == status) {
//                             $('#attendeesTable tbody').append('<tr><td>' + attendee.first_name + ' ' + attendee.last_name + '</td><td>' + attendee.email + '</td><td>' + attendee.barangay + '</td><td>' + attendee.status + '</td><td><input type="checkbox" class="attendee-checkbox" data-id="' + attendee.id + '"></td></tr>');
//                         }
//                     });
//                 } else {
//                     $('#attendeesTable tbody').append('<tr><td colspan="4">No attendees found for this event ID.</td></tr>');
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error fetching attendees:', error);
//             }
//         });
//     }

//     // Click event handler for the filter options
//     $('.nav-link').click(function(e) {
//         e.preventDefault();
//         var status = $(this).data('status'); // Assuming data-status attribute is set in the HTML
//         fetchAttendees(eventId, status);
//     });

    // Click event handler for the delete button
//    
$(document).on('click', '#update-status-btn', function(){
    var attendeeId = $(this).data('id');
    console.log(attendeeId);
    $.ajax({
        url: "/update-status",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            attendee_id: attendeeId
        },
        success:function(response){
            if(response.success){
                // Optionally, you can update the status value displayed in the table here
                console.log('Status updated successfully');
            } else {
                console.log('Failed to update status: ' + response.message);
            }
        },
        error: function(xhr){
            console.log('Error:', xhr);
        }
    });
});
    
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search');
    const attendeesTable = document.getElementById('attendeesTable').getElementsByTagName('tbody')[0];

    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase(); // Trim whitespace and convert to lowercase
        filterAttendees(searchText);
    });

    function filterAttendees(searchText) {
        const rows = attendeesTable.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            // Get cell data from each row and convert to lowercase for comparison
            const name = row.cells[0].innerText.toLowerCase();
            const email = row.cells[1].innerText.toLowerCase();
            const barangay = row.cells[2].innerText.toLowerCase();
            // Ensure the status cell exists before accessing its content
            const status = row.cells[3] ? row.cells[3].innerText.toLowerCase() : '';

            // Check if any of the cell data includes the search text
            if (name.includes(searchText) || email.includes(searchText) || barangay.includes(searchText) || status.includes(searchText)) {
                row.style.display = ''; // Display the row if it matches the search
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match the search
            }
        }
    }
});

   

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search');
    const attendeesTable = document.getElementById('attendeesTable1').getElementsByTagName('tbody')[0];

    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase(); // Trim whitespace and convert to lowercase
        filterAttendees(searchText);
    });

    function filterAttendees(searchText) {
        const rows = attendeesTable.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            // Get cell data from each row and convert to lowercase for comparison
            const name = row.cells[0].innerText.toLowerCase();
            const email = row.cells[1].innerText.toLowerCase();
            const barangay = row.cells[2].innerText.toLowerCase();
            // Since the status cell is missing in the provided code, I'll skip it for now

            // Check if any of the cell data includes the search text
            if (name.includes(searchText) || email.includes(searchText) || barangay.includes(searchText)) {
                row.style.display = ''; // Display the row if it matches the search
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match the search
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

        // Initialize data array with title, header, and data rows
        const data = [
            ['Pre-Registration Report'], // Title row
            ['Name', 'Email', 'Barangay'] // Header row
        ];

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

        // Set column widths to auto
        const wscols = data[1].map((col, i) => ({ wch: Math.max(...data.slice(1).map(row => row[i].length)) }));
        worksheet['!cols'] = wscols;

        // Add the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Pre-Registration');

        // Generate Excel file
        const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

        // Convert Excel buffer to Blob
        const blob = new Blob([excelBuffer], { type: 'application/octet-stream' });

        // Create a download link
        const url = URL.createObjectURL(blob);

        // Create a link element and trigger the download
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'Pre-registration.xlsx'); // Set the filename
        document.body.appendChild(link);
        link.click();

        // Clean up
        URL.revokeObjectURL(url);
        document.body.removeChild(link);
    }
});



document.addEventListener('DOMContentLoaded', function() {
    const downloadBtn = document.getElementById('downloadBtn');

    downloadBtn.addEventListener('click', function() {
        downloadFile();
    });

    function downloadFile() {
        // Get the table element
        const table = document.getElementById('attendeesTable1');

        // Get the table header row
        const headerRow = table.querySelector('thead tr');

        // Initialize data array with header row
        const headerData = Array.from(headerRow.querySelectorAll('th')).map(th => th.textContent.trim());

        // Get the table rows
        const rows = table.querySelectorAll('tbody tr');

        // Initialize data array with header row
        const data = [
            
            headerData // Include the header row in the data array
        ];
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

        // Set column widths to auto
        const wscols = data[0].map((col, i) => ({ wch: Math.max(...data.map(row => row[i].length)) }));
        worksheet['!cols'] = wscols;

        // Add the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Registered');

        // Generate Excel file
        const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

        // Convert Excel buffer to Blob
        const blob = new Blob([excelBuffer], { type: 'application/octet-stream' });

        // Create a download link
        const url = URL.createObjectURL(blob);

        // Create a link element and trigger the download
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'Registered.xlsx'); // Set the filename
        document.body.appendChild(link);
        link.click();

        // Clean up
        URL.revokeObjectURL(url);
        document.body.removeChild(link);
    }
});



document.addEventListener('DOMContentLoaded', function() {
    const updateStatusBtn = document.getElementById('update-status-btn');

    updateStatusBtn.addEventListener('click', function() {
        const attendeeId = this.getAttribute('data-id');

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Set as Registered',
            text: 'Are you sure you want to set this attendee as registered?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, set as registered'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform action if user confirms
                setAttendeeAsRegistered(attendeeId);
            }
        });
    });

    function setAttendeeAsRegistered(attendeeId) {
        // Here you can perform the action to set the attendee as registered
        // For example, you can make an AJAX request to update the status
        // Once the action is completed, you can show a success message using SweetAlert
        // Then reload the whole page
        Swal.fire({
            title: 'Success!',
            text: 'Attendee has been set as registered.',
            icon: 'success',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        }).then(() => {
            // Reload the whole page
            window.location.reload();
        });
    }
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
   
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
     $(document).ready(function() {
        $("#update-status-btn").click(function() {
            // Perform your update logic here
            // For example, you might use an AJAX request to update the data on the server

            // For demo purposes, let's assume the update is successful and we want to refresh the page
            location.reload();
        });
    });
</script> -->
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