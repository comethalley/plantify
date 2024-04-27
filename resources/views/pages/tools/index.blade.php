@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">tools management</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a></a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 main-container">
                    <div class="card" id="tasksList">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 title">&nbsp; district dashboard : &nbsp;</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap gap-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <h4 style="font-size: 20px;"><em><strong>Your dashboard will feature updates regarding the status of your Request.
                                        <!-- <br> In addition to this, you will also receive email notifications whenever there are changes in the status of your application -->
                                        <!-- <br> or You may also check back here to see the status of your application. -->
                                    </strong></em></h4>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="row g-3 align-items-center justify-content-between">
                                <div class="col-xxl-2 col-sm-4">
                                    <div class="search-box">
                                        <input type="text" id="searchInput" class="form-control search bg-light border-light" placeholder="Search for Farm ID or Name ...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 d-flex justify-content-end">
                                    <div class="hstack flex-wrap gap-2 mb-3 mb-lg-0">
                                        <button class="btn btn-danger addFarms-modal" data-bs-toggle="modal" data-bs-target="#addfarmModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Request Tool
                                        </button>
                                        <button type="button" class="btn btn-soft-dark btn-border refresh-button custom-width" onclick="location.reload()">
                                            <span class="icon-on"><i class="ri-refresh-line align-bottom"></i> Refresh</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="card-body">
                            <div class="table-responsive table-card mb-4 rounded">
                                <table class="table align-middle table-nowrap mb-0 table-bordered" id="tasksTable">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th class="text-center vertical-line" data-sort="id" style="font-weight: bold; color: black;">Reference Number</th>
                                            <th class="text-center vertical-line" style="font-weight: bold; color: black;">Details</th>
                                            <th class="text-center vertical-line" data-sort="status" style="font-weight: bold; color: black;">Status</th>
                                            <th class="text-center vertical-line" data-sort="actions" style="font-weight: bold; color: black;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="farmTableBody" class="list form-check-all">

                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary d-flex align-items-center justify-content-center" onclick="goBack()">
                                    <i class="ri-arrow-left-line me-1"></i> Back
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modals -->

                <div class="modal fade" id="addfarmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Request Supply &nbsp;</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>
                            <form id="addFarmForm" action="" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="supply_type" class="form-label">Tools &nbsp;<span class="required-asteroid">*</span></label>
                                        <select id="supply_type" name="supply_type" class="form-select" required>
                                        <option value="">Select Supply Type</option>
                                        @foreach($supplyTypes as $id => $type)
                                            <option value="{{ $id }}">{{ $type }}</option>
                                        @endforeach
                                    </select>

                                    </div>
                                        <div class="col-md-6" id="dateInputContainer">
                                            <label for="date_return" class="form-label">Date to return &nbsp;<span class="required-asteroid">*</span></label>
                                            <input type="date" class="form-control" title="This field is required to fill up" id="dateInput" name="date_return" min="<?php echo date('Y-m-d'); ?>" required/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="seedlings" class="form-label">Seedlings &nbsp;<span class="required-asteroid">*</span></label>

                                    </div>
                                        <div class="col-md-6">
                                            <label for="supply_count" class="form-label"> &nbsp; Quantity &nbsp;<span class="required-asteroid">*</span></label>
                                            <input type="text" name="supply_count" class="form-control" title="This field is required to fill up" placeholder="Enter Quantity" required />
                                        </div>
                                    </div>

                                    <div class="file-input-container">
                                        <div class="file-input-wrapper">
                                            <label for="letter_content" class="form-label"> &nbsp; Request Letter &nbsp;<span class="required-asteroid">*</span></label>
                                            <input type="file" name="letter_content" class="form-control file-input" accept="application/pdf" required/>
                                            <button type="button" class="btn btn-danger cancel-btn" title="This field is required to fill up" onclick="cancelUpload('letter_content')">Cancel</button>
                                        </div>
                                    </div>

                                    <br>
                                </div>
                                <div class="alert alert-danger" style="display:none" id="error-messages"></div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" onclick="submitForm()">Submit Farm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,800;1,800&display=swap" rel="stylesheet">

                <script>
                    
                    function submitForm() {
    // Hide any previous error messages
    document.getElementById('error-messages').style.display = 'none';
    document.getElementById('error-messages').innerHTML = ''; // Clear existing messages

    // Get form and required fields
    var form = document.getElementById('addFarmForm');
    var requiredFields = form.querySelectorAll('[required]');

    // Check if all required fields are filled
    var isValid = true;
    requiredFields.forEach(function(field) {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid'); // Add a visual cue for the user
        } else {
            field.classList.remove('is-invalid'); // Remove the visual cue if field is filled
        }
    });

    if (!isValid) {
        // If any required field is empty, display error message
        document.getElementById('error-messages').style.display = 'block';
        document.getElementById('error-messages').innerHTML = '<p>Please fill out all required fields.</p>';
        return; // Stop form submission
    }

    // If all required fields are filled, proceed with form submission
    var formData = new FormData(form);

    fetch('{{ route("add.tools") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                document.getElementById('error-messages').style.display = 'block';
                for (var key in data.errors) {
                    document.getElementById('error-messages').innerHTML += '<p>' + data.errors[key][0] + '</p>';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('error-messages').style.display = 'block';
            document.getElementById('error-messages').innerHTML = '<p>An error occurred while processing your request. Please try again later.</p>';
        });
}




                    function cancelUpload(inputName) {
                        $('input[name="' + inputName + '"]').val(null);
                    }

                    var lordIconContainer = document.getElementById("lordIconContainer");
                    var lordIcon = document.createElement("lord-icon");
                    lordIcon.setAttribute("src", "https://cdn.lordicon.com/anqzffqz.json");
                    lordIcon.setAttribute("trigger", "loop");
                    lordIcon.setAttribute("stroke", "bold");
                    lordIcon.setAttribute("state", "morph-check");
                    lordIcon.setAttribute("style", "width:250px;height:250px"); // Adjust size as needed
                    lordIconContainer.appendChild(lordIcon);
                </script>

                <style>
                    .required-asteroid {
                        color: red;
                    }

                    .file-input-container {
                        margin-bottom: 10px;
                    }

                    .file-label {
                        display: inline-block;
                        margin-bottom: 5px;
                    }

                    .file-input-wrapper {
                        position: relative;
                    }

                    .file-input {
                        width: calc(100% - 78px);
                        display: inline-block;
                    }

                    .cancel-btn {
                        position: absolute;
                        right: 0;
                    }

                    .bg-custom {
                        background-color: #747264 !important;
                    }

                    .bg-custom1 {
                        background-color: #1F7C33 !important;
                    }

                    .bg-custom2 {
                        background-color: #990000 !important;
                    }

                    .bg-custom3 {
                        background-color: #FFC107 !important;
                    }

                    .bg-custom4 {
                        background-color: #FF9843 !important;
                    }

                    .btn-primary:hover {
                        background-color: #d3d3d3 !important;
                        /* Light gray background on hover */
                    }

                    .rounded-border {
                        border: 1px solid #ccc;
                        border-radius: 10px;
                        /* Adjust the value to control the roundness of the corners */
                        padding: 7px;
                        /* Add padding */
                        margin-bottom: 15px;
                    }

                    .inner-container {
                        border-radius: 10px;
                        border: 1px solid #3C3633;
                        padding: 10px;
                        background-color: lightgray;
                        color: #000;
                        /* Set font color to light black (#000) */
                        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
                        /* Updated box-shadow for Remarks container */
                    }

                    .status-validated-container {
                        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                        /* Box-shadow for Remark Status and Validated By container */
                    }

                    .black {
                        color: black;
                    }

                    .centered-container {
                        display: flex;
                        justify-content: center;
                        align-items: center;

                    }

                    .custom-btn1 {
                        width: 190px;

                    }

                    .custom-btn {
                        width: 190px;
                    }

                    .custom-width {
                        width: 200px;
                        /* Adjust the width as per your requirement */
                    }

                    .table-bordered th,
                    .table-bordered td {
                        border: 1px solid #ddd;
                        /* Add border for better visibility */
                    }

                    .vertical-line {
                        border-left: 2px solid #ddd;
                        /* Adjust color and size as needed */
                    }

                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,500&display=swap');

                    body {
                        background-color: #fff;
                        font-family: "Roboto", sans-serif;
                    }

                    .title {
                        translate: 10px -30px;
                        background-color: #fff;
                        border-radius: 5px;
                        font-size: 2em;
                        text-transform: uppercase;
                        font-weight: 700;
                    }

                    .main-container {
                        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
                        border-radius: 10px;
                    }

                    .card-header {
                        margin-bottom: 3em;
                        border: none !important;
                    }

                    .card {
                        border: 1px solid #fff;
                        box-shadow: none !important;
                    }

                    table {
                        border: 2px solid #FFF3CF;
                        border-radius: 10px !important;
                    }

                    .equal-width-btn {
                        width: 112%;
                    }

                    .equal-width-btn1 {
                        width: 150%;
                    }

                    .equal-width-btn2 {
                        width: 150%;
                    }

                    .equal-width-btn3 {
                        width: 130%;
                    }

                    .equal-width-btn4 {
                        width: 102%;
                    }

                    .equal-width-btn5 {
                        width: 155%;
                    }

                    .equal-height-btn {
                        height: 100%;
                    }

                    .equal-width-validation {
                        width: 60%;
                    }

                    .status {
                        border-radius: 10px;
                        padding: 15px;
                        width: 200px;
                        text-align: center;
                    }

                    .custom-label {
                        font-size: 1rem;
                    }

                    .btn-custom-width {
                        width: 190px;
                    }
                </style>

                @include('templates.footer')