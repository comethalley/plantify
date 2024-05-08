<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @include('templates.header')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
       /* Styling for readonly input fields */
        .form-control[readonly] {
            background-color: #f8f9fa; /* Light gray background */
            cursor: not-allowed; /* Change cursor to not-allowed */
        }

        /* Styling for disabled input fields */
        .form-control:disabled {
            background-color: #f8f9fa; /* Light gray background */
            cursor: not-allowed; /* Change cursor to not-allowed */
        }

    </style>
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
                            <h4 class="mb-sm-0">Planting Monitoring</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Planting Monitoring</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row scrollable">

                    <div class="col-xl-9">
                        <div class="input-group mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search Planting">
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

                    <div class="col-xl-3 scrollable" style="overflow-y: auto; max-height: 100vh;">
                        <div class="card card-h-100">
                            <div class="card-body" style="display:flex; justify-content:center; align-items:center;">
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                {{-- Display only for role_id 1 (Admin) --}}
                                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#usingModal"><i class="ri-add-line align-bottom me-1"></i> Create New Plantings</button>

                                @elseif(auth()->user()->role_id == 5 )
                                {{-- Display only for role_id 5 (Public Users) --}}
                                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalExample"><i class="mdi mdi-plus"></i>Create New Plantings</button>
                                @endif

                            </div>
                        </div>
                        <div class="card scrollable">
                            <div class="card-body bg-info-subtle" style="overflow-y: auto;">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i data-feather="calendar" class="text-info icon-dual-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-15">Welcome to your Planting Monitoring!</h6>
                                        <p class="text-muted mb-0">Scheduled Plantings will appear here.</p>
                                    </div>
                                </div>
                                <hr>

                                <div class="flex-grow-1 ms-3 text-center">
                                    <h6 class="fs-15"><strong>LEGEND</strong></h6>
                                    <td style="width: 180px;">
                                        <div class="bg-primary p-2 mb-1">
                                            <span class="text-white mb-0">Planted</span>
                                        </div>
                                        <div class="bg-success p-2 mb-1">
                                            <span class="text-white mb-0">Harvested</span>
                                        </div>
                                        <div class="bg-danger p-2 mb-1">
                                            <span class="text-white mb-0">Destroyed</span>
                                        </div>
                                    </td>

                                </div>

                            </div>
                        </div>
                        @include('pages.plantingevents')

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
                            <form method="post" action="/create-plantcalendar" id="form-event">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="id-field" />
                                    <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                    <div class="mb-3">
                                        <label for="seed" class="form-label">Plant Name</label>
                                        <select name="title" id="seed-dropdown" class="form-select" required>
                                            <option value="">Select Seed Name</option>
                                            @foreach ($plantInfo as $name => $days)
                                            <option value="{{ $name }}" data-days-harvest="{{ $days }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="seed" class="form-label">Seed Weight (g)</label>
                                        <input type="text" name="seed" id="seed-input" class="form-control" placeholder="Input Seed Weight by grams." required />
                                    </div>

                                    <!-- =================== -->
                                    <div class="mb-3" hidden>

                                        <input type="text" name="harvested" id="customername-field" class="form-control" value="0" required />
                                        <input type="text" name="destroyed" id="customername-field" class="form-control" value="0" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="start-datepicker" class="form-label">Planting Date</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                            <input type="date" name="start" id="start-datepicker" class="form-control" placeholder="Select Start Date" required />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="end-datepicker" class="form-label">Harvested Date</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                            <input type="date" name="end" id="end-datepicker" class="form-control" placeholder="Select End Date" required />
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" name="status" id="customername-field" class="form-control" value="Planted" required readonly />
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info" id="addplanting">Add Planting</button>
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
                                    <div class="row">
                                        <div class="col-md-6 d-flex mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <i class="ri-leaf-fill text-muted fs-16"></i>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <h6 class="d-block - fw-semibold semibold mb-0">Plant Name: </h6><span id="eventtitle"></span>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6  d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-scales-2-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1 group">
                                                <h6 class="d-block fw-semibold mb-0" for="typeLabel">Seed Weight (g)</h6><span id="eventseed"></span>
                                            </div>
                                        </div>

                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                                        {{-- Display only for role_id 1 (Admin) --}}
                                        <div class=" col-md-6 d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-leaf-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0">Planting Type: </span></h6><span id="eventtype">
                                            </div>
                                        </div>
                                        @endif
                                        <div class=" col-md-6 d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-road-map-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0">Area Used: </span></h6><span id="eventarea">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="d-flex align-items-center mb-2 hide-if-planted">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-plant-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 for="estimateh" class="d-block fw-semibold mb-0">Estimated Harvest (pcs): </h6><span id="eventharvested"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-2 hide-if-planted">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-delete-bin-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 for="estimated" class="d-block fw-semibold mb-0">Estimated Withered (pcs):</h6><span id="eventdestroyed"></span>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6 d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-calendar-check-fill text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0">Planting Date: </h6><span id="eventstart"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-calendar-event-fill text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0">Harvesting Date: </h6><span id="eventend"></span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-map-pin-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0">Status: </h6><span id="eventstatus"></span>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            @if(auth()->user()->role_id == 1)
                                            {{-- Display only for role_id 1 (Admin) --}}
                                            <button type="button" class="btn btn-danger" id="deleteEventBtn" id="deleteEventBtn">Delete</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Change Satus</button>
                                            @elseif(auth()->user()->role_id == 2)
                                            {{-- Display only for role_id 2 (Admin) --}}
                                            <button type="button" class="btn btn-danger" id="deleteEventBtn" id="deleteEventBtn">Delete</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Change Satus</button>
                                            @elseif(auth()->user()->role_id == 3)
                                            {{-- Display for role_id 3 (Farm Leader) --}}
                                            <button type="button" class="btn btn-danger" id="deleteEventBtn" id="deleteEventBtn">Delete</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Change Satus</button>
                                            @elseif(auth()->user()->role_id == 4)
                                            {{-- Display for role_id 4 (Farmers) --}}
                                            <button hidden type="button" class="btn btn-danger" id="deleteEventBtn" id="deleteEventBtn">Delete</button>
                                            <button hidden type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal">Change Satus</button>
                                            @endif
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
                            <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="updateEventTitle">Plant Name:</label>
                                <input type="text" class="form-control" id="updateEventTitle" readonly>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="typeLabel">Seed Weight (g): </label>
                                <input type="text" class="form-control" id="updateEventSeed" readonly>
                            </div>
                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                            {{-- Display for role_id 1-4 (Admins) --}}
                            <div class="col-md-6 form-group mb-3">
                                <label id="typeLabel" for="updateEventType">Planting Type:</label>
                                <input type="text" class="form-control" id="updateEventType" readonly>
                            </div>
                            @elseif(auth()->user()->role_id == 5)
                            {{-- Set type to null for role_id 5 --}}
                            <input type="hidden" id="updateEventType" value="">
                            @else
                            {{-- For other roles, exclude the field --}}
                            @endif
                            <div class="col-md-6 form-group mb-3">
                                <label for="updatearea">Area Used:</label>
                                <input type="text" class="form-control" id="updatearea" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="updatestatus">Status: <span class="text-muted"> Status change allowed only on Harvesting Date.</span></label>
                                <select name="updatestatus" id="updatestatus" class="form-control">
                                    <option id="updatestatus" readonly selected>Planted</option>
                                    <option value="Harvested">Harvested</option>
                                    <option value="Withered">Withered</option>
                                </select>
                            </div>
                           


                            <div class="col-md-6 form-group mb-3">
                                <label id="typeLabela" for="updateEventHarvested">Estimated Harvest (pcs):</label>
                                <input type="text" class="form-control" id="updateEventHarvested" placeholder="Enter Seeds Harvested">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label id="typeLabelb" for="updateEventDestroyed">Estimated Withered (pcs):</label>
                                <input type="text" class="form-control" id="updateEventDestroyed" placeholder="Enter Seeds Withered">
                            </div>
                           
                            <div class="col-md-6 mb-3">
                                <label for="updatestart-datepicker" class="form-label">Planting Date:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                    <input type="text" name="start" id="updatestart-datepicker" class="form-control" data-toggle="flatpickr" data-flatpickr-enable-time="true" data-flatpickr-date-format="Y-m-d" placeholder="Enter Start Date" readonly required disabled />
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="updateend-datepicker" class="form-label">Harvesting Date:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                    <input type="text" name="end" id="updateend-datepicker" class="form-control" data-toggle="flatpickr" data-flatpickr-enable-time="true" data-flatpickr-date-format="Y-m-d" placeholder="Enter End Date" readonly required disabled />
                                </div>
                            </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="updateEventBtn">Save changes</button>
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


    <!--Using Modal-->
    <div class="modal fade" id="usingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Planting Scanner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form method="post" action="/add-supplier">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="multiple-used" class="form-label item-text">Multiple Items</label>
                                    <input type="text" id="multiple-used" class="form-control" placeholder="" value="1" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mode">Unit of Measurement</label>
                                    <select class="form-select selecting" id="mode">
                                        <option value="1">Per Pack</option>
                                        <option value="2">Per Gram(s)</option>
                                        <option value="3">Per Piece(s)</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" name="status" id="customername-field" class="form-control" value="Planted" required readonly />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">Area</label>
                                <input type="text" name="area" id="area" class="form-control" value="1" required />
                            </div>

                        </div>
                        <center>
                            <p class="text-muted">Scan the Seed's Qr Code Generated from the Inventory > Supplier</p>
                        </center>
                        <video id="using-preview" style="width: 100%;"></video>
                        <div class="mb-3 use_manual-form" style="display: none;">
                            <input type="text" id="use_manual-code" class="form-control" />
                            <br>
                            <button type="button" class="btn btn-primary use_manual_submit">Submit</button>
                        </div>
                        <center>
                            <p class="lead text-danger" id="used-qr"></p>
                        </center><br>
                        <center>
                            <a href="#" id="no_camera">Camera not available?</a>
                        </center>
                        <!-- <div class="mb-3">
                            <label for="seed" class="form-label">Seeds Amount (g).</label>
                            <input type="text" name="seed" id="seed-input" class="form-control" placeholder="Seed Amount (g)." required />
                        </div> -->


                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-success" id="using-scan">Scan</button> -->
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Using Modal-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        

        document.addEventListener('DOMContentLoaded', function() {

            var seedInputElement = document.getElementById("seed-input");
            var eventSeedElement = document.getElementById("eventseed");
            var multipleUsedElement = document.getElementById("multiple-used");
            var updateEventSeedElement = document.getElementById("updateEventSeed");
            var updateEventDestroyedElement = document.getElementById("updateEventDestroyed");
            var updateEventHarvestedElement = document.getElementById("updateEventHarvested");
            var areaElement = document.getElementById("area");
            var updateareaElement = document.getElementById("updatearea");
            
            
            seedInputElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            eventSeedElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            multipleUsedElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            updateEventSeedElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            updateEventDestroyedElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            updateEventHarvestedElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            areaElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });

            updateareaElement.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });



            function calculateEndDate(startDate, daysToHarvest) {
                var endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + parseInt(daysToHarvest));
                return endDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
            }

            // Event listener for changes in start date
            $('#start-datepicker').change(function() {
                var startDate = new Date($(this).val());
                var seedName = $('#seed-dropdown').val();
                var daysToHarvest = $('#seed-dropdown option:selected').data('days-harvest');
                if (startDate && seedName && daysToHarvest) {
                    var endDate = calculateEndDate(startDate, daysToHarvest);
                    $('#end-datepicker').val(endDate);
                }
            });

            // Event listener for changes in seed dropdown
            $('#seed-dropdown').change(function() {
                var startDate = new Date($('#start-datepicker').val());
                var daysToHarvest = $(this).find('option:selected').data('days-harvest');
                if (startDate && daysToHarvest) {
                    var endDate = calculateEndDate(startDate, daysToHarvest);
                    $('#end-datepicker').val(endDate);
                }
            });
            // Initialize Flatpickr
            flatpickr("#start-datepicker, #updatestart-datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
            });

            flatpickr("#end-datepicker, #updateend-datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
            });

            flatpickr("#datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
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
                select: function(start, end, allDay) {
                    // Close Update/Delete Event Modal if open
                    $('#EventdetailModal').modal('hide');

                    // Open Add Event Modal
                    //$('#showModalExample').modal('show');


                },

                eventClick: function(info) {
                    var eventTitle = info.event.title;
                    var eventSeed = info.event.extendedProps.seed;
                    var eventType = info.event.extendedProps.type;
                    var eventHarvested = info.event.extendedProps.harvested;
                    var eventDestroyed = info.event.extendedProps.destroyed;
                    var eventStart = info.event.start;
                    var eventEnd = info.event.end;
                    var eventStatus = info.event.extendedProps.status;
                    var eventArea = info.event.extendedProps.area;

                    // Display event details in the Event Detail Modal
                    $('#eventtitle').text(eventTitle);
                    $('#eventseed').text(eventSeed);
                    $('#eventtype').text(eventType);
                    $('#eventharvested').text(eventHarvested);
                    $('#eventdestroyed').text(eventDestroyed);
                    $('#eventstart').text(moment(eventStart).format("YYYY-MM-DD"));
                    $('#eventend').text(moment(eventEnd).format("YYYY-MM-DD"));
                    $('#eventstatus').text(eventStatus);
                    $('#eventarea').text(eventArea);


                    // Store event ID for update and delete
                    var eventId = info.event.id;
                    $('#deleteEventBtn').data('event-id', eventId);
                    // Populate update modal fields
                    $('#updateEventTitle').val(eventTitle);
                    $('#updateEventSeed').val(eventSeed);
                    $('#updateEventType').val(eventType);
                    $('#updateEventDestroyed').val(eventDestroyed);
                    $('#updateEventHarvested').val(eventHarvested);
                    $('#updatestart-datepicker').val(moment(eventStart).format("YYYY-MM-DD"));
                    $('#updateend-datepicker').val(moment(eventEnd).format("YYYY-MM-DD"));
                    $('#updatestatus').val(eventStatus);
                    $('#updatearea').val(eventArea);


                    // Show the Event Detail Modal
                    $('#EventdetailModal').modal('show');

                    // console.log(eventHarvested)
                    console.log(info)

                },
                // Drag And Drop
                eventDrop: function(info) {
                    var eventId = info.event.id;
                    var newStartDate = info.event.start;
                    var newEndDate = info.event.end || newStartDate;
                    var newStartDateUTC = newStartDate.toISOString().slice(0, 16).replace("T", " ");
                    var newEndDateUTC = newEndDate.toISOString().slice(0, 16).replace("T", " ");

                    handleEventUpdate(eventId, newStartDateUTC, newEndDateUTC);
                },

                // Event Resizing
                eventResize: function(info) {
                    var eventId = info.event.id;
                    var newEndDate = info.event.end;
                    var newEndDateUTC = newEndDate.toISOString().slice(0, 16).replace("T", " ");

                    handleEventUpdate(eventId, null, newEndDateUTC);
                },

                eventContent: function(info) {
                    var eventStatus = info.event.extendedProps.status;
                    var backgroundColor = getEventBackgroundColor(eventStatus);

                    return {
                        html: '<div style="background: ' + backgroundColor + '">' + info.event.title + '</div>',
                    };
                },
            });

            calendar.render();

            document.getElementById('searchButton').addEventListener('click', function() {
                var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
                filterAndDisplayEvents(searchKeywords);
            });

            var authUserRole = <?php echo auth()->user()->role_id; ?>;

            $('#updateEventBtn').on('click', function() {
                var eventId = $('#deleteEventBtn').data('event-id');
                var title = $('#updateEventTitle').val();
                var seed = $('#updateEventSeed').val();
                var type = $('#updateEventType').val();
                var harvested = $('#updateEventHarvested').val();
                var destroyed = $('#updateEventDestroyed').val();
                var start = $('#updatestart-datepicker').val();
                var end = $('#updateend-datepicker').val();
                var status = $('#updatestatus').val();
                var area = $('#updatearea').val();


                // Check if any required field is empty
                if (!title || !start || !end || !status || !seed || !harvested || !destroyed || !area) {
                    // Display validation error message
                    Swal.fire({
                        title: "Error",
                        text: "Please fill in all required fields",
                        icon: "error"
                    });
                    return; // Stop execution if validation fails
                }

                // Check if the status is "Planted" and the event is already "Planted"
                

                // if (status === "Harvested" && status === "Harvested") {
                //     // Display validation error message
                //     Swal.fire({
                //         title: "Error",
                //         text: "Cannot save if it is already 'Harvested'.",
                //         icon: "error"
                //     });
                //     return; // Stop execution if validation fails
                // }

                // if (status === "Withered" && status === "Withered") {
                //     // Display validation error message
                //     Swal.fire({
                //         title: "Error",
                //         text: "Cannot save if it is already 'Withered'.",
                //         icon: "error"
                //     });
                //     return; // Stop execution if validation fails
                // }

                var currentDate = new Date();
                var endDate = new Date(end);
                if (endDate.getTime() >= currentDate.getTime()) {
                    // Display validation error message
                    Swal.fire({
                        title: "Error",
                        text: "End date must be equal to current date",
                        icon: "error"
                    });
                    return; // Stop execution if validation fails
                }


                // If the user role is not admin and type is empty, set it to null
                if (authUserRole !== 1 && !type) {
                    type = null;
                }

                // Make AJAX request
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
                        seed: seed,
                        harvested: harvested,
                        destroyed: destroyed,
                        type: type,
                        area: area,
                    },
                    success: function(data) {
                        console.log(data.message);
                        $('#editexampleModal').modal('hide');
                        calendar.refetchEvents();
                        Swal.fire({
                            title: "Success",
                            text: "Planting Updated Successfully.",
                            icon: "success"
                        });
                    },
                    error: function(error) {
                        console.error("Error updating event:", error);
                        Swal.fire({
                            title: "Error",
                            text: "Error updating event. Please try again.",
                            icon: "error"
                        });
                    }
                });
            });

            // Delete Event Button Click
            $('#deleteEventBtn').on('click', function() {
                handleEventDelete($(this).data('event-id'));
            });

            function handleEventUpdate(eventId, start, end, status, seed, harvested, destroyed, type, area, ) {
                $.ajax({
                    url: "/plantcalendar/" + eventId,
                    type: "PUT",
                    data: {
                        start_date: start,
                        end_date: end,
                        status: status,
                        seed: seed,
                        harvested: harvested,
                        destroyed: destroyed,
                        type: type,
                        area: area,
                    },
                    success: function(data) {
                        calendar.refetchEvents();
                        alert("Planting Updated Successfully");
                    },
                    error: function(error) {
                        console.error("Error updating event:", error);
                        alert("Error updating planting. Please try again.");
                    }
                });
            }


            function handleEventDelete(eventId) {
                // Close Update/Delete Event Modal
                $('#editexampleModal').modal('hide');
                $('#EventdetailModal').modal('hide');

                // Display SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete this event.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked the 'Yes, delete it!' button
                        // Send AJAX request to delete the event
                        $.ajax({
                            url: "/plantcalendardelete/" + eventId,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                // Event deleted successfully
                                calendar.refetchEvents();
                                Swal.fire(
                                    'Deleted!',
                                    'Planting has been deleted successfully.',
                                    'success'
                                );
                            },
                            error: function(error) {
                                // Error occurred while deleting event
                                console.error("Error deleting event:", error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting planting. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }


            function filterAndDisplayEvents(searchKeywords) {
                $.ajax({
                    method: 'GET',
                    url: `/plantcalendar/search?title=${searchKeywords}`,
                    success: function(response) {
                        calendar.removeAllEvents();
                        calendar.addEventSource(response);
                    },
                    error: function(error) {
                        console.error('Error searching events:', error);
                    }
                });
            }

            function getEventBackgroundColor(status) {
                if (status === 'Harvested') {
                    return '#009d88'; // Green background for Harvested
                } else if (status === 'Withered') {
                    return '#d9534f'; // Red background for Destroyed
                } else {
                    return; // Transparent background for Planted
                }
            }


            flatpickr("#start-datepicker, #updatestart-datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
            });

            flatpickr("#end-datepicker, #updateend-datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
            });

            document.getElementById("updatestatus").selectedIndex = 0;

            document.getElementById('seed-dropdown').addEventListener('change', function() {
                // Get the selected seed name value and its days_harvest attribute
                var selectedSeedId = this.value;
                var daysHarvest = parseInt(this.options[this.selectedIndex].getAttribute('data-days-harvest'));

                // Get the selected start date
                var startDateInput = document.getElementById('start-datepicker');
                var startDate = new Date(startDateInput.value);

                // Calculate the end date based on the selected start date and days_harvest
                var endDate = new Date(startDate.getTime() + daysHarvest * 24 * 60 * 60 * 1000);

                // Format the end date as YYYY-MM-DD
                var endDateFormatted = endDate.toISOString().slice(0, 10);

                // Set the calculated end date value to the end date input field
                var endDateInput = document.getElementById('end-datepicker');
                endDateInput.value = endDateFormatted;
            });

            function createPlanted(seedName, daysHarvest, type, amount, area) {
                var startDate = new Date().toISOString().slice(0, 10);
                var startDateObject = new Date(startDate);
                var endDateObject = new Date(startDateObject.getTime() + (daysHarvest * 24 * 60 * 60 * 1000));
                var endDate = endDateObject.toISOString().slice(0, 10);

                // Check if any required field is empty
                if (!seedName || !daysHarvest || !type || !amount) {
                    // Display validation error message
                    Swal.fire({
                        title: "Error",
                        text: "Please fill in all required fields.",
                        icon: "error"
                    });
                    return; // Stop execution if validation fails
                }

                // Check if start date is a valid date
                if (isNaN(startDateObject.getTime())) {
                    Swal.fire({
                        title: "Error",
                        text: "Please provide a valid start date.",
                        icon: "error"
                    });
                    return;
                }

                // Check if end date is a valid date
                if (isNaN(endDateObject.getTime())) {
                    Swal.fire({
                        title: "Error",
                        text: "Please provide a valid end date.",
                        icon: "error"
                    });
                    return;
                }

                // If start date is provided, make the AJAX request
                $.ajax({
                    type: 'POST',
                    url: '/create-plantcalendar',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: seedName,
                        start: startDate,
                        end: endDate,
                        status: "Planted",
                        harvested: 0,
                        destroyed: 0,
                        seed: amount,
                        type: type,
                        area: area,
                    },
                    success: function(response) {
                        calendar.refetchEvents();
                        console.log('Success:', response);
                        // Swal.fire({
                        //     title: "Success",
                        //     text: "Planting created successfully.",
                        //     icon: "success"
                        // });
                        var Kalabasa = "Kalabasa";

                        //getPrediction(amount, 30, 60, 10, Kalabasa)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Check if the response contains validation errors

                        var errorMessage = xhr.responseJSON.message
                        
                            Swal.fire({
                                title: "Error",
                                html: errorMessage,
                                icon: "error"
                            });
                    }
                });
            }

            function getPrediction(quantity, temp, humidity, precipitation, cropname) {
                const url = `http://localhost/cropsprediction/?planted_quantity=${quantity}&temperature=${temp}&humidity=${humidity}&precipitation=${precipitation}&crop_name=${cropname}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        var destroyed = data.predicted_destroyed
                        var harvested = data.predicted_harvested
                        Swal.fire({
                            title: "Predicted Data",
                            text: "Predicted Harvest: " + harvested + "kg, Predicted Destroyed: " + destroyed + "kg", // Convert data to string for displaying
                            icon: "success"
                        });
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            title: "There is an error processing your request",
                            text: error.message,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
            }




            $('.selecting').change(function() {
                var selectedValue = $(this).val();
                console.log("Selected value: " + selectedValue);

                // You can add your logic here based on the selected option
                // For example:
                if (selectedValue === "2") {
                    $(".item-text").text('Weight')
                } else if (selectedValue === "3") {
                    $(".item-text").text('Quantity')
                } else {
                    $(".item-text").text('Multiple Items')
                }
            });

            let usingScanner;
            let usingModal = document.getElementById("usingModal");

            function usedItem(lastUsedScannedContent, parsedMultipleUsed, mode) {
                if (lastUsedScannedContent == "") {
                    //alert("QR code is empty!");
                    Swal.fire({
                        title: "QR code is empty !",
                        text: "Please show appropriate QR Code",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                    // alert(lastUsedScannedContent);
                    stopUsedScanner();
                    $.ajax({
                        url: "/remove-stock",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            qrcode: lastUsedScannedContent,
                            multiplier: parsedMultipleUsed,
                            mode: mode,
                        },
                        success: function(data) {
                            //getStocksList();
                            console.log(data);
                            lastUsedScannedContent = "";
                            $("#multiple-used").val("1");
                            $("#used-qr").text(" ");
                            Swal.fire({
                                title: "Successfully Receive",
                                text: "Item has been remove to inventory",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                            startUsedScanner();
                            createPlanted(data.seedName, data.daysHarvest, data.type, data.amount, area);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", status, error);
                            var errorMessage = xhr.responseJSON.message; // Assuming error response contains a 'message' property
                            Swal.fire({
                                title: "There is an error processing your request",
                                text: errorMessage,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        },
                    });
                }
            }

            function startUsedScanner() {
                usingScanner = new Instascan.Scanner({
                    video: document.getElementById("using-preview"),
                });

                var lastUsedScannedContent = "";

                usingScanner.addListener("scan", function(content) {
                    console.log(content);
                    lastUsedScannedContent = content;
                    $("#used-qr").text(lastUsedScannedContent);
                    var multipleUsed = $("#multiple-used").val();
                    var parsedMultipleUsed = parseInt(multipleUsed);
                    var mode = $("#mode").val();
                    var area = $("#area").val();
                    usedItem(lastUsedScannedContent, parsedMultipleUsed, mode);
                });

                // $('#using-scan').on('click', function () {
                //     var multipleUsed = $("#multiple-used").val();
                //     var parsedMultipleUsed = parseInt(multipleUsed);
                //     var mode = $("#mode").val();
                //     usedItem(lastUsedScannedContent, parsedMultipleUsed, mode);
                //     lastUsedScannedContent = "";
                // });

                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        usingScanner.start(cameras[0]);
                    } else {
                        console.error("No cameras found.");
                    }
                });
            }

            function stopUsedScanner() {
                if (usingScanner) {
                    usingScanner.stop();
                }
            }

            usingModal.addEventListener("shown.bs.modal", function() {
                startUsedScanner();
            });

            usingModal.addEventListener("hidden.bs.modal", function() {
                stopUsedScanner();
                lastUsedScannedContent = "";
            });


            $("#no_camera").on("click", function() {
                console.log("void-btn is clicked");

                stopUsedScanner()
                $('#using-preview').hide()
                $('.use_manual-form').show()

            });

            $(".use_manual_submit").on("click", function() {
                console.log("manual_submit is clicked");
                var qrcode = $('#use_manual-code').val()
                var multiplier = $('#multiple-used').val();
                var mode = $('#mode').val();
                var area = $('#area').val();

                // Check if the total area of the farm exceeds the farm area
                var totalArea = parseFloat(area) * parseFloat(multiplier);
                if (totalArea > parseFloat('{{ $farm->area }}')) {
                    Swal.fire({
                        title: "Error",
                        text: "The area used exceeds the farm's area.",
                        icon: "error"
                    });
                    return; // Stop execution if validation fails
                }

                $.ajax({
                    url: "/remove-stock",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {
                        qrcode: qrcode,
                        multiplier: multiplier,
                        mode: mode,
                        area: area,
                    },
                    success: function(data) {
                        //getStocksList();
                        console.log(data);
                        Swal.fire({
                            title: "Successfully Receive",
                            text: "Item has been remove to inventory",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        createPlanted(data.seedName, data.daysHarvest, data.type, data.amount, area,);
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                        var errorMessage = xhr.responseJSON.message; // Assuming error response contains a 'message' property
                        Swal.fire({
                            title: "There is an error processing your request",
                            text: errorMessage,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    },
                });
            });



            var eventTypeSpan = document.getElementById("eventtype");
            var typeLabels = document.querySelectorAll("h6[for='typeLabel']");
            var typeLabelsFlex = document.querySelectorAll("label[for='typeLabel']");
            

            eventTypeSpan.addEventListener("DOMSubtreeModified", function() {
                var eventType = eventTypeSpan.textContent.trim();

                typeLabels.forEach(function(label) {
                    if (eventType === "Seedlings") {
                        label.textContent = "Seed Quantity (pcs):";
                    } else {
                        label.textContent = "Seed Weight (g):";
                    }
                });
                typeLabelsFlex.forEach(function(label) {
                    if (eventType === "Seedlings") {
                        label.textContent = "Seed Quantity (pcs):";
                    } else {
                        label.textContent = "Seed Weight (g):";
                    }
                });


            });

            $('#updatestatus').change(function() {
                var status = $(this).val();
                var eventType = $('#eventtype').text().trim(); // Retrieve event type directly
                console.log('Event Type:', eventType);

                var seedAmount = parseFloat($('#updateEventSeed').val());
                var harvested, destroyed;

                if (eventType === 'Seedlings') {
                    if (status === 'Harvested') {
                        harvested = seedAmount.toFixed(); 
                        destroyed = '0';
                    } else if (status === 'Withered') {
                        harvested = '0';
                        destroyed = seedAmount.toFixed(); // Entire seed amount is destroyed
                    } else {
                        harvested = ''; // Clear harvested value
                        destroyed = ''; // Clear destroyed value
                    }
                } else {
                    if (status === 'Harvested') {
                        harvested = (seedAmount * 4.5).toFixed(); // 70% of seed amount
                        destroyed = (seedAmount * 0.5).toFixed(); // 30% of seed amount
                    } else if (status === 'Withered') {
                        harvested = '0'; // Clear harvested value
                        destroyed = seedAmount.toFixed(); // Entire seed amount is destroyed
                    } else {
                        harvested = ''; // Clear harvested value
                        destroyed = ''; // Clear destroyed value
                    }
                }

                $('#updateEventHarvested').val(harvested);
                $('#updateEventDestroyed').val(destroyed);
            });

               // Get the end date from the datepicker
           // Function to disable updatestatus select element based on end date
            function disableUpdateStatus() {
            var endDateStr = $('#updateend-datepicker').val(); // Assuming the date is in YYYY-MM-DD format
            console.log("endDateStr:", endDateStr);

            var endDate = new Date(endDateStr);
            var currentDate = new Date();
            var status = $('#eventstatus').text().trim();
            console.log("status:", status);

            console.log("endDate:", endDate);
            console.log("currentDate:", currentDate);

            if (status === 'Harvested' || status === 'Withered' || endDate >= currentDate) {
                console.log("Disabling estimated harvest and withered inputs...");
                $('#updatestatus').prop('disabled', true);
                $('#updateEventHarvested').prop('disabled', true);
                $('#updateEventDestroyed').prop('disabled', true);
            } else {
                console.log("Enabling estimated harvest and withered inputs...");
                $('#updatestatus').prop('disabled', false);
                $('#updateEventHarvested').prop('disabled', false);
                $('#updateEventDestroyed').prop('disabled', false);
            }
        }

        // Call the function when the modal is shown and when the end date changes
        $('#editexampleModal').on('show.bs.modal', function () {
            disableUpdateStatus();
        });

        $('#updateend-datepicker').on('change', function() {
            disableUpdateStatus();
        });


                            


        });

       


        $(document).ready(function() {
            // Function to update visibility of harvested and destroyed input fields
            function updateVisibility(status) {
                if (status === 'Harvested') {
                    $('#updateEventHarvested').parent().show(); // Show harvested input field
                    $('#updateEventDestroyed').parent().show(); // Show destroyed input field
                    // $('#eventharvested').parent().show();
                } else if (status === 'Withered') {
                    $('#updateEventHarvested').parent().show(); // Hide harvested input field
                    $('#updateEventDestroyed').parent().show(); // Show destroyed input field
                    // $('#eventdestroyed').parent().show();
                } else {
                    $('#updateEventHarvested').parent().hide(); // Hide harvested input field
                    $('#updateEventDestroyed').parent().hide(); // Hide destroyed input field
                    // $('#eventdestroyed').parent().hide();
                    // $('#eventharvested').parent().hide();
                }
            }

            // Initial visibility based on the status value
            updateVisibility($('#updatestatus').val());

            // Event listener for status change
            $('#updatestatus').change(function() {
                
                var status = $(this).val();
                updateVisibility(status); // Update visibility based on the new status
            });
        });

        $(document).ready(function() {
            var eventType = $('#eventtype').text().trim();// Example status, replace with actual value
            if (eventStatus === 'Planted') {
                $('.hide-if-planted').hide();
            } else {
                $('.hide-if-planted').show();
            }
        });



      
    </script>



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @include('templates.footer')