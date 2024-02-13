<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @include('templates.header')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
</head>
<body>
    

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @section('content')
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

                <div class="row">
                    <div class="col-xl-3">
                        <div class="card card-h-100">
                            <div class="card-body" style="display:flex; justify-content:center; align-items:center;">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample">
                                    <i class="mdi mdi-plus"></i>Create New Planting
                                </button>
                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                                    <i class="ri-delete-bin-2-line"></i>Delete Selected
                                </button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body bg-info-subtle">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i data-feather="calendar" class="text-info icon-dual-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-15">Welcome to your Planting Calendar!</h6>
                                        <p class="text-muted mb-0">Scheduled Plantings will appear here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('pages.plantingevents')
                        
                </div>

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
                    </div>
                </div>

                
                <div style='clear:both'></div>

                <!-- Add New Event MODAL -->
                     <div class="modal fade" id="showModalExample" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-soft-success p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Planting</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="{{ URL('/create-plantcalendar') }}"  id="form-event">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />
                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3 ">
                                                    <label for="customername-field" class="form-label">Seed Name</label>
                                                    <input type="text" name="title" id="customername-field" class="form-control" placeholder="Enter Seed Name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="start-datepicker" class="form-label">Start</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                        <input type="text" name="start" id="start-datepicker" class="form-control" placeholder="Select Start Date" required/>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="end-datepicker" class="form-label">End</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                        <input type="text" name="end" id="end-datepicker" class="form-control" placeholder="Select End Date" required/>
                                                    </div>
                                                </div>


                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    
                                                    <input type="text" name="status" id="customername-field" class="form-control" value="Status" required readonly/>
                                                    
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
                                        <div class="modal-header p-3 bg-soft-success">
                                            <h5 class="modal-title" id="modal-title">Planting Details</h5>
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
                                                            <h6 class="d-block - fw-semibold semibold mb-0"><span id="eventtitle"></span></h6>
                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"><span id="eventstart"></span></h6>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"><span id="eventend"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-map-pin-line text fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"><span id="eventstatus"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-3">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-discuss-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="d-block  fw-semibold mb-0" id="eventdescription"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-danger" id="deleteEventBtn" id="deleteEventBtn">Delete</button>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Edit</button>
                                                    
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
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Planting</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group">
                                <div class="form-group mb-3">
                                                <label for="updateEventTitle">Seed Name:</label>
                                                <input type="text" class="form-control" id="updateEventTitle" placeholder="Enter Seed Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="updatestart-datepicker" class="form-label">Start</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                    <input type="text" name="start" id="updatestart-datepicker" class="form-control" data-toggle="flatpickr" data-flatpickr-enable-time="true" data-flatpickr-date-format="Y-m-d" placeholder="Enter Start Date" required />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="updateend-datepicker" class="form-label">End</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                    <input type="text" name="end" id="updateend-datepicker" class="form-control" data-toggle="flatpickr" data-flatpickr-enable-time="true" data-flatpickr-date-format="Y-m-d" placeholder="Enter End Date" required />
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="updatestatus">Status:</label>
                                                <select name="updatestatus" id="updatestatus" class="form-control">
                                                    <option value="Status" readonly selected>Status</option>    
                                                    <option value="Harvested">Harvested</option>
                                                    <option value="Destroyed">Destroyed</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="updateDescription">Description:</label>
                                                <input type="text" class="form-control" id="updateDescription" placeholder="Enter Description">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    

    
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Flatpickr
        flatpickr("#start-datepicker, #updatestart-datepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        flatpickr("#end-datepicker, #updateend-datepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });
        flatpickr("#datepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: '/plantcalendarget',
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
                var eventTitle = info.event.title;
                var eventStart = info.event.start;
                var eventEnd = info.event.end;
                var eventStatus = info.event.extendedProps.status;
                var eventDescription = info.event.extendedProps.description;

                // Display event details in the Event Detail Modal
                $('#eventtitle').text(eventTitle);
                $('#eventstart').text(moment(eventStart).format("YYYY-MM-DD"));
                $('#eventend').text(moment(eventEnd).format("YYYY-MM-DD"));
                $('#eventstatus').text(eventStatus);
                $('#eventdescription').text(eventDescription);

                // Store event ID for update and delete
                var eventId = info.event.id;
                $('#deleteEventBtn').data('event-id', eventId);

                // Populate update modal fields
                $('#updateEventTitle').val(eventTitle);
                $('#updatestart-datepicker').val(moment(eventStart).format("YYYY-MM-DD"));
                $('#updateend-datepicker').val(moment(eventEnd).format("YYYY-MM-DD"));
                $('#updatestatus').val(eventStatus);
                $('#updateDescription').val(eventDescription);

                // Show the Event Detail Modal
                $('#EventdetailModal').modal('show');
            },


            // Drag And Drop
            eventDrop: function (info) {
                var eventId = info.event.id;
                var newStartDate = info.event.start;
                var newEndDate = info.event.end || newStartDate;
                var newStartDateUTC = newStartDate.toISOString().slice(0, 16).replace("T", " ");
                var newEndDateUTC = newEndDate.toISOString().slice(0, 16).replace("T", " ");

                handleEventUpdate(eventId, newStartDateUTC, newEndDateUTC);
            },

            // Event Resizing
            eventResize: function (info) {
                var eventId = info.event.id;
                var newEndDate = info.event.end;
                var newEndDateUTC = newEndDate.toISOString().slice(0, 16).replace("T", " ");

                handleEventUpdate(eventId, null, newEndDateUTC);
            },

            eventContent: function (info) {
                var eventStatus = info.event.extendedProps.status;
                var backgroundColor = getEventBackgroundColor(eventStatus);

                return {
                    html: '<div style="background-color: ' + backgroundColor + '; border: none;">' + info.event.title + '</div>',
                };
            },
        });

        calendar.render();

        document.getElementById('searchButton').addEventListener('click', function () {
            var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
            filterAndDisplayEvents(searchKeywords);
        });

        // Update Event Button Click
        $('#updateEventBtn').on('click', function () {
            var eventId = $('#deleteEventBtn').data('event-id');
            var title = $('#updateEventTitle').val();
            var start = $('#updatestart-datepicker').val();
            var end = $('#updateend-datepicker').val();
            var status = $('#updatestatus').val();
            var description = $('#updateDescription').val();
            
            console.log("Data Sent:", {
            title: title,
            start: start,
            end: end,
            status: status,
            description: description,
        });


            if (title && start && end && status && description) {
                $.ajax({
                    url: "/plantcalendar/" + eventId,
                    type: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        status: status,
                        description: description,
                    },

                    
                    success: function (data) {
                        // Assuming your Laravel controller returns a JSON response with a success message
                        console.log(data.message);
                        $('#editexampleModal').modal('hide');
                        calendar.refetchEvents();
                        alert("Planting Updated Successfully");
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
            handleEventDelete($(this).data('event-id'));
        });

        function handleEventUpdate(eventId, start, end, status, description) {
            $.ajax({
                url: "/plantcalendar/" + eventId,
                type: "PUT",
                data: {
                    start_date: start,
                    end_date: end,
                    status: status,
                    description: description,
                },
                success: function (data) {
                    calendar.refetchEvents();
                    alert("Planting Updated Successfully");
                },
                error: function (error) {
                    console.error("Error updating event:", error);
                    alert("Error updating planting. Please try again.");
                }
            });
        }

        function handleEventDelete(eventId) {
            // Close Update/Delete Event Modal
            $('#editexampleModal').modal('hide');
            $('#EventdetailModal').modal('hide');

            if (confirm("Are you sure you want to delete this event?")) {
                $.ajax({
                url: "/plantcalendardelete/" + eventId,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    calendar.refetchEvents();
                    alert("Planting Deleted Successfully");
                },
                    error: function (error) {
                        console.error("Error deleting event:", error);
                        alert("Error deleting planting. Please try again.");
                    }
                });
            }
        }

        function filterAndDisplayEvents(searchKeywords) {
            $.ajax({
                method: 'GET',
                url: `/plantcalendar/search?title=${searchKeywords}`,
                success: function (response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                },
                error: function (error) {
                    console.error('Error searching events:', error);
                }
            });
        }

        function getEventBackgroundColor(status) {
        if (status === 'Harvested') {
            return 'rgba(40, 167, 69, 0.5)'; // Green background for Harvested
        } else if (status === 'Destroyed') {
            return 'rgba(220, 53, 69, 0.5)'; // Red background for Destroyed
        } else {
            return 'transparent'; // Transparent background for other events
        }
    }


        flatpickr("#start-datepicker, #updatestart-datepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        flatpickr("#end-datepicker, #updateend-datepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        document.getElementById("updatestatus").selectedIndex = 0;

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



@include('templates.footer')