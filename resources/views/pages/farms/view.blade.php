@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Districts</a></li>
                                <li class="breadcrumb-item active">Farms</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                @if(isset($farms) && count($farms) > 0)
                @foreach($farms as $key => $farm)
                @if($key == 0 || $farm->barangay_name != $farms[$key - 1]->barangay_name)
                <div class="col-lg-12 main-container">
                    <div class="card" id="tasksList">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 title">&nbsp; Farms of :&nbsp; {{ $farm->barangay_name }} &nbsp;</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap gap-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <h4 style="font-size: 20px;"><em><strong>Dear Admin, Please be aware that your dashboard provides updates on application statuses.
                                        <br> While updates may not be instantaneous, your patience and careful evaluation are greatly appreciated during this process.</strong></em></h4>
                        </div>
                        <br>

                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-xxl-2 col-sm-4">
                                    <div class="search-box">
                                        <input type="text" id="searchInput" class="form-control search bg-light border-light" placeholder="Search for Farm ID or Name ...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-sm-3 ms-auto d-flex">
                                    <div class="btn-group" style="width: 200px;">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false">
                                            All
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuClickableOutside">
                                            <li><a class="dropdown-item" href="javascript:void(0);">All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Created</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">For investigation</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">For visiting</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Waiting-for-approval</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Approved</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Resubmit</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Disapproved</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Cancelled</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>



                        <!--end card-body-->
                        <div class="card-body ">
                            <div class="table-responsive table-card mb-4 rounded ">
                                <table class="table align-middle table-nowrap mb-0 custom-table" id="tasksTable">
                                    <thead class="table-light text-muted mb-0 custom-table">
                                        <tr>
                                            <th class="poppins-medium-italic" data-sort="id" style="font-weight: bold; color: black;">Reference ID Number</th>
                                            <th class="poppins-medium-italic" data-sort="farm_name" style="font-weight: bold; color: black;">Details</th>
                                            <th class="poppins-medium-italic" data-sort="area" style="font-weight: bold; color: black;">Status</th>
                                            <th class="poppins-medium-italic" data-sort="address" style="font-weight: bold; color: black;">Actions</th>

                                        </tr>
                                    </thead>
                                    @endif
                                    <tbody id="farmTableBody" class="custom-table list form-check-all">
                                        <tr class="farm-row {{ strtolower(str_replace(' ', '-', $farm->status)) }}">
                                            <td class=" roboto-regular" style="text-align: left;">
                                                <div class="id" style="margin-bottom: 5px;">#{{ $farm->id }}</div>
                                                <hr style="margin: 10px 0;">
                                                <b style="font-size: 14px;">Date Filed: </b><br>
                                                <div>{{ \Carbon\Carbon::parse($farm->created_at)->format('Y-m-d / h:i A') }}</div>
                                            </td>
                                            <td class="details vertical-line">
                                                <b style="color: blue; font-size: 16px;">FARM APPLICATION</b><br>
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

                                            <td class="text-center">
                                                <ul class="list-inline d-flex justify-content-center gap-2 mb-0">
                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="text-primary d-inline-block edit-item-btn" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}', '{{ $farm->farm_leader_firstname }}', '{{ $farm->farm_leader_lastname }}'); updateButtonVisibility('{{ $farm->status }}');" style="border-color: #747264;">
                                                            <i class="ri-profile-line fs-3"></i>
                                                        </a>
                                                    </li>

                                                    &nbsp;
                                                    <!-- Update the "Archive Application" button in your Blade file -->
                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete Application">
                                                        <a href="#" class="text-danger d-inline-block edit-item-btn" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}', '{{ $farm->farm_leader_firstname }}', '{{ $farm->farm_leader_lastname }}'); confirmArchive('{{ $farm->id }}');">
                                                            <i class="ri-archive-line fs-3"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>


                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <!-- Message indicating no farms found -->
                                                <!-- Lord icon -->
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

                <div class="modal fade" id="remarkModals" tabindex="-1" aria-labelledby="remarkModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Add the modal-lg class here -->
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title text-danger font-weight-bold" id="remarkModalLabel">Application Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modal-body">
                                <!-- Content will be dynamically updated here using JavaScript -->
                                <h5 class="font-weight-bold">Farmer's Evaluation Thread</h5>
                                <br>
                                <div id="records-container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header p-2">
                                <h5 class="modal-title text-danger font-weight-bold" id="statusModalLabel" style="font-size: 20px;">Status Tags</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                <p class="text-left" style="font-size: 13px;">After submitting Farm application form.</p>
                                <hr>
                                <p class="text-left">
                                    <span class="badge" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">1</span>
                                    <span class="badge bg-primary" style="color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">For Investigation</span> -
                                    Comprehensive review and assessment of the farming proposal.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">2</span>
                                    <span class="badge" style="background-color: #007BFF; color: #FFF; font-size: 13px; padding-left: 5px; padding-right: 5px;">For Visiting</span> -
                                    Authorized personnel will set a date for an on-site inspection of farms to assess operations.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">3</span>
                                    <span class="badge" style="background-color: #1F7C33; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Approved</span> -
                                    Official authorization indicating the completion and approval of the process.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">4</span>
                                    <span class="badge" style="background-color: #990000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Disapproved</span> -
                                    The application had been rejected and no further process is possible.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">5</span>
                                    <span class="badge" style="background-color: #FFC107; color: #000; font-size: 13px; padding-left: 5px; padding-right: 5px;">Waiting for Approval</span> -
                                    A pending status for proposals under review.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">4</span>
                                    <span class="badge" style="background-color: #990000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Cancelled</span> -
                                    The application has been cancelled, resulting in the rejection of proposed actions or plans.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">6</span>
                                    <span class="badge" style="background-color: #747264; font-size: 13px; padding-left: 5px; padding-right: 5px; ">Resubmit</span> -
                                    To revise and submit the necessary compilation.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">7</span>
                                    <span class="badge" style="background-color: #FF9843; color: #000; font-size: 13px; padding-left: 5px; padding-right: 5px; ">Submitted</span> -
                                    The application has successfully passed compilation and is awaiting to evaluate.
                                </p>
                                <p class="text-left">
                                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">8</span>
                                    <span class="badge" style="background-color: #FF9843; color: #000; font-size: 13px; padding-left: 5px; padding-right: 5px; ">Visiting</span> -
                                    Application has been processed and dates have been set.
                                </p>
                                <hr>
                                <a role="button" class="btn btn-outline-dark btn-block" style="width: 30%; float: right" data-bs-dismiss="modal" aria-label="Close">Close</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="archiveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="archiveConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary p-3">
                                <h5 class="modal-title" id="archiveConfirmationModalLabel" style="color: white; font-size: 20px;">Delete Farm Application Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to Delete this farm?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="archiveFarmBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bgtitle p-3">
                                <h5 class="modal-title" id="confirmationModalLabel" style="color: white; font-size: 20px;">Confirmation Remarks</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Type your remarks update below</h5>
                                <div class="form-floating">
                                    <textarea class="form-control" name="remarks" rows="3" style="height: 150px;" placeholder="Enter your remarks..."></textarea>
                                    <label for="remarkstext">-Optional-</label>
                                </div>
                                <br>
                                <div class="mb-3" id="dateInputContainer" style="display: none;">
                                    <label for="dateInput" class="form-label">Select Date:</label>
                                    <input type="date" class="form-control" id="dateInput" name="select_date" min="<?php echo date('Y-m-d'); ?>">
                                </div>

                                <h5>Are you sure you want to update the status?</h5>
                            </div>
                            <div class="modal-footer vstack gap-2">
                                <button type="button" class="btn btn-primary wider-btn" id="confirmUpdateBtn">Confirm</button>
                                <button type="button" class="btn btn-outline-secondary wider-btn" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->

                <div class="modal fade modal-lg" id="viewModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-2">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: white; font-size: 24px;">Farm Details</h5>
                                <h4 id="status_modal" style="color: white; font-size: 18px;"></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <!-- Status -->
                                        <label for="farm_name_modal" class="form-label custom-label">Farm Name:</label>
                                        <input type="text" id="farm_name_modal" class="form-control" disabled placeholder="Farm Name">
                                        <br>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Farm Information -->
                                            <label for="farm_leader_modal" class="form-label custom-label">Farm Leader:</label>
                                            <input type="text" id="farm_leader_modal" class="form-control" disabled placeholder="Farm Leader">
                                            <br>
                                            <label for="address_modal" class="form-label custom-label">Address:</label>
                                            <input type="text" id="address_modal" class="form-control" disabled placeholder="Title of Land">
                                            <br>

                                            <div class="list-group-item nested-2">
                                                <i class="mdi mdi-folder fs-16 align-middle text-warning me-2"></i> Picture of land (Images)
                                                <div class="list-group nested-list nested-sortable">
                                                    <div class="list-group-item nested-4">
                                                        <i class="mdi mdi-image fs-16 align-middle text-info me-2"></i>
                                                        <a id="picture_land_modal" href="#" target="_blank" class="pdf-link"></a>
                                                    </div>
                                                    <div class="list-group-item nested-3">
                                                        <i class="mdi mdi-image fs-16 align-middle text-info me-2"></i>
                                                        <a id="picture_land_modal1" href="#" target="_blank" class="pdf-link"></a>
                                                    </div>
                                                    <div class="list-group-item nested-3">
                                                        <i class="mdi mdi-image fs-16 align-middle text-info me-2"></i>
                                                        <a id="picture_land_modal2" href="#" target="_blank" class="pdf-link"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Additional Information -->
                                            <label for="barangay_name_modal" class="form-label custom-label">Barangay Name:</label>
                                            <input type="text" id="barangay_name_modal" class="form-control" disabled placeholder="Barangay Name">
                                            <br>
                                            <label for="area_modal" class="form-label custom-label">Area:</label>
                                            <input type="text" id="area_modal" class="form-control" disabled placeholder="Area">
                                            <br>

                                            <div class="list-group-item nested-2">
                                                <i class="mdi mdi-folder fs-16 align-middle text-warning me-2"></i> Title of land (PDF)
                                                <div class="list-group nested-list nested-sortable">
                                                    <div class="list-group-item nested-3">
                                                        <i class="bx bxs-file-pdf fs-16 align-middle text-danger me-2"></i>
                                                        <a id="title_land_modal" href="#" target="_blank" class="pdf-link">
                                                            View PDF for Farm <span id="farm_id_placeholder"></span> - <span id="title_land_placeholder"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional row with buttons -->
                                    <div class="row mt-3 ">
                                        <!-- For Investigation and For Visiting buttons -->
                                        <div class="col-md-4">
                                            <a href="#" class="text-primary d-inline-block edit-item-btn text-start" id="forInvestigationBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-farm-id="your-farm-id" data-status="For-Investigation" onclick="updateStatus('For-Investigation')">
                                                <button id="forInvestigationBtn" class="farm-btn btn btn-primary btn-label waves-effect waves-light equal-width-btn equal-height-btn">
                                                    <i class="ri-search-eye-line label-icon align-middle fs-16 me-2"></i>For Investigation
                                                </button>
                                            </a>
                                        </div>

                                        <!-- For Visiting button -->
                                        <div class="col-md-4">
                                            <a href="#" class="text-primary d-inline-block edit-item-btn" id="forVisitingBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-farm-id="your-farm-id" data-status="For-Visiting" onclick="updateStatus('For-Visiting')">
                                                <button id="forVisitingBtn" class="farm-btn btn btn-secondary btn-label waves-effect waves-light equal-width-btn1 equal-height-btn">
                                                    <i class="ri-gps-fill label-icon align-middle fs-16 me-2"></i>For Visiting
                                                </button>
                                            </a>
                                        </div>

                                        <!-- Approved button -->
                                        <div class="col-md-4">
                                            <a href="#" class="text-primary d-inline-block edit-item-btn" id="approvedBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-farm-id="your-farm-id" data-status="Approved" onclick="updateStatus('Approved')">
                                                <button id="approvedBtn" class="farm-btn btn btn-success btn-label waves-effect waves-light equal-width-btn6 equal-height-btn">
                                                    <i class="ri-check-line label-icon align-middle fs-16 me-2"></i>Approved
                                                </button>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Additional row for other buttons -->
                                    <div class="row mt-3">
                                        <!-- Disapproved button -->
                                        <div class="col-md-4">
                                            <a href="#" class="text-primary d-inline-block edit-item-btn" id="disapprovedBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-farm-id="your-farm-id" data-status="Disapproved" onclick="updateStatus('Disapproved')">
                                                <button id="disapprovedBtn" class="farm-btn btn btn-danger btn-label waves-effect waves-light equal-width-btn3 equal-height-btn">
                                                    <i class="ri-close-line label-icon align-middle fs-16 me-2"></i>Disapproved
                                                </button>
                                            </a>
                                        </div>

                                        <!-- Waiting-for-approval button -->
                                        <div class="col-md-4">
                                            <a href="#" class="text-primary d-inline-block edit-item-btn" id="waitingForApprovalBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-farm-id="your-farm-id" data-status="Waiting-for-Approval" onclick="updateStatus('Waiting-for-Approval')">
                                                <button id="waitingForApprovalBtn" class="farm-btn btn btn-warning btn-label waves-effect waves-light equal-width-btn4 equal-height-btn">
                                                    <i class="ri-time-fill label-icon align-middle fs-16 me-2"></i>Waiting for Approval
                                                </button>
                                            </a>
                                        </div>

                                        <!-- Resubmit button -->
                                        <div class="col-md-4">
                                            <a href="#" class="text-primary d-inline-block edit-item-btn" id="resubmitBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-farm-id="your-farm-id" data-status="Resubmit" onclick="updateStatus('Resubmit')">
                                                <button id="resubmitBtn" class="farm-btn btn btn-info btn-label waves-effect waves-light equal-width-btn5 equal-height-btn">
                                                    <i class="ri-refresh-line label-icon align-middle fs-16 me-2"></i>Resubmit
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>

                <script>
                    function showFarmRemarks(id) {
                        // Fetch farm details from the server
                        fetch(`/farm/${id}/details`)
                            .then(response => response.json())
                            .then(data => {
                                // Update modal content
                                var modalBody = document.getElementById('modal-body');

                                // Clear existing content
                                modalBody.innerHTML = '';

                                // Add a header
                                var header = document.createElement('h5');
                                header.className = 'font-weight-bold';
                                header.innerText = "Farmer's Evaluation Thread";
                                modalBody.appendChild(header);

                                data.remarks.forEach((remark, index) => {
                                    // Create a wrapper container with border, padding, and box-shadow
                                    var containerWrapper = createContainerWrapper();

                                    // For bold text (remark_status)
                                    var date = new Date(data.created_at[index]);
                                    var formattedDate = date.toLocaleDateString('en-US', {
                                        year: 'numeric',
                                        month: 'numeric',
                                        day: 'numeric'
                                    });
                                    var formattedTime = date.toLocaleTimeString('en-US', {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });

                                    var statusAndValidatedText = 'Status: <strong style="font-family: \'Roboto Condensed\', sans-serif;">' + data.remark_status[index] + '</strong><br> Processed By: <span style="font-family: \'Roboto \', sans-serif; font-weight: 200;">' + data.validated_by[index] + '</span><span style="float: right;">' + formattedDate + ' / ' + formattedTime + '</span>';
                                    var statusAndValidatedParagraph = createParagraphss(statusAndValidatedText, true, '17px'); // Specify the font size
                                    containerWrapper.appendChild(statusAndValidatedParagraph);

                                    // Create a container for "Remarks" with border, padding, light gray background, light black font color, and updated box-shadow
                                    var remarksContainer = createContainer();

                                    // Create a paragraph for "Validated By"
                                    var validatedByParagraph = createParagraphs(data.validated_by[index], true);

                                    var remarkText = remark || ""; // If remark is null or undefined, assign an empty string
                                    var visitDateText = data.visit_date[index] ? new Date(data.visit_date[index]).toLocaleDateString('en-US', {
                                        month: 'long',
                                        day: 'numeric',
                                        year: 'numeric'
                                    }) : ""; // Format visit date
                                    var remarksContent = remarkText;
                                    if (visitDateText) {
                                        remarksContent += ' at ' + visitDateText;
                                    }
                                    var remarksParagraph = createParagraph(remarksContent);

                                    // Append both paragraphs to the remarksContainer
                                    remarksContainer.appendChild(validatedByParagraph);
                                    remarksContainer.appendChild(remarksParagraph);

                                    // Add the remarksContainer to the containerWrapper
                                    containerWrapper.appendChild(remarksContainer);

                                    // Add the containerWrapper to the modal body
                                    modalBody.appendChild(containerWrapper);
                                });


                                // Show the modal
                                var myModal = new bootstrap.Modal(document.getElementById('remarkModals'));
                                myModal.show();
                            })
                            .catch(error => {
                                console.error('Error fetching farm details:', error);
                            });

                        // Function to create a wrapper container
                        function createContainerWrapper() {
                            var containerWrapper = document.createElement('div');
                            containerWrapper.classList.add('rounded-border', 'status-validated-container'); // Add classes for rounded border and box-shadow
                            return containerWrapper;
                        }

                        // Function to create a container for "Remarks"
                        function createContainer() {
                            var remarksContainer = document.createElement('div');
                            remarksContainer.classList.add('inner-container'); // Add a class for styling inner container
                            return remarksContainer;
                        }

                        // Function to create a paragraph element
                        function createParagraph(text) {
                            var paragraph = document.createElement('p');
                            paragraph.innerText = text;
                            return paragraph;
                        }
                        // Function to create a paragraph element
                        function createParagraphs(text, isBold) {
                            var paragraph = document.createElement('p');
                            paragraph.innerText = text;
                            if (isBold) {
                                paragraph.style.fontWeight = 'bold';
                            }
                            return paragraph;
                        }

                        function createParagraphss(htmlContent, isBold, fontSize) {
                            var paragraph = document.createElement('p');
                            paragraph.innerHTML = htmlContent;

                            if (isBold) {
                                paragraph.classList.add('roboto-condensed-font', 'bold');
                            } else {
                                paragraph.classList.add('roboto-condensed-font');
                            }

                            if (fontSize) {
                                paragraph.style.fontSize = fontSize;
                            }

                            // Set margin properties
                            paragraph.style.marginTop = '10px';
                            paragraph.style.marginBottom = '0';

                            return paragraph;
                        }


                    }

                    function openStatusModal() {
                        $('#statusModal').modal('show');
                    }
                    $(document).ready(function() {
                        // Function to handle search
                        $('#searchInput').on('input', function() {
                            var searchText = $(this).val().trim().toLowerCase(); // Get search text and convert to lowercase
                            var resultsCount = 0; // Initialize count of matching results
                            // Loop through each row in the table body
                            $('#farmTableBody tr').each(function() {
                                var idText = $(this).find('.id').text().toLowerCase(); // Get text of farm id column
                                var farmNameText = $(this).find('.farm-name-value').text().trim().toLowerCase(); // Get text of farm name value
                                // Define regular expression pattern to match either Farm ID or Farm Name containing the search query
                                var pattern = new RegExp(searchText, 'i');
                                // Check if search text matches Farm ID exactly or if Farm Name contains the search text
                                if (pattern.test(idText) || pattern.test(farmNameText)) {
                                    $(this).show(); // Show row if search text matches
                                    resultsCount++; // Increment count of matching results
                                } else {
                                    $(this).hide(); // Otherwise, hide the row
                                }
                            });

                            // Show or hide the "No Farms found" message container based on the count of matching results
                            if (resultsCount === 0 && searchText.length > 0) {
                                $('#noFarmsMessageContainer').show(); // Show message container if there are no matching results
                            } else {
                                $('#noFarmsMessageContainer').hide(); // Otherwise, hide the message container
                            }
                        });
                    });

                    function goBack() {
                        window.location.href = "/Farms-District-5";
                        window.onload = function() {
                            window.location.reload(true);
                        };
                    }

                    // Function to update the status buttons visibility in the modal
                    function updateButtonVisibility(status) {
                        console.log('Updating button visibility for status:', status);

                        // Check if status is defined
                        if (typeof status !== 'undefined') {
                            // Show all buttons by default
                            $('#forInvestigationBtn, #forVisitingBtn, #approvedBtn, #disapprovedBtn, #waitingForApprovalBtn, #resubmitBtn').show();

                            // Hide specific buttons based on the status
                            switch (status.toLowerCase().replace(/\s+/g, '-')) {
                                case 'created':
                                    // Show "For Investigation" button and hide others
                                    $('#forVisitingBtn, #approvedBtn, #disapprovedBtn, #waitingForApprovalBtn, #resubmitBtn').hide();
                                    break;
                                case 'for-investigation':
                                    // Show "For Visiting", "Disapproved", "Waiting for Approval", "Resubmit" buttons and hide others
                                    $('#forInvestigationBtn, #approvedBtn').hide();
                                    break;
                                case 'for-visiting':
                                    // Show "Approved", "Disapproved", "Waiting for Approval", "Resubmit" buttons and hide others
                                    $('#forInvestigationBtn, #forVisitingBtn').hide();
                                    break;
                                case 'approved':
                                    // Hide all buttons
                                    $('#forInvestigationBtn, #forVisitingBtn, #approvedBtn, #disapprovedBtn, #waitingForApprovalBtn, #resubmitBtn').hide();
                                    break;
                                case 'disapproved':
                                case 'cancelled':
                                    // Show "Resubmit" and "Waiting for Approval" buttons and hide others
                                    $('#forInvestigationBtn, #forVisitingBtn, #approvedBtn, #disapprovedBtn').hide();
                                    break;
                                case 'resubmit':
                                    // Hide only the "Resubmit" button
                                    $(' #resubmitBtn').hide();
                                    break;
                                case 'waiting-for-approval':
                                    // Hide only the "Resubmit" button
                                    $(' #waitingForApprovalBtn').hide();
                                    break;
                            }
                        } else {
                            console.error('Status is undefined.');
                        }
                    }

                    // Function to show farm details in the modal
                    function showFarmDetails(id, farmName, barangayName, area, address, farmLeader, status, titleLand, pictureLand, pictureLand1, pictureLand2, farmLeaderFirstName, farmLeaderLastName) {
                        // Switch based on the lowercased, hyphenated status
                        switch (status.toLowerCase().replace(/\s+/g, '-')) {
                            case 'for-investigation':
                            case 'created':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge bg-primary fs-5');
                                $('#viewModals .modal-header').removeClass().addClass('modal-header bg-primary p-3');
                                break;
                            case 'for-visiting':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge fs-5')
                                    .css({
                                        'background-color': '#007BFF',
                                        'color': '#FFF'
                                    });;
                                $('#viewModals .modal-header').removeClass().addClass('modal-header p-3')
                                    .css({
                                        'background-color': '#007BFF',
                                        'color': '#FFF'
                                    });;
                                break;
                            case 'resubmit':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge fs-4')
                                    .css({
                                        'background-color': '#747264',
                                        'color': '#FFF'
                                    });;
                                $('#viewModals .modal-header').removeClass().addClass('modal-header p-3')
                                    .css({
                                        'background-color': '#747264',
                                        'color': '#FFF'
                                    });;
                                break;
                            case 'waiting-for-approval':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge fs-5')
                                    .css({
                                        'background-color': '#FFC107',
                                        'color': '#FFF'
                                    });;
                                $('#viewModals .modal-header').removeClass().addClass('modal-header p-3')
                                    .css({
                                        'background-color': '#FFC107',
                                        'color': '#FFF'
                                    });;
                                break;
                            case 'approved':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge fs-5')
                                    .css({
                                        'background-color': '#1F7C33',
                                        'color': '#FFF'
                                    });;
                                $('#viewModals .modal-header').removeClass().addClass('modal-header p-3')
                                    .css({
                                        'background-color': '#1F7C33',
                                        'color': '#FFF'
                                    });;
                                break;
                            case 'disapproved':
                            case 'cancelled':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge fs-5')
                                    .css({
                                        'background-color': '#990000',
                                        'color': '#FFF'
                                    });;
                                $('#viewModals .modal-header').removeClass().addClass('modal-header p-3')
                                    .css({
                                        'background-color': '#990000',
                                        'color': '#FFF'
                                    });;
                                break;
                            case 'submitted':
                            case 'visiting':
                                $('#status_modal').html('(' + status + ')')
                                    .removeClass().addClass('badge fs-5')
                                    .css({
                                        'background-color': '#FF9843',
                                        'color': '#FFF'
                                    });;
                                $('#viewModals .modal-header').removeClass().addClass('modal-header p-3')
                                    .css({
                                        'background-color': '#FF9843',
                                        'color': '#FFF'
                                    });;
                                break;
                            default:
                                $('#status_modal').html('(' + status + ')').removeClass().addClass('status status-' + status.toLowerCase().replace(/\s+/g, '-') + ' btn btn-no-shadow');
                                $('#viewModals .modal-header').removeClass(); // Reset to default modal header style
                        }
                        // Set values for other fields
                        $('#farm_name_modal').val(farmName);
                        $('#barangay_name_modal').val(barangayName);
                        $('#area_modal').val(area);
                        $('#address_modal').val(address);
                        $('#farm_leader_modal').val(farmLeaderFirstName + ' ' + farmLeaderLastName);

                        $('#title_land_modal')
                            .attr('href', "/view-pdf/" + id)
                            .attr('target', '_blank')
                            .text('View PDF for Farm ' + id);

                        $('#picture_land_modal')
                            .attr('href', "/view-image/" + id)
                            .attr('target', '_blank')
                            .text('View IMG for Farm ' + id);

                        // Check if pictureLand1 has a value before setting the link
                        if (pictureLand1) {
                            $('#picture_land_modal1')
                                .attr('href', "/view-image1/" + id)
                                .attr('target', '_blank')
                                .text('View IMG for Farm ' + id)
                                .parent() // Get the parent div
                                .show(); // Ensure the entire div is visible
                        } else {
                            // Hide the entire div if pictureLand1 has no value
                            $('#picture_land_modal1').parent().hide();
                        }

                        // Check if pictureLand2 has a value before setting the link
                        if (pictureLand2) {
                            $('#picture_land_modal2')
                                .attr('href', "/view-image2/" + id)
                                .attr('target', '_blank')
                                .text('View IMG for Farm ' + id)
                                .parent() // Get the parent div
                                .show(); // Ensure the entire div is visible
                        } else {
                            // Hide the entire div if pictureLand2 has no value
                            $('#picture_land_modal2').parent().hide();
                        }

                        // Update the status buttons in the modal to include the correct farm ID
                        $('#forInvestigationBtn').data('farm-id', id);
                        $('#forVisitingBtn').data('farm-id', id);
                        $('#approvedBtn').data('farm-id', id);
                        $('#disapprovedBtn').data('farm-id', id);
                        $('#waitingForApprovalBtn').data('farm-id', id);
                        $('#resubmitBtn').data('farm-id', id);

                        // Call the function to disable buttons based on status
                        updateButtonVisibility(status);
                    }

                    var statusToUpdate;
                    var farmIdToUpdate;

                    function updateStatus(newStatus) {
                        // Show confirmation modal before updating status
                        $('#confirmationModal').modal('show');

                        // Store the newStatus in a variable to use it later
                        statusToUpdate = newStatus;

                        // Get the farm ID from the data attribute
                        farmIdToUpdate = $('#forInvestigationBtn').data('farm-id');

                        // Update the label for remarks based on the status
                        if (newStatus === 'Resubmit' || newStatus === 'Disapproved') {
                            $('label[for="remarkstext"]').text('-Required-');
                        } else {
                            $('label[for="remarkstext"]').text('-Optional-');
                        }

                        if (newStatus === 'For-Visiting') {
                            $('#dateInputContainer').show();
                        } else {
                            $('#dateInputContainer').hide();
                        }
                    }
                    // Confirm update status when the user clicks the "Confirm" button in the modal
                    $('#confirmUpdateBtn').on('click', function() {
                        // Hide any previous error messages related to updating status
                        hideValidationError('updateStatus');

                        // Get the remarks value from the input field
                        var remarks = $('textarea[name="remarks"]').val();
                        // Get the selected date from the input field
                        var selectedDate = $('input[name="select_date"]').val();

                        // Check if remarks is required and if it's empty
                        if ($('label[for="remarkstext"]').text() === '-Required-' && remarks.trim() === '') {
                            // Display a validation error below the text box for updating status
                            showValidationError('Remarks is required.', $('textarea[name="remarks"]'), 'updateStatus');
                            return;
                        }

                        // Check if select_date is required and if it's empty
                        if ($('#dateInputContainer').is(':visible') && selectedDate.trim() === '') {
                            // Display a validation error below the calendar input for updating status
                            showValidationError('Select date is required.', $('input[name="select_date"]'), 'updateStatus');
                            return;
                        }

                        // If calendar is not visible, set selectedDate to null
                        if (!$('#dateInputContainer').is(':visible')) {
                            selectedDate = null;
                        }

                        // Perform an AJAX request to update the status and create a new entry in RemarkFarm
                        $.ajax({
                            url: '/update-status/' + farmIdToUpdate,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                status: statusToUpdate,
                                remarks: remarks, // Include remarks in the data sent to the server
                                select_date: selectedDate // Include selected date in the data
                            },
                            success: function(data) {
                                // Handle success response
                                console.log('Status updated successfully');
                                location.reload();
                            },
                            error: function(error) {
                                // Handle error response
                                console.log('Error updating status:', error);
                                // Display a generic error message or handle it accordingly
                                showValidationError('An error occurred while updating status.', $('#confirmUpdateBtn'), 'updateStatus');
                            }
                        });

                        var statusModal = document.getElementById('status_modal');
                        statusModal.textContent = statusToUpdate;
                        updateButtonVisibility(statusToUpdate.toLowerCase().replace(/\s/g, '-'));

                        // Close the confirmation modal after processing
                        $('#confirmationModal').modal('hide');
                    });

                    // Close error message when modal is closed
                    $('#confirmationModal').on('hidden.bs.modal', function() {
                        hideValidationError('updateStatus');
                    });

                    // Function to show validation error
                    function showValidationError(message, targetElement, context) {
                        // Create a span element for the error message
                        var errorElement = $('<span class="text-danger">' + message + '</span>');

                        // Remove any existing error message for the target element within the specified context
                        $('#' + context + ' .text-danger').remove();

                        // Append the error element below the target element within the specified context
                        targetElement.after(errorElement);
                    }

                    // Function to hide validation error within a specific context
                    function hideValidationError(context) {
                        // Hide error messages within the specified context
                        $('#' + context + ' .text-danger').remove();
                    }





                    function confirmArchive(id) {
                        // Set the farm ID to be archived
                        $("#archiveFarmBtn").data("farm-id", id);
                        // Show the confirmation modal
                        $("#archiveConfirmationModal").modal("show");
                    }

                    // Attach click event to archive button
                    $("#archiveFarmBtn").click(function() {
                        // Get the farm ID from the data attribute
                        var id = $(this).data("farm-id");
                        // Redirect to the archive route
                        window.location.href = "/archive-farm/" + id;
                    });

                    $(document).ready(function() {
                        $('.dropdown-item').click(function() {
                            var status = $(this).text();


                            if (status.toLowerCase() === 'all') {
                                $('.farm-row').show();
                            } else {

                                $('.farm-row').hide();


                                $('.farm-row.' + status.toLowerCase().replace(' ', '-')).show();
                            }

                            $.ajax({
                                url: '/farms/filterByStatus',
                                type: 'GET',
                                data: {
                                    status: status
                                },
                                success: function(data) {

                                    console.log(status);


                                    $('#dropdownMenuClickableOutside').text(status);


                                    if (data.farms.length === 0) {
                                        $('#tableContainer').html('<p>No farms found.</p>');
                                    } else {

                                        $('#tableContainer').html(data.farms);
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        });

                    });
                    // Create the Lord icon dynamically
                    var lordIconContainer = document.getElementById("lordIconContainer");
                    var lordIcon = document.createElement("lord-icon");
                    lordIcon.setAttribute("src", "https://cdn.lordicon.com/anqzffqz.json");
                    lordIcon.setAttribute("trigger", "loop");
                    lordIcon.setAttribute("stroke", "bold");
                    lordIcon.setAttribute("state", "morph-check");
                    lordIcon.setAttribute("style", "width:250px;height:250px"); // Adjust size as needed
                    lordIconContainer.appendChild(lordIcon);
                </script>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                <style>
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

                    .bgtitle {
                        background-color: #E8C872;
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
                        width: 133%;
                    }

                    .equal-width-btn4 {
                        width: 106%;
                    }

                    .equal-width-btn5 {
                        width: 155%;
                    }

                    .equal-width-btn6 {
                        width: 155%;
                    }

                    .equal-height-btn {
                        height: 100%;
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

                    .wider-btn {
                        width: 400px;
                    }

                    #tasksTable th,
                    #tasksTable td {
                        border-right: 1px solid #dee2e6;
                        /* Adjust the color as needed */
                    }

                    #tasksTable th:last-child,
                    #tasksTable td:last-child {
                        border-right: none;
                        /* Remove right border for the last column */
                    }

                    .custom-table {
                        /* Specify your desired border color */
                        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;

                    }

                    .poppins-medium-italic {
                        font-family: "Poppins", sans-serif;
                        font-weight: 500;
                        font-size: 1.3em;
                    }

                    .roboto-regular {
                        font-family: "Roboto", sans-serif;
                        font-weight: 500;
                        font-style: normal;
                        font-size: 1.1em;
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
                </style>
@include('templates.footer')


