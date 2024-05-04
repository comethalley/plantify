<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/plants.png" class="img-fluid" />
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
                                            <h5 class="modal-title" id="exampleModalLabel">Create Events</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="{{ URL('/create-schedule') }}"  id="form-event" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Event Name</label>
                                                    <input type="text" name="title" id="customername-field" class="form-control" placeholder="Enter name" required />
                                                </div>

                                               
                                                
                                                <div class="col-12" id="event-time">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Date</label>
                                                                    <div class="input-group">
                                                                        <input id="start-datepicker" name="start" type="text" class="form-control flatpickr flatpickr-input active" placeholder="Select start date" readonly="readonly" required>
                                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Date</label>
                                                                    <div class="input-group">
                                                                        <input id="end-datepicker" name="end" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end date" readonly="readonly" required>
                                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="col-12" id="event-time">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Time</label>
                                                                    <div class="input-group">
                                                                        <input id="timepicker1" name="starttime"type="text" class="form-control flatpickr flatpickr-input active" placeholder="Select start time" readonly="readonly" required>
                                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Time</label>
                                                                    <div class="input-group">
                                                                        <input id="timepicker2" name="endtime" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end time" readonly="readonly" required>
                                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3">
    <label class="form-label">Who can see it?</label>
    <select name="visibility" id="choices-multiple-remove-button" data-choices data-choices-remove-item multiple>
        <option value="all">all</option>
        <option value="farmleader">farmleader</option>
        <option value="farmer">farmer</option>
        <option value="publicuser">publicuser</option>
    </select>
</div>
                                                    
                                       <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input type="text" name="location" id="customername-field" class="form-control" placeholder="Enter Location"  required/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter description" required/>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" name="image" id="image" class="form-control" accept="image/*" />
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

                            <div class="modal fade" id="EventdetailModal" tabindex="-1" role="dialog" aria-labelledby="EventdetailModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header p-3 bg-success text-white">
                <h5 class="modal-title">Event Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12 mb-4 text-center">
                        <img src="" alt="Event Image" class="img-fluid rounded" id="eventimage" style="width: 400px; height: 250px;">
                    </div>
                    <div class="col-md-12 text-center"> <!-- Added text-center class -->
    <div class="event-details">
        <h5 class="fw-bold mb-4 fs-5" id="eventtitle"></h5>
    </div>
</div>
                            <div class="mb-3 fs-5">
                                <i class="ri-calendar-event-line text-muted me-2"></i>
                                <span id="eventstart"></span> - <span id="eventend"></span>
                            </div>
                            <div class="mb-3 fs-5">
                                <i class="ri-time-line text-muted me-2"></i>
                                <span id="eventstarttime"></span> - <span id="eventendtime"></span>
                            </div>
                            <div class="mb-3 fs-5">
                                <i class="ri-map-pin-line text-muted me-2"></i>
                                <span id="eventlocation"></span>
                            </div>
                            <div class="mb-3 fs-6">
                            <i class="ri-discuss-line text-muted me-2"></i>
                            <span id="eventdescription"></span>
                              </div>

                            <div class="hstack gap-2 justify-content-end">
          
                                @if(auth()->user()->role_id == 3 || auth()->user()->role_id == 4)

                                <a href="#" id="interested-btn" class="btn btn-primary" target="_blank">Interested</a>

                                @endif
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#archiveModal1">Delete</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Edit</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                            <div class="col-12" id="event-time">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Time</label>
                                                                    <div class="input-group">
                                                                        <input id="timepicker1" name="starttime" type="text" class="form-control flatpickr flatpickr-input active" placeholder="Select start time" readonly="readonly" required>
                                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Time</label>
                                                                    <div class="input-group">
                                                                        <input id="timepicker2" name="endtime" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end time" readonly="readonly" required>
                                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                            <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" name="updateimage" id="updateimage" class="form-control" accept="image/*" />
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
       <div class="modal fade" id="archiveModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <button type="button" class="btn btn-danger" id="delete-record1">Yes, Archive It</button>
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
                   console.log(info.event)
                  //  console.log("Event is", info.event._def.extendedProps);
                    var eventTitle = info.event._def.title;
                    var eventId = info.event._def.publicId;
                    var eventStart = info.event.start;
                    var eventEnd = info.event.end;
                    var eventLocation = info.event.extendedProps.location;
                var eventDescription = info.event.extendedProps.description;
                var starttime = info.event._def.extendedProps.starttime;
                var starttime = info.event.starttime;
                var endtime = info.event._def.extendedProps.endtime;
                var endtime = info.event.endtime;
                    var event = info.event._def.extendedProps;
                    var date = info.event._instance.range;
                    
                 //   console.log("Variable event is" + event.location)
                  //  console.log("Date is" + date.start)
                    // Close Update/Delete Event Modal if open
        
                            $('#EventdetailModal').modal('show');
          
                    
                    
                    // Display event details in the Update/Delete Event Modal
                    $.ajax({
        url: '/events/' + eventId,
        type: 'GET',
        success: function(response) {
            
            $('#eventtitle').text(response.title);
            $('#eventstart').text(moment(response.start).format('MMMM D, YYYY'));
            $('#eventend').text(moment(response.end).format('MMMM D, YYYY'));
    $('#eventstarttime').text(moment(response.starttime, 'HH:mm:ss').format('h:mm A'));
$('#eventendtime').text(moment(response.endtime, 'HH:mm:ss').format('h:mm A'));
            $('#eventlocation').text(response.location);
            $('#eventdescription').text(response.description);
            var imageUrl = "assests/images/event/"+response.image;
            console.log("Image Event"+imageUrl)
            $('#eventimage').attr('src', imageUrl);
            // Show the modal
            $('#EventdetailModal').modal('show');

            $('#interested-btn').attr('href', '/event/form/'+ eventId);
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
        }
    });


                        $('#updateEventTitle').val(eventTitle);
                        $('#Eventstart-datepicker').val(moment(eventStart).format("Y-m-d"));
                        $('#Eventend-datepicker').val(moment(eventEnd).format("Y-m-d"));
                        $('#updateLocation').val(eventLocation);
                        $('#updateDescription').val(eventDescription);
                        $('#timepicker1').val(moment(starttime).format('HH:mm:ss'));
$('#timepicker2').val(moment(endtime).format('HH:mm:ss'));

                    // Store event ID fo var eventId = event.id;r update and delete
                    var eventId = event.id;
                    $('#updateEventBtn').data('event-id', eventId);
                    $('#delete-record1').data('event-id', eventId);

                                    // When the user clicks the delete button in the modal// Store event ID for update and delete
 var eventId = info.event.id;
$('#delete-record1').data('event-id', eventId);

   $('#delete-record1').on('click', function () {
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
                    $('#archiveModal1').modal('hide');
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
            var starttime = $('#timepicker1').val();
            var endtime = $('#timepicker2').val();

            console.log("Data Sent:", {
            title: title,
            start: start,
            end: end,
            location: location,
            description: description,
            starttime: starttime,
            endtime: endtime,
        });


            if (title && start && end && location && description && starttime && endtime) {
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
                        starttime: starttime,
                        endtime: endtime,
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

        $(document).ready(function() {
    $('#create-btn').click(function(e) {
        e.preventDefault();
        
        // Get the selected visibility option
        var selectedVisibility = $('#choices-multiple-remove-button').val();
        
        // Send an AJAX request to fetch events based on the selected visibility
        $.ajax({
            url: "{{ route('events.calendar') }}",
            type: 'GET',
            data: { visibility: selectedVisibility },
            success: function(response) {
                // Handle success response and display the calendar
                console.log(response);
                // Code to display the calendar events goes here
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });
});
        
</script>
       
<script>
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

    
   flatpickr("#timepicker1",{
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
});

flatpickr("#timepicker2",{
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
});

       
</script>

<script>
    $(document).ready(function(){
    $("#delete-record1").click(function(){
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $("#EventdetailModal").modal("hide")
        $("#archiveModal1").modal("show")
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
<script>
   document.getElementById('interestButton').addEventListener('click', function() {
    this.classList.toggle('interested');
    if (this.classList.contains('interested')) {
        this.innerHTML = '<i id="starIcon" class="fas fa-star"></i> Interested';
    } else {
        this.innerHTML = '<i id="starIcon" class="fas fa-star"></i> I\'m Interested';
    }
});



</script>
 <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        const select = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
        });
    </script>
    <script>
    // // Get the current URL
    // let currentUrl = window.location.href;

    // // Extract the event ID from the URL
    // let eventId = currentUrl.substr(currentUrl.lastIndexOf('/') + 1);

    // // Redirect to the form page when the button is clicked
    // document.getElementById('interested-btn').addEventListener('click', function() {
    //     window.location.href = "/event/attendance/form/" + eventId;
    // });
</script>
@include('templates.footer')