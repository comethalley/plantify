@include('templates.header')
<!DOCTYPE html>
<html>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/plants.png" class="img-fluid" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.js"></script>
</head>

<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Planting Calendar</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item active">Planting Calendar</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <!-- ============================================================ -->
                            <div class="col-xl-12">
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
                        <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEventModalLabel">Add Plant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="eventTitle">Seed Name:</label>
                                            <input type="text" class="form-control" id="eventTitle">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventStart">Plant Start:</label>
                                            <input type="date" class="form-control" id="eventStart">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventEnd">Plant End:</label>
                                            <input type="date" class="form-control" id="eventEnd">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="saveEventBtn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Details Modal -->
                        <div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog"
                            aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-0">
                                    <div class="modal-header p-3 bg-ssubtle">
                                        <h5 class="modal-title" id="">Planting Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <!-- Content of your event details will be dynamically inserted here using JavaScript -->
                                        <div class="text-end">
                                            <a href="#" class="btn btn-sm btn-primary" id="edit-event-btn"
                                                data-id="edit-event" onclick="editEvent(this)"
                                                role="button">Edit</a>
                                        </div>
                                        <div class="event-details">
                                        <h5 class="modal-title" id="eventDetailsModalLabel"></h5>
                                            <!-- Event details will be dynamically inserted here -->
                                        </div>
                                        <div class="text-end">
                                            <a href="#" class="btn btn-sm btn-primary" id="edit-event-btn"
                                                data-id="edit-event" onclick="editEvent(this)"
                                                role="button">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update and Delete Event Modal -->
                        <div class="modal fade" id="updateDeleteEventModal" tabindex="-1" role="dialog"
                            aria-labelledby="updateDeleteEventModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateDeleteEventModalLabel">Update/Delete Plant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="updateEventTitle">Seed Name:</label>
                                            <input type="text" class="form-control" id="updateEventTitle">
                                        </div>
                                        <div class="form-group">
                                            <label for="updateEventStart">Plant Start:</label>
                                            <input type="date" class="form-control" id="updateEventStart">
                                        </div>
                                        <div class="form-group">
                                            <label for="updateEventEnd">Plant End:</label>
                                            <input type="date" class="form-control" id="updateEventEnd">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>
                                        <button type="button" class="btn btn-primary" id="updateEventBtn">Update</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                     </div>
                </div> <!-- end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    @include('templates.footer')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '/fullcalendar',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    // Close Update/Delete Event Modal if open
                    $('#updateDeleteEventModal').modal('hide');

                    // Open Add Event Modal
                    $('#addEventModal').modal('show');
                },

                eventRender: function(event, element) {
                    // Customize the way events are rendered
                    var eventTitle = event.title;

                    // Create a new element with the title and append it to the event element
                    var titleElement = $('<div class="fc-title"></div>').text(eventTitle);
                    element.find('.fc-content').empty().append(titleElement);
                },

                eventClick: function(event) {
                    // Close Add Event Modal if open
                    $('#addEventModal').modal('hide');

                    // Populate Event Details Modal with the clicked event's data
                    $('#eventDetailsModalLabel').text(event.title);

                    // You can customize this part based on your event data structure
                    var eventDetailsHtml = `
                        <div class="text-end">
                            <a href="#" class="btn btn-sm btn-primary" id="edit-event-btn" data-id="edit-event" onclick="openUpdateDeleteModal(${event.id})" role="button">Edit</a>
                        </div>
                        <div class="event-details">
                        
                            <div class="mb-2">

                            <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="ri-hand-heart-line fs-16"></i>
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                    <h5 class="modal-title" >Seed Name: ${(event.title)}</h5>
                                    </div>
                                </div>

                            
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="ri-calendar-event-line  fs-16"></i>
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <p class="d-block fw-semibold mb-0" id="event-start-date-tag">Date Start: ${moment(event.start).format("MMMM D, YYYY")}</p>
                                        
                                    </div>
                                </div>

                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="ri-calendar-check-line  fs-16"></i>
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        
                                        <p class="d-block fw-semibold mb-0" id="event-start-date-tag">Date End: ${moment(event.end).format("MMMM D, YYYY")}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    `;

                    // Set the content of the modal body
                    $('#eventDetailsModal .modal-body').html(eventDetailsHtml);

                    // Show the Event Details Modal
                    $('#eventDetailsModal').modal('show');

                    // Close Add Event Modal if open
                    $('#addEventModal').modal('hide');
                    $('#updateEventTitle').val(event.title);
                    $('#updateEventStart').val(moment(event.start).format("YYYY-MM-DD"));
                    $('#updateEventEnd').val(moment(event.end).format("YYYY-MM-DD"));

                    // Store event ID for update and delete
                    var eventId = event.id;
                    $('#updateEventBtn').data('event-id', eventId);
                    $('#deleteEventBtn').data('event-id', eventId);
                }
            });

            function openUpdateDeleteModal() {
                // Close Event Details Modal
                $('#eventDetailsModal').modal('hide');

                // Open Update/Delete Event Modal
                $('#updateDeleteEventModal').modal('show');
            }

            // Open Add Event Modal when clicking on a day or time
            $('#calendar').on('click', '.fc-day', function() {
                // Close Update/Delete Event Modal if open
                $('#updateDeleteEventModal').modal('hide');

                // Open Add Event Modal
                $('#addEventModal').modal('show');
            });

            // Save Event
            $('#saveEventBtn').on('click', function () {
            // Close Add Event Modal

                $('#addEventModal').modal('hide');

                var title = $('#eventTitle').val();
                var start = $('#eventStart').val();
                var end = $('#eventEnd').val();

                if (title && start && end) {
                    // Convert start and end dates to UTC
                    var startUTC = moment.utc(start).format('YYYY-MM-DD');
                    var endUTC = moment.utc(end).format('YYYY-MM-DD');

                    $.ajax({
                        url: "/fullcalendar/action",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            title: title,
                            start: startUTC,
                            end: endUTC,
                            type: 'add'
                        },
                        success: function (data) {
                            calendar.fullCalendar('refetchEvents');
                            $('#addEventModal').modal('hide');
                            alert("Event Created Successfully");
                        },
                        error: function (error) {
                            console.error("Error saving event:", error);
                            alert("Error saving event. Please try again.");
                        }
                    });
                }
            });

            // Update Event Button Click
            $(document).on('click', '#edit-event-btn', function () {
            openUpdateDeleteModal();
            });

            function openUpdateDeleteModal() {
                $('#eventDetailsModal').modal('hide');
                $('#updateDeleteEventModal').modal('show');
            }

            $('#updateEventBtn').on('click', function() {
                // Close Update/Delete Event Modal
                $('#updateDeleteEventModal').modal('hide');

                var eventId = $(this).data('event-id');
                var title = $('#updateEventTitle').val();
                var start = $('#updateEventStart').val();
                var end = $('#updateEventEnd').val();

                if (title && start && end) {
                    $.ajax({
                        url: "/fullcalendar/action",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: eventId,
                            title: title,
                            start: start,
                            end: end,
                            type: 'update'
                        },
                        success: function(data) {
                            calendar.fullCalendar('refetchEvents');
                            $('#updateDeleteEventModal').modal('hide');
                            alert("Event Updated Successfully");
                        },
                        error: function(error) {
                            console.error("Error updating event:", error);
                            alert("Error updating event. Please try again.");
                        }
                    });
                }
            });

            // Delete Event Button Click
            $('#deleteEventBtn').on('click', function() {
                // Close Update/Delete Event Modal
                $('#updateDeleteEventModal').modal('hide');

                var eventId = $(this).data('event-id');
                if (confirm("Are you sure you want to delete this event?")) {
                    $.ajax({
                        url: "/fullcalendar/action",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: eventId,
                            type: 'delete'
                        },
                        success: function(data) {
                            calendar.fullCalendar('refetchEvents');
                            $('#updateDeleteEventModal').modal('hide');
                            alert("Event Deleted Successfully");
                        },
                        error: function(error) {
                            console.error("Error deleting event:", error);
                            alert("Error deleting event. Please try again.");
                        }
                    });
                }
            });

            $('#eventStart, #eventEnd, #updateEventStart, #updateEventEnd').attr('min', moment().format("YYYY-MM-DD"));
        });

    </script>
</body>

</html>