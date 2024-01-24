@include('templates.header')
<!DOCTYPE html>
<html>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<head>
   
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
                <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add Plant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="eventTitle">Seed Name:</label>
                    <input type="text" class="form-control" id="eventTitle">
                </div>
                <div class="form-group">
                    <label for="eventStart">Plant Start:</label>
                    <input type="datetime-local" class="form-control" id="eventStart">
                </div>
                <div class="form-group">
                    <label for="eventEnd">Plant End:</label>
                    <input type="datetime-local" class="form-control" id="eventEnd">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEventBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Update and Delete Event Modal -->
<div class="modal fade" id="updateDeleteEventModal" tabindex="-1" role="dialog" aria-labelledby="updateDeleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDeleteEventModalLabel">Update/Delete Plant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="updateEventTitle">Seed Name:</label>
                    <input type="text" class="form-control" id="updateEventTitle">
                </div>
                <div class="form-group">
                    <label for="updateEventStart">Plant Start:</label>
                    <input type="datetime-local" class="form-control" id="updateEventStart">
                </div>
                <div class="form-group">
                    <label for="updateEventEnd">Plant End:</label>
                    <input type="datetime-local" class="form-control" id="updateEventEnd">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>
                <button type="button" class="btn btn-primary" id="updateEventBtn">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

$(document).ready(function () {
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
            select: function (start, end, allDay) {
                // Close Update/Delete Event Modal if open
                $('#updateDeleteEventModal').modal('hide');

                // Open Add Event Modal
                $('#addEventModal').modal('show');
            },
            eventClick: function (event) {
                // Close Add Event Modal if open
                $('#addEventModal').modal('hide');

                // Display event details in the Update/Delete Event Modal
                $('#updateEventTitle').val(event.title);
                $('#updateEventStart').val(moment(event.start).format("YYYY-MM-DDTHH:mm"));
                $('#updateEventEnd').val(moment(event.end).format("YYYY-MM-DDTHH:mm"));

                // Store event ID for update and delete
                var eventId = event.id;
                $('#updateEventBtn').data('event-id', eventId);
                $('#deleteEventBtn').data('event-id', eventId);

                // Show the modal
                $('#updateDeleteEventModal').modal('show');
            }
        });

        // Open Add Event Modal when clicking on a day or time
        $('#calendar').on('click', '.fc-day, .fc-time', function () {
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
                $.ajax({
                    url: "/fullcalendar/action",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        title: title,
                        start: start,
                        end: end,
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
        $('#updateEventBtn').on('click', function () {

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
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        id: eventId,
                        title: title,
                        start: start,
                        end: end,
                        type: 'update'
                    },
                    success: function (data) {
                        calendar.fullCalendar('refetchEvents');
                        $('#updateDeleteEventModal').modal('hide');
                        alert("Event Updated Successfully");
                    },
                    error: function (error) {
                        console.error("Error updating event:", error);
                        alert("Error updating event. Please try again.");
                    }
                });
            }
        });

        // Delete Event Button Click
        $('#deleteEventBtn').on('click', function () {

            // Close Update/Delete Event Modal
            $('#updateDeleteEventModal').modal('hide');

            var eventId = $(this).data('event-id');
            if (confirm("Are you sure you want to delete this event?")) {
                $.ajax({
                    url: "/fullcalendar/action",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        id: eventId,
                        type: 'delete'
                    },
                    success: function (data) {
                        calendar.fullCalendar('refetchEvents');
                        $('#updateDeleteEventModal').modal('hide');
                        alert("Event Deleted Successfully");
                    },
                    error: function (error) {
                        console.error("Error deleting event:", error);
                        alert("Error deleting event. Please try again.");
                    }
                });
            }
        });
        $('#eventStart, #eventEnd, #updateEventStart, #updateEventEnd').attr('min', moment().format("YYYY-MM-DDTHH:mm"));
    });
</script>

  
</body>
</html>
