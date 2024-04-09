<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@include('templates.header')

<meta name="csrf-token" content="{{ csrf_token() }}" />


<div class="main-content" >

<div class="page-content">
    <div class="container-fluid">

   
 @section('content')
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Event Calendar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            
                            <li class="breadcrumb-item active">Event Calendar</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" >
                 <!--start row-->

                 <div class="row scrollable">
                    <div class="col-xl-3 scrollable" style="overflow-y: auto; max-height: 100vh;">
                        <div class="card card-h-100">
                            <div class="card-body" style="display:flex; justify-content:center; align-items:center;">
                                
                            
                            @if(auth()->user()->role_id == 1)
                            {{-- Display only for role_id 1 (Admin) --}}
                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Events</button>
                            @elseif(auth()->user()->role_id == 2)
                            {{-- Display only for role_id 2 (
                                 Admin) --}}
                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Events</button>
                            @elseif(auth()->user()->role_id == 3)
                            {{-- Display for role_id 3 (Farm Leader) --}}
                            <button hidden type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Events</button>
                            @elseif(auth()->user()->role_id == 4 )
                            {{-- Display only for role_id 4 ( Farmers) --}}
                            <button hidden type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Events</button>
                            @elseif(auth()->user()->role_id == 5 )
                            {{-- Display only for role_id 5 (Public Users) --}}
                            <button hidden type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Events</button>
                            @endif
                            </div>
                        </div>
                        <div class="card scrollable">
                            <div class="card-body bg-info-subtle" style="overflow-y: auto;" >
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i data-feather="calendar" class="text-info icon-dual-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-15">Welcome to your Calendar!</h6>
                                        <p class="text-muted mb-0">Scheduled events will appear here.</p>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                                  
                        @include('pages.displayevent')
                                
            </div> <!-- end col-->
 <!-- ============================================================ -->
                <div class="col-xl-9">
                        
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search events">
                            <div class="input-group-append">
                                <button id="searchButton" class="btn btn-success">{{__('Search')}}</button>
                            </div>
                    </div>

                        <div class="card card-h-100">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
                
            </div> <!--end row-->
    </div>
        </div> <!-- end row-->
<!-- ============================================================ -->
                <div style='clear:both'></div>

                <!-- Add New Event MODAL -->
                     <div class="modal fade" id="showModalExample" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="{{ URL('/create-schedule') }}"  id="form-event">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Event Name</label>
                                                    <input type="text" name="title" id="customername-field" class="form-control" placeholder="Enter name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="start-datepicker" class="form-label">Start</label>
                                                    <input type="text" name="start" id="start-datepicker" class="form-control" placeholder="Enter Start Date" required/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="end-datepicker" class="form-label">End</label>
                                                    <input type="text" name="end" id="end-datepicker" class="form-control" placeholder="Enter End Date" required/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input type="text" name="location" id="customername-field" class="form-control" placeholder="Enter Location"  required/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter description" required/>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info" id="addEvent">Add Event</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> 
                            </div> <!-- end modal-->

    <!---event detail EventModal--->
    <div class="modal fade" id="EventdetailModal" tabindex="-1" role="dialog" aria-labelledby="EventdetailModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0">
                                        <div class="modal-header p-3 bg-soft-success">
                                            <h5 class="modal-title" id="modal-title">Event details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                        <form class="needs-validation view-event" name="event-form" id="form-event" novalidate="">
                                      
                                                <div class="event-details">
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-grow-1 d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="ri-calendar-event-line text-muted fs-16"></i>
                                                            </div>
                                                            
                                                            <div class="flex-grow-1">
                                                            <h5 class="d-block - fw-semibold semibold mb-0">Event Name: <span id="eventtitle"></span></h5>
                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="d-block fw-semibold mb-0">Start: <span id="eventstart"></span></h5>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="d-block fw-semibold mb-0">End: <span id="eventend"></span></h5>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-map-pin-line text fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="d-block fw-semibold mb-0">Location: <span id="eventlocation"></span></h5>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-3">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-discuss-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                        <h5 class="d-block fw-semibold mb-0">Description: <span id="eventdescription"></span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                        
                                                        <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#archiveModal">Delete</button>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Edit</button>
                                                    
                                                          
                                                        </div>

                                                    </div>
                                                </div>
                                          
                                            </form>
                                        </div>
                                    </div> <!-- end modal-content-->
                                </div> <!-- end modal dialog-->
                               
                            </div>
<!-- Update and Delete Event Modal -->
<div class="modal fade" id="editexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group">
                                <div class="form-group mb-3">
                                                <label for="updateEventTitle">Event Name:</label>
                                                <input type="text" class="form-control" id="updateEventTitle" placeholder="Enter Event Name" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Eventstart-datepicker" class="form-label">Start</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                    <input type="text" name="start" id="Eventstart-datepicker" class="form-control" data-toggle="flatpickr" data-flatpickr-enable-time="true" data-flatpickr-date-format="Y-m-d" placeholder="Enter Start Date" required/>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Eventend-datepicker" class="form-label">End</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                    <input type="text" name="end" id="Eventend-datepicker" class="form-control" data-toggle="flatpickr" data-flatpickr-enable-time="true" data-flatpickr-date-format="Y-m-d" placeholder="Enter End Date" required />
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="updateLocation">Location:</label>
                                                <input type="text" class="form-control" id="updateLocation" placeholder="Enter location" required>
                                            </div>

                                        
                                    
                                            <div class="form-group mb-3">
                                                <label for="updateDescription">Description:</label>
                                                <input type="text" class="form-control" id="updateDescription" placeholder="Enter description" required>
                                            </div>


                                           

                                          
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"  id="updateEventBtn">Save changes</button>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- end modal-->

                
        
        
    </div>
    <!-- container-fluid -->
</div>
       <!--Archive Supplier Modal-->
       <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="farm-name">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mt-4 text-center">
                                                    <input type="hidden" id="archive-supplierID" class="form-control" placeholder="ID" />
                                                    <lord-icon src="https://cdn.lordicon.com/drxwpfop.json" trigger="hover" style="width:100px;height:100px">
                                                    </lord-icon>
                                                    <h4>You are about to archive <span id="archive-supplier-name"></span>?</h4>
                                                    <p class="text-muted fs-15 mb-4">Are you sure you want to proceed ?</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                        <button type="button" class="btn btn-danger" id="delete-record">Yes, Archive It</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Archive Supplier Modal-->
<!-- End Page-content -->





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script type="text/javascript">
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var calendarEl = document.getElementById('calendar');
        var events = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: '/schedulesget',
            @if(auth()->user()->role_id == 1)
                            {{-- Display only for role_id 1 (Admin) --}}
            selectable: true,
            @elseif(auth()->user()->role_id == 2)
                            {{-- Display only for role_id 2 (Super Admin) --}}
           selectable: true,         
           @elseif(auth()->user()->role_id == 3)
                            {{-- Display for role_id 3 (Farm Leader) --}}    
            selectable: false,
            @elseif(auth()->user()->role_id == 4 )
                             {{-- Display only for role_id 4 ( Farmers) --}}
            selectable: false,
            @elseif(auth()->user()->role_id == 5 )
                             {{-- Display only for role_id 5 (Public Users) --}}
            selectable: false,
            @endif
            selectHelper: true,
            select: function (start, end, allDay) {
               // Close Update/Delete Event Modal if open
               $('#EventdetailModal').modal('hide');

               
                // Open Add Event Modal
            $('#showModalExample').modal('show');
                },
               
                eventClick: function (info) {
                  //  console.log(info.event)
                  //  console.log("Event is", info.event._def.extendedProps);
                    var eventTitle = info.event._def.title
                    var eventID = info.event._def.publicId
                    var eventStart = info.event.start;
                    var eventEnd = info.event.end;
                    var eventLocation = info.event.extendedProps.location;
                var eventDescription = info.event.extendedProps.description;
                    var event = info.event._def.extendedProps
                    var date = info.event._instance.range
                 //   console.log("Variable event is" + event.location)
                  //  console.log("Date is" + date.start)
                    // Close Update/Delete Event Modal if open
            @if(auth()->user()->role_id == 1)
                            {{-- Display only for role_id 1 (Admin) --}}
                            $('#EventdetailModal').modal('show');
            @elseif(auth()->user()->role_id == 2)
                            {{-- Display only for role_id 2 (Super Admin) --}}
                            $('#EventdetailModal').modal('show');         
           @elseif(auth()->user()->role_id == 3)
                            {{-- Display for role_id 3 (Farm Leader) --}}    
                            $('#EventdetailModal').modal('hide');
            @elseif(auth()->user()->role_id == 4 )
                             {{-- Display only for role_id 4 ( Farmers) --}}
                             $('#EventdetailModal').modal('hide');
            @elseif(auth()->user()->role_id == 5 )
                             {{-- Display only for role_id 5 (Public Users) --}}
                             $('#EventdetailModal').modal('hide');
            @endif
                    
                    
                    // Display event details in the Update/Delete Event Modal
                    
                        $('#eventtitle').text(eventTitle);
                        $('#eventstart').text(moment(date.start).format('MMMM D, YYYY'));
                        $('#eventend').text(moment(date.end).format('MMMM D, YYYY'));
                        $('#eventlocation').text(event.location);
                        $('#eventdescription').text(event.description);

                        $('#updateEventTitle').val(eventTitle);
                        $('#Eventstart-datepicker').val(moment(eventStart).format("YYYY-MM-DD"));
                        $('#Eventend-datepicker').val(moment(eventEnd).format("YYYY-MM-DD"));
                        $('#updateLocation').val(eventLocation);
                        $('#updateDescription').val(eventDescription);
                    // Store event ID fo var eventId = event.id;r update and delete
                    var eventId = event.id;
                    $('#updateEventBtn').data('event-id', eventId);
                    $('#delete-record').data('event-id', eventId);

                                    // When the user clicks the delete button in the modal// Store event ID for update and delete
 var eventId = info.event.id;
$('#delete-record').data('event-id', eventId);

   $('#delete-record').on('click', function () {
    handleEventDelete($(this).data('event-id'));
        });

function handleEventDelete(eventId) {
 // Close Update/Delete Event Modal
 $('#editexampleModal').modal('hide');
 $('#EventdetailModal').modal('hide');
 
    $.ajax({
        url: "/scheduledelete/" + eventId,
        type: "DELETE",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
                    calendar.refetchEvents();
                    $('#archiveModal').modal('hide');
                    Swal.fire({
                    title: "Successfully archived",
                    text: "Are you ready for the next level?",
                    icon: "error"
                    });
                    $('#planting-events-container').load(location.href + ' planting-events-container');
                },
                    error: function (error) {
                        console.error("Error deleting event:", error);
                        alert("Error deleting planting. Please try again.");
                    }
                });
            
        }

      
        $('#updateEventBtn').on('click', function () {
            var eventId = $('#updateEventBtn').data('eventId') || info.event.id;
            var title = $('#updateEventTitle').val();
            var start = $('#Eventstart-datepicker').val();
            var end = $('#Eventend-datepicker').val();
            var location = $('#updateLocation').val();
            var description = $('#updateDescription').val();
            
            console.log("Data Sent:", {
            title: title,
            start: start,
            end: end,
            location: location,
            description: description,
        });


            if (title && start && end && location && description) {
                $.ajax({
                    url: "/scheduleupdate/" + eventId,
                    type: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        location: location,
                        description: description,
                    },

                    
                    success: function (data) {
                        // Assuming your Laravel controller returns a JSON response with a success message
                        
                        $('#editexampleModal').modal('hide');
                        $('#planting-events-container').load(window.location.href + ' #planting-events-container');
                        calendar.refetchEvents();
                        $('#editexampleModal').modal('hide');
                        Swal.fire({
                        title: "Successfully Updated",
                        text: "Are you ready for the next level?",
                        icon: "success"
                        });
                        
                       
                   
                    },
                    error: function (error) {
                        console.error("Error updating event:", error);
                        $('#editexampleModal').modal('show');
                        Swal.fire({
                        title: "Unsuccessfully update",
                        text: "Please enter a valid information",
                        icon: "error"
                        });
                    }
                });
            }
        });

  
                  
                },


            // Drag And Drop

        
            // Event Resizing

        });

        calendar.render();

document.getElementById('searchButton').addEventListener('click', function () {
    var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
    filterAndDisplayEvents(searchKeywords);
});
function filterAndDisplayEvents(searchKeywords) {
            $.ajax({
                method: 'GET',
                url: `/events/search?title=${searchKeywords}`,
                success: function (response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                },
                error: function (error) {
                    console.error('Error searching events:', error);
                }
            });
        }
</script>
       
     
                        // Update Event Button Click
                     
       
        flatpickr("#datepicker", {
      enableTime: false, // Enable time selection
      dateFormat: "Y-m-d H:i", // Date and time format
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
  <script>
   flatpickr("#start-datepicker", {
     
     altInput: true,
   altFormat: "F j, Y",
   dateFormat: "Y-m-d",
   minDate: "today",
   });
   flatpickr("#end-datepicker", {
    
     altInput: true,
   altFormat: "F j, Y",
   dateFormat: "Y-m-d",
   minDate: "today",
   });
  

       flatpickr("#Eventstart-datepicker", {
        enableTime: false,
     altInput: true,
   altFormat: "F j, Y",
   dateFormat: "Y-m-d",
   minDate: "today",
   });
   flatpickr("#Eventend-datepicker", {
    enableTime: false,
     altInput: true,
   altFormat: "F j, Y",
   dateFormat: "Y-m-d",
   minDate: "today",
   });

    
 

   

       
</script>

<script>
    $(document).ready(function(){
    $("#deleteEventBtn").click(function(){
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $("#EventdetailModal").modal("hide")
        $("#archiveModal").modal("show")
    });
});

$("#addEvent").click(function(){
    $('#showModalExample').modal('hide');
    Swal.fire({
        title: "Successfully added",
        text: "Are you ready for the next level?", <br>
        icon: "success",
        showConfirmButton: false // Remove the OK button
    });
});

</script>
<script>
calendar.render();

document.getElementById('searchButton').addEventListener('click', function () {
    var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
    filterAndDisplayEvents(searchKeywords);
});
function filterAndDisplayEvents(searchKeywords) {
            $.ajax({
                method: 'GET',
                url: `/events/search?title=${searchKeywords}`,
                success: function (response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                },
                error: function (error) {
                    console.error('Error searching events:', error);
                }
            });
        }
</script>


@include('templates.footer')