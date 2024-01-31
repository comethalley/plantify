<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@include('templates.header')

<meta name="csrf-token" content="{{ csrf_token() }}" />


<div class="main-content">

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
            <div class="col-12">
                 <!--start row-->

                <div class="row">
                 <!-- end col-->
                    <div class="col-xl-3">
                        <div class="card card-h-100">
                            <div class="card-body" style="display:flex; justify-content:center; align-items:center;">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Events</button>
                            
                                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                             </div>


                             
                        </div>
                        <div class="card">
                            <div class="card-body bg-info-subtle">
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
                      <!----> @foreach ($events as $event) 
                      <div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">{{ $event->title}}</div>
  <div class="card-body">
  <div class="card-title">
    {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}
</div>
    <p class="card-text">Location: {{ $event->location}}</p>
    <p class="card-text">Description: {{ $event->description}}</p>
  </div>
</div>@endforeach
                    </div> <!-- end col-->


<!-- ============================================================ -->
                    <div class="col-xl-9">
                        
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search events">
                            <div class="input-group-append">
                                <button id="searchButton" class="btn btn-primary">{{__('Search')}}</button>
                            </div>
                    </div>

                        <div class="card card-h-100">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!--end row-->

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
                                                    <input type="text" name="start" id="start-datepicker" class="form-control" />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="end-datepicker" class="form-label">End</label>
                                                    <input type="text" name="end" id="end-datepicker" class="form-control" />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input type="text" name="location" id="customername-field" class="form-control" placeholder="Enter Location" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter description" required />
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Add Event</button>
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
                                        <div class="modal-header p-3 bg-info-subtle">
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
                                                            <h6 class="d-block - fw-semibold semibold mb-0">Event Name: <span id="eventtitle"></span></h6>
                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0">Start: <span id="eventstart"></span></h6>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0">End: <span id="eventend"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-map-pin-line text fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0">Location: <span id="eventlocation"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-3">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-discuss-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="d-block  fw-semibold mb-0" id="eventdescription">Description: </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                        <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-danger" id="deleteEventBtn" id="deleteEventBtn">Delete</button>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">edit</button>
                                                    
                                                          </div>  
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-group">
      <div class="form-group">
     
      @csrf
    @method('post')
    @foreach ($data as $base) 
                    <label for="updateEventTitle">Event Name: </label>
                    <input type="text" class="form-control" id="updateEventTitle" value="{{ $base->title}}">
                </div>
                <div class="form-group">
                    <label for="Eventstart-datepicker">Start:</label>
                    <input type="text" class="form-control" id="Eventstart-datepicker" value="{{ $base->title}}">
                </div>
                <div class="form-group">
                    <label for="Eventend-datepicker">End:</label>
                    <input type="text" class="form-control" id="Eventend-datepicker" value="{{ $base->title}}">
                </div>
                <div class="form-group">
                    <label for="updateLocation">Location:</label>
                    <input type="text" class="form-control" id="updateLocation" value="{{ $base->title}}">
                </div>
                <div class="form-group">
                    <label for="updateDescription">Description:</label>
                    <input type="text" class="form-control" id="updateDescription" value="{{ $base->title}}">
</div>>@endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  id="updateEventBtn">Save changes</button>
      </div></form>
    </div>
  </div>
</div>
 <!-- end modal-->


                <!-- end modal-->
            </div>
        </div> <!-- end row-->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    

    <script type="text/javascript">
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getEvent(){

        }

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
            editable: true,
            selectable: true,
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
                    var event = info.event._def.extendedProps
                    var date = info.event._instance.range
                 //   console.log("Variable event is" + event.location)
                  //  console.log("Date is" + date.start)
                    // Close Update/Delete Event Modal if open
                    $('#EventdetailModal').modal('show');
                    
                    // Display event details in the Update/Delete Event Modal
                    
                                            $('#eventtitle').text(eventTitle);

                        // Format start date
                        $('#eventstart').text(moment(date.start).format('MMMM D, YYYY'));

                        // Format end date
                        $('#eventend').text(moment(date.end).format('MMMM D, YYYY'));

                        // Display other event details
                        $('#eventlocation').text(event.location);
                        $('#eventdescription').text(event.description);
                    // Store event ID for update and delete
                    var eventId = event.id;
                    $('#updateEventBtn').data('event-id', eventId);
                    $('#deleteEventBtn').data('event-id', eventId);

                                    // When the user clicks the delete button in the modal
                    $('#deleteEventBtn').on('click', function () {
                        var eventId = info.event.id;
                        
                        // Make an AJAX delete request
                        $.ajax({
                            url: `/scheduledelete/${eventId}`, // Adjust the URL according to your server-side route
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('Event deleted successfully.');

                                // Close the confirmation modal
                                $('#EventdetailModal').modal('hide');

                                // Remove the event from the calendar
                                info.event.remove();
                            },
                            error: function(error) {
                                console.error('Error deleting event:', error);

                                // Close the confirmation modal
                                $('#EventdetailModal').modal('hide');
                            }
                        });
                    });

                    // When the user closes the modal without confirming the delete
                    $('#cancelDeleteEventBtn').on('click', function () {
                        // Close the confirmation modal
                        $('#EventdetailModal').modal('hide');
                    });
                },


            // Drag And Drop

            eventDrop: function(info) {
                var eventId = info.event.id;
                var newStartDate = info.event.start;
                var newEndDate = info.event.end || newStartDate;
                var newStartDateUTC = newStartDate.toISOString().slice(0, 10);
                var newEndDateUTC = newEndDate.toISOString().slice(0, 10);

                $.ajax({
                    method: 'PUT',
                    url: `/schedule/${eventId}`,
                    data: {
                        start_date: newStartDateUTC,
                        end_date: newEndDateUTC,
                    },
                    success: function() {
                        console.log('Event moved successfully.');
                    },
                    error: function(error) {
                        console.error('Error moving event:', error);
                    }
                });
            },

            // Event Resizing
            eventResize: function(info) {
                var eventId = info.event.id;
                var newEndDate = info.event.end;
                var newEndDateUTC = newEndDate.toISOString().slice(0, 10);

                $.ajax({
                    method: 'PUT',
                    url: `/schedule/${eventId}/resize`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        end_date: newEndDateUTC
                    },
                    success: function() {
                        console.log('Event resized successfully.');
                    },
                    error: function(error) {
                        console.error('Error resizing event:', error);
                    }
                });
            },
        });

        calendar.render();

        document.getElementById('searchButton').addEventListener('click', function() {
            var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
            filterAndDisplayEvents(searchKeywords);
        });


        function filterAndDisplayEvents(searchKeywords) {
            $.ajax({
                method: 'GET',
                url: `/events/search?title=${searchKeywords}`,
                success: function(response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                },
                error: function(error) {
                    console.error('Error searching events:', error);
                }
            });
        }
        $('#deleteEventBtn').on('click', function () {

            // Close Update/Delete Event Modal
            $('#editexampleModal').modal('hide');

            var eventId = $(this).data('event-id');
            if (confirm("Are you sure you want to delete this event?")) {
                $.ajax({
                    url: `/scheduledelete/${eventId}`,
                    type: "delete",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        id: eventId,
                        type: 'delete'
                    },
                    success: function (data) {
                        calendar.fullCalendar('refetchEvents');
                        $('#editexampleModal').modal('hide');
                        alert("Event Deleted Successfully");
                    },
                    error: function (error) {
                        console.error("Error deleting event:", error);
                        alert("Event Deleted Successfully");
                    }
                });
                $('#EventdetailModal').modal('hide');
            }
            });
       
        flatpickr("#datepicker", {
      enableTime: true, // Enable time selection
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
    
     altInput: true,
   altFormat: "F j, Y",
   dateFormat: "Y-m-d",
   minDate: "today",
   });
   flatpickr("#Eventend-datepicker", {
    
     altInput: true,
   altFormat: "F j, Y",
   dateFormat: "Y-m-d",
   minDate: "today",
   });
    

       

  </script>

@include('templates.footer')