@include('templates.header')

<meta name="csrf-token" content="{{ csrf_token() }}" />
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
                    <div class="col-xl-3">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <button class="btn btn-primary w-100" id="btn-new-event"><i class="mdi mdi-plus"></i> Create New Planting</button>

                                <div id="external-events" hidden>
                                    <br>
                                    <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                    <div class="external-event fc-event bg-success-subtle text-success" data-class="bg-success-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>New Event Planning
                                    </div>
                                    <div class="external-event fc-event bg-info-subtle text-info" data-class="bg-info-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>Meeting
                                    </div>
                                    <div class="external-event fc-event bg-warning-subtle text-warning" data-class="bg-warning-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>Generating Reports
                                    </div>
                                    <div class="external-event fc-event bg-danger-subtle text-danger" data-class="bg-danger-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>Create New theme
                                    </div>
                                </div>

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
                                        <p class="text-muted mb-0">Scheduled Plantings will appear here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Scheduled Planting</h5>
                            <p class="text-muted">Don't miss scheduled plantings.</p>
                            <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 650px">
                                <div id="upcoming-event-list"></div>
                            </div>
                        </div>
                        
                        
                        <!--end card-->
                    </div> <!-- end col-->
<!-- ============================================================ -->
                    <div class="col-xl-9">
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
                <div class="modal fade" id="event-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-header p-3 bg-info-subtle">
                                <h5 class="modal-title" id="modal-title">Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form class="needs-validation" name="event-form" id="form-event" method="post" novalidate>
                                @csrf
                                    <div class="text-end">
                                        <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event" onclick="editEvent(this)" role="button">Edit</a>
                                    </div>
                                    <div class="event-details">
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-grow-1 d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="ri-calendar-event-line text-muted fs-16"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-time-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"><span id="event-timepicker1-tag"></span> - <span id="event-timepicker2-tag"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-map-pin-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="d-block fw-semibold mb-0"> <span id="event-location-tag"></span></h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-3">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-discuss-line text-muted fs-16"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="d-block text-muted mb-0" id="event-description-tag"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                    <div class="row event-form">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Type of Urban Farming</label>
                                                <select class="form-select d-none" name="type" id="event-category" required>
                                                    <option value="Vertical Farming">Vertical Farming</option>
                                                    <option value="Rooftop Farming">Rooftop Farming</option>
                                                    <option value="Community Garden">Community Garden</option>
                                                    <option value="Indoor Farming">Indoor Farming</option>
                                                    <option value="Microgreen">Microgreen</option>
                                                    <option value="Hydroponics">Hydroponics</option>
                                                    <option value="Aquaponics">Aquaponics</option>
                                                    
                                                </select>
                                                <div class="invalid-feedback">Please select a valid event category</div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Event Name</label>
                                                <input class="form-control d-none" placeholder="Enter event name" type="text" name="title" id="event-title" required value="" />
                                                <div class="invalid-feedback">Please provide a valid event name</div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label>Event Date</label>
                                                <div class="input-group d-none">
                                                    <input type="text" id="event-start-date" class="form-control flatpickr flatpickr-input" name="start_date" placeholder="Select date" readonly required>
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12" id="event-time">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Start Time</label>
                                                        <div class="input-group d-none">
                                                            <input id="timepicker1" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select start time" readonly>
                                                            <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">End Time</label>
                                                        <div class="input-group d-none">
                                                            <input id="timepicker2" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end time" readonly>
                                                            <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="event-location">Location</label>
                                                <div>
                                                    <input type="text" class="form-control d-none" name="location" id="event-location" placeholder="Event location">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <input type="hidden" id="eventid" name="eventid" value="" />
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control d-none" id="event-description" name="description" placeholder="Enter a description" rows="3" spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-soft-danger" id="btn-delete-event" onclick="deleteEvent()"><i class="ri-close-line align-bottom"></i> Delete</button>
                                        <button type="submit" class="btn btn-success" id="btn-save-event">Add Plant</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end modal-content-->
                    </div> <!-- end modal dialog-->
                </div> <!-- end modal-->
                <!-- end modal-->
            </div>
        </div> <!-- end row-->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->


</div>
@include('templates.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnNewEvent = document.getElementById('btn-new-event');
        const eventModal = document.getElementById('event-modal');
        const formEvent = document.getElementById('form-event');
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            events: '/planting', // Assuming your Laravel route returns the event data
        });

        btnNewEvent.addEventListener('click', function () {
            eventModal.classList.add('show');
            // Additional logic to open the modal for a new event
        });

        formEvent.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(formEvent);

            let url = '/planting/create';
            let method = 'POST';

            const eventId = formEvent.querySelector('#eventid').value;
            if (eventId) {
                // If event id exists, it means we are updating an existing event
                url = `/planting/update/${eventId}`;
                method = 'PUT';
            }

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Log the response for testing
                eventModal.classList.remove('show');
                // Additional logic after storing or updating data (e.g., refresh calendar)
                calendar.refetchEvents(); // Refresh the calendar events
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle different error scenarios here (e.g., show error message to the user)
            });

        });

        // Fetch data from the server for the calendar events
        fetch('/planting') // Adjust the route to fetch the data from your backend
            .then(response => response.json())
            .then(data => {
                // Assuming the data format is suitable for FullCalendar events
                calendar.addEventSource(data);
                calendar.render();
            })
            .catch(error => {
                console.error('Error fetching calendar data:', error);
            });

        // Add event listeners or other initialization logic as needed
    });
</script>

