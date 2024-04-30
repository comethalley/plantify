@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Request management</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

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
                                <h5 class="card-title mb-0 title">&nbsp; QC Farm leader dashboard : &nbsp;</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap gap-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: left;">
                            <h4 style="font-size: 20px;"><em><strong>Your dashboard will feature updates regarding the status of your Request, ensuring you stay informed every step of the way.</strong></em></h4>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="row g-3 align-items-center justify-content-between">
                                <div class="col-xxl-2 col-sm-4">
                                    <div class="search-box">
                                        <input type="text" id="searchInput" class="form-control search bg-light border-light" placeholder="Search for Request ID ...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 d-flex justify-content-end">
                                    <div class="hstack flex-wrap gap-2 mb-3 mb-lg-0">
                                        <button class="btn btn-danger addFarms-modal custom-width" data-bs-toggle="modal" data-bs-target="#addfarmModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Request Tool/Seedlings
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
                                        @if(isset($request_tbl) && count($request_tbl) > 0)
                                        @foreach($request_tbl as $key => $request)
                                        <tr class="farm-row {{ strtolower(str_replace(' ', '-', $request->status)) }}">
                                            <td class=" roboto-regular" style="text-align: left;">
                                                <div class="id" style="margin-bottom: 5px;">#{{ $request->id }}</div>
                                                <hr style="margin: 10px 0;">
                                                <b style="font-size: 14px;">Date Filed: </b><br>
                                                <div>{{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d / h:i A') }}</div>
                                            </td>
                                            <td class="details vertical-line">
                                                <b style="color: blue; font-size: 16px;">REQUEST APPLICATION</b><br>
                                                <span class="requested-by">
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Name :</b> &nbsp;{{ strtoupper($request->requested_by_firstname) }} {{ strtoupper($request->requested_by_lastname) }}<br>
                                                </span>
                                                <span class="supply-tool">
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Tool :</b> &nbsp;
                                                    <span class="supply-tool-value">{{ strtoupper($request->supply_tool) }}</span><br>
                                                </span>
                                                <span class="supply-seedling">
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Seedling :</b> &nbsp;
                                                    <span class="supply-seedling-value">{{ strtoupper($request->supply_seedling) }}</span><br>
                                                </span>
                                                <span class="supply-count">
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Seedling Quantity :</b> &nbsp;
                                                    <span class="supply-count-value">{{ strtoupper($request->supply_count) }}</span><br>
                                                </span>
                                            </td>
                                            <td class="status vertical-line">
                                                @switch(strtolower(str_replace(' ', '-', $request->status)))
                                                @case('requested')
                                                @case('available')
                                                <label class="badge bg-primary" style="font-size: 12px; margin-bottom: 10px; padding: 2px; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('unavailable')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('ready-to-be-pick')
                                                @case('picked')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #FF9843; color: #000;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('failed-to-pick')
                                                @case('failed-to-return')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #747264; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('waiting-for-approval')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #FFC107; color: #000;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('approved')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #1F7C33; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('disapproved')
                                                @case('returned')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #990000; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @default
                                                @endswitch
                                                <br>
                                                <a href="javascript:void(0);" class="btn btn-success btn-border equal-width-validation" style="font-weight: bold;" onclick="showRequestRemarks('{{ $request->id }}');">Validation Remarks</a>
                                                <br>
                                                <i style="font-size: 13px;">Click "Validation Remarks" for more specific updates</i>
                                            </td>
                                            <td class="actions vertical-line ">
                                                <div class="centered-container times-new-roman-bold">
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="btn btn-outline-secondary text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn mt-2" onclick="showFarmDetails('{{ $request->id }}', '{{ $request->supply_tool }}');">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ri-profile-line fs-3 me-2 black"></i>
                                                                    <span class="black">View Request Form</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                            </div>
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
                        <h5 class="modal-title" id="exampleModalLabel">Request Supply &nbsp;</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                    </div>
                    <form id="addFarmForm" action="" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="supply_tool" class="form-label">Tools &nbsp;<span class="required-asteroid">*</span></label>
                                    <select id="supply_tool" name="supply_tool" class="form-select" required onchange="toggleFields()">
                                        <option value="">Select Supply Type</option>
                                        @foreach($supplyTools as $id => $type)
                                        <option value="{{ $id }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6" id="dateInputContainer">
                                    <label for="date_return" class="form-label">Date to return &nbsp;<span class="required-asteroid">*</span></label>
                                    <input type="date" class="form-control" title="This field is required to fill up" id="dateInput" name="date_return" min="<?php echo date('Y-m-d'); ?>" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="supply_seedling" class="form-label">Seedlings &nbsp;<span class="required-asteroid">*</span></label>
                                    <select id="supply_seedling" name="supply_seedling" class="form-select" required onchange="toggleFields()">
                                        <option value="">Select Supply Type</option>
                                        @foreach($supplySeedlings as $id => $type)
                                        <option value="{{ $id }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="supply_count" class="form-label"> &nbsp; Quantity &nbsp;<span class="required-asteroid">*</span></label>
                                    <input type="number" name="supply_count" id="supply_count" class="form-control" title="This field is required to fill up" placeholder="Enter Quantity" required />

                                </div>
                            </div>
                            <div class="file-input-container">
                                <div class="file-input-wrapper">
                                    <label for="letter_content" class="form-label"> &nbsp; Request Letter &nbsp;<span class="required-asteroid">*</span></label>
                                    <input type="file" name="letter_content" class="form-control file-input" accept="application/pdf" required />
                                    <button type="button" class="btn btn-danger cancel-btn" title="This field is required to fill up" onclick="cancelUpload('letter_content')">Cancel</button>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="alert alert-danger" style="display:none" id="error-messages"></div>
                        <div class="alert alert-danger" style="display:none" id="error-messages1"></div>

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

        <!-- Modals -->

        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title text-danger font-weight-bold" id="statusModalLabel" style="font-size: 20px;">Status Tags</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <hr>
                        <p class="text-left" style="font-size: 13px;">After submitting the tool or seedling request form.</p>
                        <hr>
                        <p class="text-left">
                            <span class="badge" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">1</span>
                            <span class="badge bg-primary" style="color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Requested</span> -
                            Indicates that a user has made a request for a tool or seedling.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">2</span>
                            <span class="badge" style="background-color: #007BFF; color: #FFF; font-size: 13px; padding-left: 5px; padding-right: 5px;">Available</span> -
                            Denotes that the requested tool or seedling is currently in stock and ready for allocation.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">3</span>
                            <span class="badge" style="background-color: #1F7C33; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Unavailable</span> -
                            The tool or seedling requested isn't in stock, so it can't be allocated now.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">4</span>
                            <span class="badge" style="background-color: #FFC107; color: #000; font-size: 13px; padding-left: 5px; padding-right: 5px;">Waiting for Approval</span> -
                            A pending status for tool or seedling requests under review.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">5</span>
                            <span class="badge" style="background-color: #28a745; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Approved</span> -
                            Official authorization indicating the completion and approval of the request.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">6</span>
                            <span class="badge" style="background-color: #990000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Disapproved</span> -
                            The request has been reviewed and rejected.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">7</span>
                            <span class="badge" style="background-color: #007BFF; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Ready to be Picked</span> -
                            Indicates that the approved tool or seedling is prepared and available for collection.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">8</span>
                            <span class="badge" style="background-color: #007BFF; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Picked</span> -
                            Indicates that the approved tool or seedling has been collected by the requester.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">9</span>
                            <span class="badge" style="background-color: #990000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Failed to Pick</span> -
                            It implies the requester didn't pick up the approved tool or seedling within the given time frame or for some reason.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">10</span>
                            <span class="badge" style="background-color: #28a745; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Returned</span> -
                            Denotes that the collected tool or seedling has been returned to the inventory for any reason.
                        </p>
                        <p class="text-left">
                            <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">11</span>
                            <span class="badge" style="background-color: #990000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Failed to Return</span> -
                            It suggests the user didn't return the borrowed item on time or returned it damaged.
                        </p>
                        <hr>
                        <a role="button" class="btn btn-outline-dark btn-block" style="width: 30%; float: right" data-bs-dismiss="modal" aria-label="Close">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->

        <div class="modal fade" id="remarkModals" tabindex="-1" aria-labelledby="remarkModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title text-danger font-weight-bold" id="remarkModalLabel">Application Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <h5 class="font-weight-bold">Request's Evaluation Thread</h5>
                        <br>
                        <div id="records-container"></div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,800;1,800&display=swap" rel="stylesheet">

        <script>
            function showRequestRemarks(id) {
                fetch(`/request/${id}/details`)
                    .then(response => response.json())
                    .then(data => {
                        var modalBody = document.getElementById('modal-body');
                        modalBody.innerHTML = '';

                        var header = document.createElement('h5');
                        header.className = 'font-weight-bold';
                        header.innerText = "Request's Evaluation Thread";
                        modalBody.appendChild(header);

                        data.remarks.forEach((remark, index) => {
                            var containerWrapper = createContainerWrapper();

                            // Assuming data.created_at and other arrays have the same length
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
                            var statusAndValidatedParagraph = createParagraphs(statusAndValidatedText, true, '17px');
                            containerWrapper.appendChild(statusAndValidatedParagraph);

                            var remarksContainer = createContainer();

                            var validatedByParagraph = createParagraphs(data.validated_by[index], true);

                            var remarkText = remark || "";
                            var visitDateText = data.visit_date[index] ? new Date(data.visit_date[index]).toLocaleDateString('en-US', {
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric'
                            }) : ""; // Format visit date
                            var remarksContent = remarkText;
                            if (visitDateText) {
                                remarksContent += ' at ' + visitDateText;
                            }
                            var remarksParagraph = createParagraphs(remarksContent);

                            remarksContainer.appendChild(validatedByParagraph);
                            remarksContainer.appendChild(remarksParagraph);

                            containerWrapper.appendChild(remarksContainer);

                            modalBody.appendChild(containerWrapper);
                        });

                        var myModal = new bootstrap.Modal(document.getElementById('remarkModals'));
                        myModal.show();
                    })
                    .catch(error => {
                        console.error('Error fetching farm details:', error);
                    });
            }



            function goBack() {
                window.location.href = "/dashboard/analytics";
                window.onload = function() {
                    window.location.reload(true);
                };
            }

            function openStatusModal() {
                $('#statusModal').modal('show');
            }

            function toggleFields() {
                var supplyTool = document.getElementById('supply_tool');
                var supplySeedling = document.getElementById('supply_seedling');
                var supplyCount = document.getElementById('supply_count');

                if (supplyTool.value !== '') {
                    // If supply_tool is selected, make supply_seedling not required
                    supplySeedling.removeAttribute('required');
                    supplyCount.removeAttribute('required');
                } else if (supplySeedling.value !== '') {
                    // If supply_seedling is selected, make supply_tool not required
                    supplyTool.removeAttribute('required');
                    supplyCount.setAttribute('required', 'required');
                } else if (supplyCount.value !== '') {
                    // If supply_seedling is selected, make supply_tool not required
                    supplyTool.removeAttribute('required');
                    supplySeedling.setAttribute('required');
                } else {
                    // If neither is selected, make both required
                    supplyTool.setAttribute('required', 'required');
                    supplySeedling.setAttribute('required', 'required');
                    supplyCount.setAttribute('required', 'required');
                }
            }


            function submitForm() {
                // Hide any previous error messages
                document.getElementById('error-messages').style.display = 'none';
                document.getElementById('error-messages').innerHTML = ''; // Clear existing messages
                document.getElementById('error-messages1').style.display = 'none';
                document.getElementById('error-messages1').innerHTML = ''; // Clear existing messages

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

                // Check if supply_count is not a single 0
                var supplyCountField = document.getElementsByName('supply_count')[0];
                if (supplyCountField.value.trim() === '0') {
                    isValid = false;
                    supplyCountField.classList.add('is-invalid');
                    document.getElementById('error-messages1').style.display = 'block';
                    document.getElementById('error-messages1').innerHTML = '<p>Supply count cannot be 0.</p>';
                    return; // Stop form submission
                }

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
            lordIcon.setAttribute("style", "width:250px;height:250px");
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
                width: 186px;
                height: 38.5px;
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