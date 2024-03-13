@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Farm Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Barangays</a></li>
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
                                <h5 class="card-title mb-0 title">&nbsp; qc dashboard of :&nbsp; {{ $farm->barangay_name }} &nbsp;</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap gap-2">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form>
                        <h4 style="font-size: 16px;"><em><strong>You will receive an email when the status of your application changes. You may also check back here to see the status of your application.</strong></em></h4>
                        <div class="card-body">
<div class="card-body">
    <div class="row g-3 align-items-center justify-content-between">
        <div class="col-xxl-5 col-sm-12">
            <div class="search-box">
                <!-- Your first search box content here -->
                <!-- Placeholder: Your first search box content here -->
            </div>
        </div>
        <!--end col-->

        <div class="col-xxl-2 col-sm-4">
            <div class="search-box">
                <input type="text" class="form-control search bg-light border-light" placeholder="Search for application or something...">
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
        <!--end col-->

        <div class="col-xxl-3 col-sm-6 d-flex justify-content-end">
            <div class="btn-group" style="width: 200px;">
                <!-- Your dropdown content here -->
                <button class="btn btn-light dropdown-toggle me-2" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false">
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

            <div class="hstack flex-wrap gap-2 mb-3 mb-lg-0">
                <button type="button" class="btn btn-soft-dark btn-border refresh-button custom-width" onclick="location.reload()">
                    <span class="icon-on"><i class="ri-refresh-line align-bottom"></i> Refresh</span>
                </button>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>


</form>
                                <!--end card-body-->

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
      @endif
      <tbody id="farmTableBody" class="list form-check-all">
        <tr class="farm-row {{ strtolower(str_replace(' ', '-', $farm->status)) }}">
          <td class="id" style="text-align: left;">
            <div style="margin-bottom: 5px;">#{{ $farm->id }}</div>
            <hr style="margin: 10px 0;">
            <b style="font-size: 14px;">Date Filled: </b><br>
            <div>{{ \Carbon\Carbon::parse($farm->created_at)->format('Y-m-d / h:i A') }}</div>

          </td>

          <td class="details vertical-line">
            <b style="color: blue; font-size: 16px;">FARM APPLICATION</b><br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Farm Leader :</b> &nbsp;{{ strtoupper($farm->farm_leader_firstname) }} {{ strtoupper($farm->farm_leader_lastname) }}<br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Farm Name :</b> &nbsp;{{ strtoupper($farm->farm_name) }}<br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Area :</b> &nbsp;{{ strtoupper($farm->area) }}<br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Address :</b> &nbsp;{{ strtoupper($farm->address) }}, {{ strtoupper($farm->barangay_name) }}<br>
          </td>

          <td class="status vertical-line">
          @switch(strtolower(str_replace(' ', '-', $farm->status)))
    @case('created')
        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
        <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

        @break
    @case('for-investigation')
        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $farm->status }}</label>
        <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>

        @break
    @case('for-visiting')
    @case('resubmit')
        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #B3E0FF; color: #000;" onclick="return false;">{{ $farm->status }}</label>
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

<div class="centered-container times-new-roman-bold">
    @unless($farm->status == 'Cancelled')
        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Cancel Application">
            <a href="#" class="btn btn-outline-danger waves-effect waves-light text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn1 mt-2" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}', '{{ $farm->farm_leader_firstname }}', '{{ $farm->farm_leader_lastname }}'); updateCancel('{{ $farm->id }}')">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-cancel fs-3 me-2 black"></i>
                    <span class="black">Cancel Application</span>
                </div>
            </a>
                                    </li>
                                @endunless
                            </div>
                                            </td>
                                            </td>
                                        </tr>
                                            @endforeach
                                            @else
                                        <tr>
                                    <td colspan="7">
                                <p>No farms found.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>  
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <button class="btn btn-secondary" onclick="goBack()">Back</button>
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


<!-- Your modified modal code -->
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
                    <span class="badge" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;" >1</span>
                    <span class="badge" style="background-color: #007BFF; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">For Investigation</span> -
                    Thorough examination of farming-related issues or processes.
                </p>
                <p class="text-left">
                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">2</span>
                    <span class="badge" style="background-color: #B3E0FF; color: #000; font-size: 13px; padding-left: 5px; padding-right: 5px;">For Visiting</span> -
                    On-site inspection of farms to assess operations.
                </p>
                <!-- Add other status tags as needed -->
                <p class="text-left">
                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">3</span>
                    <span class="badge" style="background-color: #1F7C33; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Approved</span> -
                    Official authorization for proposed actions or plans.
                </p>
                <p class="text-left">
                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">4</span>
                    <span class="badge" style="background-color: #DC3545; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Disapproved</span> -
                    Rejection of proposed actions or plans.
                </p>
                <p class="text-left">
                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">5</span>
                    <span class="badge" style="background-color: #FFC107; font-size: 13px; padding-left: 5px; padding-right: 5px;">Waiting for Approval</span> -
                    A pending status for proposals under review.
                </p>
                <p class="text-left">
                    <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">6</span>
                    <span class="badge" style="background-color: #B3E0FF; font-size: 13px; padding-left: 5px; padding-right: 5px; ">Resubmit</span> -
                    Instruction to revise and resubmit proposals after rejection.
                </p>
                <hr>
                <a role="button" class="btn btn-outline-dark btn-block" style="width: 30%; float: right"data-bs-dismiss="modal" aria-label="Close">Close</a>
            </div>
        </div>
    </div>
</div>

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
                <form id="updateFarmForm" action="" method="post">
                    @csrf
                    <!-- @method('PUT') -->
                <div class="col-md-5">
                <input type="hidden" name="" id="farm_id_modal">
                        <!-- Status -->
                        <label for="farm_name_modal" class="form-label custom-label">Farm name:</label>
                            <input type="text" id="farm_name_modal" name="farm_name" class="form-control" disabled placeholder="Farm Name">
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Farm Information -->
                            <label for="farm_leader_modal" class="form-label custom-label">Farm Leader:</label>
                            <input type="text" id="farm_leader_modal" class="form-control" name="farm_leader" disabled placeholder="Farm Leader">
                            <br>
                            <label for="address_modal" class="form-label custom-label">Address:</label>
                            <input type="text" id="address_modal" class="form-control" name="address" disabled placeholder="Title of Land">
                            <br>

                            <div class="list-group-item nested-2">
                                <i class="mdi mdi-folder fs-16 align-middle text-warning me-2"></i> Picture of land (Images)
                                <div class="list-group nested-list nested-sortable">
                                    <div class="list-group-item nested-3"style="position: relative;">
                                        <i class="mdi mdi-image fs-16 align-middle text-info me-2"></i>
                                        <a id="picture_land_modal" href="#" target="_blank" class="pdf-link"></a>

                                        <button type="button" id='CancelBtnPictureLand'class="btn btn-primary" style="position: absolute; top: 4px; right: 1px;background-color: transparent; border: 1px solid transparent; color: #000; border-radius: 50%;">X</button>

                                    </div>
                                    <div class="list-group-item nested-3" style="position: relative;">
                                        <i class="mdi mdi-image fs-16 align-middle text-info me-2"></i>
                                        <a id="picture_land_modal1" href="#" target="_blank" class="pdf-link"></a>

                                        <button type="button" id='CancelBtnPictureLand1'class="btn btn-primary" style="position: absolute; top: 2px; right: 1px;background-color: transparent; border: 1px solid transparent; color: #000; border-radius: 50%;">X</button>

                                    </div>
                                    <div class="list-group-item nested-3" style="position: relative;">
                                        <i class="mdi mdi-image fs-16 align-middle text-info me-2"></i>
                                        <a id="picture_land_modal2" href="#" target="_blank" class="pdf-link"></a>

                                        <button type="button" id='CancelBtnPictureLand2'class="btn btn-primary" style="position: absolute; top: 2px; right: 1px;background-color: transparent; border: 1px solid transparent; color: #000; border-radius: 50%;">X</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Additional Information -->
                            <label for="barangay_name_modal" class="form-label custom-label">Barangay Name:</label>
                            <input type="text" id="barangay_name_modal" class="form-control" name="barangay_name" disabled placeholder="Barangay Name">
                            <br>
                            <label for="area_modal" class="form-label custom-label">Area:</label>
                            <input type="text" id="area_modal" class="form-control" name="area" disabled placeholder="Area">
                            <br>

                            <div class="list-group-item nested-2">
                                <i class="mdi mdi-folder fs-16 align-middle text-warning me-2"></i> Title of land (PDF)
                                <div class="list-group nested-list nested-sortable">
                                <div class="list-group-item nested-3" style="position: relative;">
                                        <i class="bx bxs-file-pdf fs-16 align-middle text-danger me-2"></i>
                                        <a id="title_land_modal" href="#" target="_blank" class="pdf-link">
                                            View PDF for Farm <span id="farm_id_placeholder"></span> - <span id="title_land_placeholder"></span>
                                        </a>

                                        <!-- Circular Button in the right end corner with upper margin and circular border -->
                                        <button type="button" id='CancelBtnTitleLand'class="btn btn-primary" style="position: absolute; top: 2px; right: 1px; background-color: transparent; border: 1px solid transparent; color: #000; border-radius: 50%;">X</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional row with buttons -->
                    <div class="row mt-3 ">
                        <!-- For Investigation and For Visiting buttons -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Close</button>
                        <button type="button" id="updateConfirmButton" class="btn btn-danger" onclick="submitUpdateForm()">Update</button>

                    </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
<div class="modal fade" id="updateCancelModal" tabindex="-1" role="dialog" aria-labelledby="updateCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header p-4">
                <h5 class="modal-title" id="updateCancelModalLabel">Cancellation of Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">

                    <div class="modal-body" style="color: red; text-align: center;">
                        Are you sure you want to Cancel your Application?
                    </div>
                <hr>
            <div class="modal-footer">
                    <!-- No Button with custom text -->
                    <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Close</button>

                    <!-- Yes Button with custom text -->
                    <button type="button" class="btn btn-danger" id="updateStatusBtn">Yes, Cancel it</button>

            </div>
        </div>
    </div>
</div>



<!-- Add this modal at the end of your Blade file -->


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,800;1,800&display=swap" rel="stylesheet">

<script>

function goBack() {
        window.location.href = "/farms3";
        window.onload = function() {
            window.location.reload(true);
        };
    }
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

                // Loop through each record and create separate containers for each type of data
                data.remarks.forEach((remark, index) => {
                    // Create a wrapper container with border, padding, and box-shadow
                    var containerWrapper = createContainerWrapper();

                    // For bold text (remark_status)
                    var date = new Date(data.created_at[index]);
                    var formattedDate = date.toLocaleDateString('en-US', { year: 'numeric', month: 'numeric', day: 'numeric' });
                    var formattedTime = date.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

                    var statusAndValidatedText = 'Status: <strong style="font-family: \'Roboto Condensed\', sans-serif;">' + data.remark_status[index] + '</strong><br> Processed By: <span style="font-family: \'Roboto \', sans-serif; font-weight: 200;">' + data.validated_by[index] + '</span><span style="float: right;">' + formattedDate + ' / ' + formattedTime + '</span>';
                    var statusAndValidatedParagraph = createParagraphss(statusAndValidatedText, true, '17px'); // Specify the font size
                    containerWrapper.appendChild(statusAndValidatedParagraph);




                    // Create a container for "Remarks" with border, padding, light gray background, light black font color, and updated box-shadow
                    var remarksContainer = createContainer();

                    // Create a paragraph for "Validated By"
                    var validatedByParagraph = createParagraphs(data.validated_by[index], true);

                    // Create a paragraph for "Remarks" without bold font
                    var remarksParagraph = createParagraph(remark);

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

    function submitUpdateForm() {
    // Get the form data
    var form = document.getElementById('updateFarmForm');
    var formData = new FormData(form);
    var id = document.getElementById('farm_id_modal').value;

    console.log(id);
    fetch('/update-farms/' + id, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response data here
        console.log(data);
        location.reload();  // Corrected typo here
    })
    .catch(error => console.error('Error:', error));
}

    function updateButtonVisibility(status) {
    console.log('Updating button visibility for status:', status);

    // Check if status is defined
    if (typeof status !== 'undefined') {
        // Show all buttons by default
        $('#forInvestigationBtn, #forVisitingBtn, #approvedBtn, #disapprovedBtn, #waitingForApprovalBtn, #updateConfirmButton, #CancelBtnTitleLand, #CancelBtnPictureLand, #CancelBtnPictureLand1, #CancelBtnPictureLand2').show();

        // Hide specific buttons based on the status
        switch (status.toLowerCase().replace(/\s+/g, '-')) {
            case 'created':
            case 'for-investigation':
            case 'for-visiting':
            case 'approved':
            case 'disapproved':
            case 'cancelled':
            case 'waiting-for-approval':
                $('#forInvestigationBtn, #forVisitingBtn, #approvedBtn, #disapprovedBtn, #waitingForApprovalBtn, #updateConfirmButton, #CancelBtnTitleLand, #CancelBtnPictureLand, #CancelBtnPictureLand1, #CancelBtnPictureLand2').hide();
                break;
            case 'resubmit':
                // Hide only the "Resubmit" button
                $('#forInvestigationBtn, #forVisitingBtn, #approvedBtn, #disapprovedBtn, #waitingForApprovalBtn').hide();
                break;
        }
    } else {
        console.error('Status is undefined.');
    }
}
// Function to show farm details in the modal
function showFarmDetails(id, farmName, barangayName, area, address, farmLeader, status, titleLand, pictureLand, pictureLand1, pictureLand2, farmLeaderFirstName, farmLeaderLastName) {
    // Switch based on the lowercased, hyphenated status
// Assuming status is already defined

switch (status.toLowerCase().replace(/\s+/g, '-')) {
    case 'for-investigation':
    case 'created':
        $('#status_modal').html('(' + status + ')')
            .removeClass().addClass('badge bg-primary fs-5');
        $('#viewModals .modal-header').removeClass().addClass('modal-header bg-primary p-3');
        // Add the 'disabled' attribute to inputs when status is not 'for-visiting' or 'resubmit'
        $('#viewModals input.form-control').attr('disabled', 'disabled');
        $('#viewModals select.form-select').attr('disabled', 'disabled');
        $('#viewModals select#farm_leader_modal').attr('disabled', 'disabled');

        break;
    case 'for-visiting':
        $('#status_modal').html('(' + status + ')')
            .removeClass().addClass('badge bg-primary fs-5');
        $('#viewModals .modal-header').removeClass().addClass('modal-header bg-secondary p-3');
        // Add the 'disabled' attribute to inputs when status is not 'for-visiting' or 'resubmit'
        $('#viewModals input.form-control').attr('disabled', 'disabled');
        $('#viewModals select.form-select').attr('disabled', 'disabled');
        $('#viewModals select#farm_leader_modal').attr('disabled', 'disabled');

        break;
    case 'resubmit':
        $('#status_modal').html('(' + status + ')')
            .removeClass().addClass('badge bg-secondary fs-4');
        $('#viewModals .modal-header').removeClass().addClass('modal-header bg-secondary p-3');
        // Remove the 'disabled' attribute from inputs when status is 'for-visiting' or 'resubmit'
        var dropdownHtml = `
                <div class="input-group">
                    <select id="barangay_name_modal" class="form-select" name="barangay_name">
                        <option value="BagBag">BagBag</option>
                        <option value="Capri">Capri</option>
                        <option value="Fairview">Fairview</option>
                        <option value="Gulod">Gulod</option>
                        <option value="Greater Lagro">Greater Lagro</option>
                        <option value="Kaligayahan">Kaligayahan</option>
                        <option value="Nagkaisang Nayon">Nagkaisang Nayon</option>
                        <option value="North Fairview">North Fairview</option>
                        <option value="Novaliches Proper">Novaliches Proper</option>
                        <option value="Pasong Putik Proper">Pasong Putik Proper</option>
                        <option value="San Agustin">San Agustin</option>
                        <option value="San Bartolome">San Bartolome</option>
                        <option value="Sta. Lucia">Sta. Lucia</option>
                        <option value="Sta. Monica">Sta. Monica</option>
                    </select>
                </div>
            `;
            $('#barangay_name_modal').replaceWith(dropdownHtml);
            
            var farmLeaderDropdownHtml = `
                <div class="input-group">
                    <select id="farm_leader_modal2" class="form-select" name="farm_leader">
                        
                        @foreach ($farmLeaders as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                            
                        @endforeach
                    </select>
                </div>
            `;
            $('#farm_leader_modal').replaceWith(farmLeaderDropdownHtml);

            $('#viewModals select.form-select').removeAttr('disabled');
            $('#viewModals select#farm_leader_modal').removeAttr('disabled');  
            $('#viewModals input.form-control').removeAttr('disabled');
        break;
    case 'waiting-for-approval':
        $('#status_modal').html('(' + status + ')')
            .removeClass().addClass('badge bg-warning fs-5');
        $('#viewModals .modal-header').removeClass().addClass('modal-header bg-warning p-3');
        // Add the 'disabled' attribute to inputs when status is not 'for-visiting' or 'resubmit'
        $('#viewModals input.form-control').attr('disabled', 'disabled');
        $('#viewModals select.form-select').attr('disabled', 'disabled');
        $('#viewModals select#farm_leader_modal').attr('disabled', 'disabled');


        break;
    case 'approved':
        $('#status_modal').html('(' + status + ')')
            .removeClass().addClass('badge bg-success fs-5');
        $('#viewModals .modal-header').removeClass().addClass('modal-header bg-success p-3');
        // Add the 'disabled' attribute to inputs when status is not 'for-visiting' or 'resubmit'
        $('#viewModals input.form-control').attr('disabled', 'disabled');
        $('#viewModals select.form-select').attr('disabled', 'disabled');
        $('#viewModals select#farm_leader_modal').attr('disabled', 'disabled');

        break;
    case 'disapproved':
    case 'cancelled':
        $('#status_modal').html('(' + status + ')')
            .removeClass().addClass('badge bg-danger fs-5');
        $('#viewModals .modal-header').removeClass().addClass('modal-header bg-danger p-3');
        // Add the 'disabled' attribute to inputs when status is not 'for-visiting' or 'resubmit'
        $('#viewModals input.form-control').attr('disabled', 'disabled');
        $('#viewModals select.form-select').attr('disabled', 'disabled');
        $('#viewModals select#farm_leader_modal').attr('disabled', 'disabled');

        break;
    default:
        $('#status_modal').html('(' + status + ')').removeClass().addClass('status status-' + status.toLowerCase().replace(/\s+/g, '-') + ' btn btn-no-shadow');
        $('#viewModals .modal-header').removeClass(); // Reset to default modal header style
        // Add the 'disabled' attribute to inputs when status is not 'for-visiting' or 'resubmit'
        $('#viewModals input.form-control').attr('disabled', 'disabled');
        $('#viewModals select.form-select').attr('disabled', 'disabled');
        $('#viewModals select#farm_leader_modal').attr('disabled', 'disabled');

}

    $('#farm_id_modal').val(id);
    $('#farm_name_modal').val(farmName);
    $('#barangay_name_modal').val(barangayName);
    $('#area_modal').val(area);
    $('#address_modal').val(address);
    $('#farm_leader_modal2').val(farmLeader);
    $('#farm_leader_modal').val(farmLeaderFirstName + ' ' + farmLeaderLastName);

    $('#CancelBtnTitleLand').data('farm-id', id);



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
            .parent()  // Get the parent div
            .show();    // Ensure the entire div is visible
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
            .parent()  // Get the parent div
            .show();    // Ensure the entire div is visible
    } else {
        // Hide the entire div if pictureLand2 has no value
        $('#picture_land_modal2').parent().hide();
    }

    $('#updateConfirmButton').data('farm-id', id);
    updateButtonVisibility(status);
}
$(document).ready(function () {
    var fileInputCanceled = false;

    // Function to reset the changes made by CancelBtnTitleLand
    function resetChanges() {
        $('#title_land_modal, #picture_land_modal, #picture_land_modal1, #picture_land_modal2, #CancelBtnTitleLand, #CancelBtnPictureLand, #CancelBtnPictureLand1, #CancelBtnPictureLand2,  .bx.bxs-file-pdf, .mdi.mdi-image').show();
        $('#title_land_modal, #picture_land_modal, #picture_land_modal1, #picture_land_modal2').parent().find('input[type="file"]').remove();
        fileInputCanceled = false; // Reset the flag
    }

    // Event handler for CancelBtnTitleLand click
    $('#CancelBtnTitleLand').on('click', function () {
        var farmId = $(this).data('farm-id');

        // Hide the existing link, button, and PDF icon
        $('#title_land_modal, #CancelBtnTitleLand, .bx.bxs-file-pdf').hide();

        // Create the file input field and append it to the parent div
        var fileInputHtml = '<input type="file" id="title_land_modal" name="title_land" class="form-control" title="This field is required to fill up" accept=".pdf, .doc, .docx" required />';
        $('#title_land_modal').parent().append(fileInputHtml);
        fileInputCanceled = true; // Set the flag indicating that the file input was canceled

        // Remove the 'required' attribute to allow form submission without the file input
        $('#title_land_modal').removeAttr('required');
    });
    $('#CancelBtnPictureLand').on('click', function () {
        var farmId = $(this).data('farm-id');

        // Hide the existing link, button, and PDF icon
        $('#picture_land_modal, #CancelBtnPictureLand, .mdi.mdi-image').hide();

        // Create the file input field and append it to the parent div
        var fileInputHtml1 = '<input type="file" id="picture_land_modal" name="picture_land" class="form-control" title="This field is required to fill up" accept="image/*" required />';
        $('#picture_land_modal').parent().append(fileInputHtml1);
        fileInputCanceled = true; // Set the flag indicating that the file input was canceled

        // Remove the 'required' attribute to allow form submission without the file input
        $('#picture_land_modal').removeAttr('required');
    });
    $('#CancelBtnPictureLand1').on('click', function () {
        var farmId = $(this).data('farm-id');

        // Hide the existing link, button, and PDF icon
        $('#picture_land_modal1, #CancelBtnPictureLand1, .mdi.mdi-image').hide();

        // Create the file input field and append it to the parent div
        var fileInputHtml2 = '<input type="file" id="picture_land_modal1" name="picture_land1" class="form-control" title="This field is required to fill up" accept="image/*" required />';
        $('#picture_land_modal1').parent().append(fileInputHtml2);
        fileInputCanceled = true; // Set the flag indicating that the file input was canceled

        // Remove the 'required' attribute to allow form submission without the file input
        $('#picture_land_modal1').removeAttr('required');
    });
    $('#CancelBtnPictureLand2').on('click', function () {
        var farmId = $(this).data('farm-id');

        // Hide the existing link, button, and PDF icon
        $('#picture_land_modal2, #CancelBtnPictureLand2, .mdi.mdi-image').hide();

        // Create the file input field and append it to the parent div
        var fileInputHtml3 = '<input type="file" id="picture_land_modal2" name="picture_land2" class="form-control" title="This field is required to fill up" accept="image/*" required />';
        $('#picture_land_modal2').parent().append(fileInputHtml3);
        fileInputCanceled = true; // Set the flag indicating that the file input was canceled

        // Remove the 'required' attribute to allow form submission without the file input
        $('#picture_land_modal2').removeAttr('required');
    });

    // Event handler for modal hidden event
    $('#viewModals').on('hidden.bs.modal', function () {
        // Reset changes when the modal is closed
        if (fileInputCanceled) {
            resetChanges();
        }
    });
});


    

function updateCancel(id) {
    // Set the farm ID to be canceled
    $("#updateStatusBtn").data("farm-id", id);

    // Show the confirmation modal
    $("#updateCancelModal").modal("show");

    // Clear the modal body content for the specific modal
    $("#updateCancelModal .modal-body").empty();

    // Create lord-icon element
    var lordIcon = document.createElement("lord-icon");
    lordIcon.setAttribute("src", "https://cdn.lordicon.com/usownftb.json");
    lordIcon.setAttribute("trigger", "loop");
    lordIcon.setAttribute("state", "loop");
    lordIcon.setAttribute("colors", "primary:#121331,secondary:#c71f16");
    lordIcon.setAttribute("style", "width:170px;height:170px"); // Adjust size as needed

    // Append the lord-icon to a new row in the modal body
    $("#updateCancelModal .modal-body").append("<div class='row'><div class='col text-center'></div></div>");
    $("#updateCancelModal .modal-body .col").append(lordIcon);


    // Append the first message below the icon with red font
    $("#updateCancelModal .modal-body").append("<div class='row'><div class='col text-center'><p style='color: red; font-weight: bold; font-size: 20px;'>You're about to cancel your application</p></div></div>");


    // Append the second message below the first message with black font
    $("#updateCancelModal .modal-body").append("<div class='row'><div class='col text-center'><p style='color: black; font-size: 16px; font-weight: bold; opacity: 0.6;'>Are you sure you want to proceed?</p></div></div>");

}



// Attach click event to update status button
$("#updateStatusBtn").click(function () {
    // Get the farm ID from the data attribute
    var id = $(this).data("farm-id");

    // Send an AJAX request to update the status in the database
    $.ajax({
        url: "/update-farm-status-cancel/" + id,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { status: "Cancel" },
        success: function (response) {
            // Handle the response as needed
            console.log(response);
            
            // Reload the current page after updating the status
            location.reload();
        },
        error: function (error) {
            console.error("Error updating farm status:", error);
        }
    });

    // Close the modal after processing
    $("#updateCancelModal").modal("hide");
});


$(document).ready(function () {
    $('.dropdown-item').click(function () {
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
            data: { status: status },
            success: function (data) {
                
                console.log(status);

                
                $('#dropdownMenuClickableOutside').text(status);

                
                if (data.farms.length === 0) {
                    $('#tableContainer').html('<p>No farms found.</p>');
                } else {
                    
                    $('#tableContainer').html(data.farms);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    
});


</script>
<style>
    .btn-primary:hover {
            background-color: #d3d3d3 !important; /* Light gray background on hover */
    }
    .rounded-border {
        border: 1px solid #ccc;
        border-radius: 10px; /* Adjust the value to control the roundness of the corners */
        padding: 7px; /* Add padding */
        margin-bottom: 15px;
    }

    .inner-container {
        border-radius: 10px;
        border: 1px solid #3C3633;
        padding: 10px;
        background-color: lightgray;
            color: #000; /* Set font color to light black (#000) */
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset; /* Updated box-shadow for Remarks container */
        }
    .status-validated-container {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; /* Box-shadow for Remark Status and Validated By container */
        }
    .black{
        color: black;
    }

    .centered-container {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .custom-btn {
        width:170px;
    }
 .custom-width {
    width: 200px; /* Adjust the width as per your requirement */
}                           
  .table-bordered th,
  .table-bordered td {
    border: 1px solid #ddd; /* Add border for better visibility */
  }
  .vertical-line {
    border-left: 2px solid #ddd; /* Adjust color and size as needed */
  }
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,500&display=swap');    body{
        background-color:#fff;
        font-family: "Roboto",sans-serif;
    }
    .title{
        translate: 10px -30px;
        background-color:#fff;
        border-radius:5px;
        font-size:2em;
        text-transform:uppercase;
        font-weight:700;
    }
    .main-container{
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        border-radius:10px;
    }

    .card-header{
        margin-bottom:3em;
        border:none !important;
    }
    .card{
        border:1px solid #fff;
        box-shadow:none !important;
    }
    table{
        border:2px solid #FFF3CF;
        border-radius:10px !important;
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
    </style> 

@include('templates.footer')