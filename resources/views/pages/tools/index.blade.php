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
                                    @if(isset($tools) && count($tools) > 0)
                                    @foreach($tools as $key => $tool)
                                    <tbody id="farmTableBody" class="list form-check-all">
                                        <tr class="farm-row {{ strtolower(str_replace(' ', '-', $farm->status)) }}">
                                            <td class=" roboto-regular" style="text-align: left;">
                                                <div class="id" style="margin-bottom: 5px;">#{{ $tool->id }}</div>
                                                <hr style="margin: 10px 0;">
                                                <b style="font-size: 14px;">Date Filed: </b><br>
                                                <div>{{ \Carbon\Carbon::parse($farm->created_at)->format('Y-m-d / h:i A') }}</div>
                                            </td>
                                            <td class="details vertical-line">
                                                <b style="color: blue; font-size: 16px;">TOOL REQUEST</b><br>
                                                <span class="farm-leader"> <!-- Add class for farm leader -->
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Farm Leader :</b> &nbsp;{{ strtoupper($farm->farm_leader_firstname) }} {{ strtoupper($farm->farm_leader_lastname) }}<br>
                                                </span>
                                                <span class="farm-name"> <!-- Add class for farm name -->
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Farm Name :</b> &nbsp;
                                                    <span class="farm-name-value">{{ strtoupper($farm->farm_name) }}</span><br>
                                                </span>

                                                <span class="area"> <!-- Add class for area -->
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Area :</b> &nbsp;{{ strtoupper($farm->area) }}<br>
                                                </span>
                                                <span class="address"> <!-- Add class for address -->
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Address :</b> &nbsp;{{ strtoupper($farm->address) }}, {{ strtoupper($farm->barangay_name) }}<br>
                                                </span>
                                            </td>

                                            <td class="status vertical-line">
                                                @switch(strtolower(str_replace(' ', '-', $farm->status)))
                                                @case('for-investigation')
                                                @case('created')
                                                <label class="badge bg-primary" style="font-size: 12px; margin-bottom: 10px; padding: 2px; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @case('for-visiting')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @case('submitted')
                                                @case('visiting')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #FF9843; color: #000;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @case('resubmit')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #747264; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @case('waiting-for-approval')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #FFC107; color: #000;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @case('approved')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #1F7C33; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @case('disapproved')
                                                @case('cancelled')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #990000; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

                                                @break
                                                @default
                                                @endswitch

                                                <br>
                                                <a href="javascript:void(0);" class="btn btn-success btn-border equal-width-validation" style="font-weight: bold;" onclick="showFarmRemarks('{{ $farm->id }}');">Validation Remarks</a>
                                                <br>
                                                <i style="font-size: 13px;">Click "Validation Remarks" for more specific updates</i>
                                            </td>

                                            <td class="actions vertical-line">
                                                @if($farm->status == 'Created' || $farm->status == 'For-Investigation' || $farm->status == 'For-Visiting' || $farm->status == 'Visiting' || $farm->status == 'Waiting-for-Approval' || $farm->status == 'Approved' || $farm->status == 'Submitted' || $farm->status == 'Disapproved' || $farm->status == 'Cancelled')
                                                <div class="centered-container times-new-roman-bold">
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="btn btn-outline-secondary text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn mt-2" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}', '{{ $farm->farm_leader_firstname }}', '{{ $farm->farm_leader_lastname }}'); updateButtonVisibility('{{ $farm->status }}');">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ri-profile-line fs-3 me-2 black"></i>
                                                                    <span class="black">View Application</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                                @if($farm->status == 'Resubmit')
                                                <div class="centered-container times-new-roman-bold">
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Resubmit Application">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="btn btn-outline-info text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn mt-2" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}', '{{ $farm->farm_leader_firstname }}', '{{ $farm->farm_leader_lastname }}'); updateButtonVisibility('{{ $farm->status }}');" style="border-color: #747264;">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ri-profile-line fs-3 me-2 black"></i>
                                                                    <span class="black">Resubmit Application</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                                <div class="centered-container times-new-roman-bold">
                                                    @if($farm->status == 'Created')
                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Cancel Application">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateCancelModal" class="btn btn-outline-danger waves-effect waves-light text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn1 mt-2" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}', '{{ $farm->farm_leader_firstname }}', '{{ $farm->farm_leader_lastname }}'); updateCancel('{{ $farm->id }}')">
                                                            <div class="d-flex align-items-center">
                                                                <i class="mdi mdi-cancel fs-3 me-2 black"></i>
                                                                <span class="black">Cancel Application</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </div>
                                                <div class="centered-container times-new-roman-bold">
                                                    @if($farm->status == 'For-Visiting')
                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Set Date Application">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#SetDateModal" class="btn btn-outline-warning waves-effect waves-light text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center mt-2 btn-custom-width" onclick="setDate('{{ $farm->id }}', '{{ $farm->select_date }}')">
                                                            <div class="d-flex align-items-center">
                                                                <i class="mdi mdi-calendar-check fs-3 me-2 black"></i>
                                                                <span class="black">Set Visit Date</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </div>
                                            </td>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <div id="lordIconContainer" style="text-align: center;"></div>
                                                <p id="noFarmsMessage" style="text-align: center; font-size: 21px;">No Farms found.</p>
                                            </td>
                                        </tr>
                                        @endif


                            </div>

                            </tbody>
                            </table>
                            <br><br>
                        </div>
                        <div id="noFarmsMessageContainer" style="display: none;">
                            <td colspan="7">
                                <div id="lordIconContainer" style="text-align: center;"></div>
                                <p id="noFarmsMessage" style="text-align: center; font-size: 21px;">No Barangays Farms found.</p>
                            </td>
                        </div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Request Farm &nbsp;</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form id="addFarmForm" action="" method="post">
                            @csrf
                            <div class="modal-body">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="farm_name" class="form-label">Farm Name</label>
                                        <input type="text" name="farm_name" class="form-control" title="This field is required to fill up" placeholder="Enter Farm Name" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="farm_leader" class="form-label">Farm Leader</label>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="address" class="form-label"> &nbsp; Address</label>
                                        <input type="text" name="address" class="form-control" title="This field is required to fill up" placeholder="Enter Address" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="area" class="form-label"> &nbsp; Area</label>
                                        <input type="text" name="area" class="form-control" title="This field is required to fill up" placeholder="Enter Area" required />
                                    </div>
                                </div>

                                <div class="file-input-container">
                                    <div class="file-input-wrapper">
                                    <label for="request_letter" class="form-label"> &nbsp; Request Letter</label>
                                    <input type="file" name="request_letter" class="form-control file-input" accept="application/pdf">
                                        <button type="button" class="btn btn-danger cancel-btn" onclick="cancelUpload('request_letter')">Cancel</button>
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