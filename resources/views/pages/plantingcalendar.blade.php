@include('templates.header')
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Calendar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
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
                                <button class="btn btn-primary w-100" id="btn-new-event"><i class="mdi mdi-plus"></i> Create New Event</button>

                                <div id="external-events">
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
                        <div>
                            <h5 class="mb-1">Upcoming Events</h5>
                            <p class="text-muted">Don't miss scheduled events</p>
                            <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 400px">
                                <div id="upcoming-event-list"></div>
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
                                        <p class="text-muted mb-0">Event that applications book will appear here. Click on an event to see the details and manage applicants event.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-9">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!--end row-->

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
                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                    <div class="text-end">
                                        <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event" onclick="editEvent(this)" role="button">Edit</a>
                                    </div>
                                    
                                    <div class="row event-form">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Type of Urban Farming</label>
                                                <select class="form-select d-none" name="category" id="event-category" required>
                                                    <option value="bg-success-subtle">Vertical Farming</option>
                                                    <option value="bg-success-subtle">Rooftop Farming</option>
                                                    <option value="bg-success-subtle">Community Garden</option>
                                                    <option value="bg-success-subtle">Indoor Farming</option>
                                                    <option value="bg-success-subtle">Microgreen</option>
                                                    <option value="bg-success-subtle">Hydroponics</option>
                                                    <option value="bg-success-subtle">Aquaponics</option>
                                                    
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
                                                    <input type="text" id="event-start-date" class="form-control flatpickr flatpickr-input" placeholder="Select date" readonly required>
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
                                                    <input type="text" class="form-control d-none" name="event-location" id="event-location" placeholder="Event location">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <input type="hidden" id="eventid" name="eventid" value="" />
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control d-none" id="event-description" placeholder="Enter a description" rows="3" spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i class="ri-close-line align-bottom"></i> Delete</button>
                                        <button type="submit" class="btn btn-success" id="btn-save-event">Add Event</button>
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
    // Your JavaScript logic here

    // For example, handling the creation of a new event
    const btnNewEvent = document.getElementById('btn-new-event');
    btnNewEvent.addEventListener('click', function () {
        // Code to open the modal for creating a new event
        // ...
    });

    // Code for handling external events (drag and drop)
    const externalEvents = document.getElementById('external-events');
    // You might need to implement drag and drop functionality here
    // ...

    // Code for handling upcoming events list
    const upcomingEventList = document.getElementById('upcoming-event-list');
    // Populate and manage the upcoming event list
    // ...

    // Code for handling the event modal
    const eventModal = document.getElementById('event-modal');
    // Implement logic to open, close, and manage the event modal
    // ...

    // Code for handling the form submission (adding/updating events)
    const formEvent = document.getElementById('form-event');
    formEvent.addEventListener('submit', function (event) {
        event.preventDefault();
        // Handle form submission (e.g., sending data to the server)
        // ...
    });

    // Other event handling and logic related to the calendar can be added here
});
</script>