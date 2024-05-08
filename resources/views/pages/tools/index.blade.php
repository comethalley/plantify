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
                                        <input type="number" id="searchInput" class="form-control search bg-light border-light" placeholder="Search for Request ID ...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 d-flex justify-content-end">
                                    <div class="hstack flex-wrap gap-2 mb-3 mb-lg-0">
                                        <button class="btn btn-danger addFarms-modal custom-width" data-bs-toggle="modal" data-bs-target="#addfarmModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Request
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
                                                    @if($request->supply_tool)
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Tools :</b> &nbsp;
                                                    <span class="supply-tool-value">{{ strtoupper($request->supply_tool) }}</span>
                                                    <span class="count-tool-value">{{ "(" . (empty($request->count_tool) ? '1' : strtoupper($request->count_tool)) . ")" }}</span>
                                                    @if($request->supply_tool1 || $request->supply_tool2)
                                                    ,
                                                    @endif
                                                    <br>
                                                    @endif

                                                    @if($request->supply_tool1)
                                                    <span class="supply-tool1-value">{{ strtoupper($request->supply_tool1) }}</span>
                                                    <span class="count-tool1-value">{{ "(" . (empty($request->count_tool1) ? '1' : strtoupper($request->count_tool1)) . ")" }}</span>
                                                    @if($request->supply_tool2)
                                                    ,
                                                    @endif
                                                    <br>
                                                    @endif

                                                    @if($request->supply_tool2)
                                                    <span class="supply-tool2-value">{{ strtoupper($request->supply_tool2) }}</span>
                                                    <span class="count-tool2-value">{{ "(" . (empty($request->count_tool2) ? '1' : strtoupper($request->count_tool2)) . ")" }}</span>
                                                    <br>
                                                    @endif

                                                </span>
                                                <span class="supply-seedling">
                                                    @if($request->supply_seedling)
                                                    <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Seedlings :</b> &nbsp;
                                                    <span class="supply-seedling-value">{{ strtoupper($request->supply_seedling) }}</span>
                                                    <span class="count-seedling-value">{{ "(" . (empty($request->count_seedling) ? '1' : strtoupper($request->count_seedling)) . ")" }}</span>
                                                    @if($request->supply_seedling1 || $request->supply_seedling2)
                                                    ,
                                                    @endif
                                                    <br>
                                                    @endif

                                                    @if($request->supply_seedling1)
                                                    <span class="supply-seedling1-value">{{ strtoupper($request->supply_seedling1) }}</span>
                                                    <span class="count-seedling1-value">{{ "(" . (empty($request->count_seedling1) ? '1' : strtoupper($request->count_seedling1)) . ")" }}</span>
                                                    @if($request->supply_seedling2)
                                                    ,
                                                    @endif
                                                    <br>
                                                    @endif

                                                    @if($request->supply_seedling2)
                                                    <span class="supply-seedling2-value">{{ strtoupper($request->supply_seedling2) }}</span>
                                                    <span class="count-seedling2-value">{{ "(" . (empty($request->count_seedling2) ? '1' : strtoupper($request->count_seedling2)) . ")" }}</span>
                                                    <br>
                                                    @endif

                                                </span>

                                            </td>
                                            <td class="status vertical-line">
                                                @switch(strtolower(str_replace(' ', '-', $request->status)))
                                                @case('requested')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('available')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #A5DD9B; color: #000;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('unavailable')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #524C42; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('ready-to-be-pick')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #E65C19; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('ready')
                                                @case('picked')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #121481; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('failed-to-pick')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #FA7070; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('failed-to-return')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #C08B5C; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('waiting-for-approval')
                                                @case('waiting-for-return')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #FFC107; color: #000;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('approved')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #28a745; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('disapproved')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #990000; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                <button type="button" class="badge text-wrap text-black-50" style="background-color: #D8D8D6; border: 0;" onclick="openStatusModal()">?</button>
                                                @break
                                                @case('returned')
                                                <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #86469C; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
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
                                                @if($request->status == 'Requested' || $request->status == 'Ready' || $request->status == 'Waiting-for-Return')

                                                <div class="centered-container times-new-roman-bold">
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="btn btn-outline-secondary text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn mt-2" onclick="showRequestDetails('{{ $request->id }}', '{{ $request->supply_tool }}', '{{ $request->supply_tool1 }}', '{{ $request->supply_tool2 }}', '{{ $request->supply_seedling }}', '{{ $request->supply_seedling1 }}', '{{ $request->supply_seedling2 }}', '{{ $request->count_tool }}', '{{ $request->count_tool1 }}', '{{ $request->count_tool2 }}', '{{ $request->count_seedling }}', '{{ $request->count_seedling1 }}', '{{ $request->count_seedling2 }}', '{{ $request->letter_content }}', '{{ $request->requested_by }}', '{{ $request->status }}', '{{ $request->date_return }}', '{{ $request->requested_by_firstname }}', '{{ $request->requested_by_lastname }}');">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ri-profile-line fs-3 me-2 black"></i>
                                                                    <span class="black">View Request Form</span>
                                                                </div>
                                                                @endif
                                                                <div class="centered-container times-new-roman-bold">

                                                                    @if($request->status == 'Ready-to-be-Pick')
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Set Date Application">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#SetDateModal" class="btn btn-outline-warning waves-effect waves-light text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center mt-2 btn-custom-width" onclick="setDate('{{ $request->id }}', '{{ $request->picked_date }}')">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="mdi mdi-calendar-check fs-3 me-2 black"></i>
                                                                    <span class="black">Set Pick Date</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if($request->status == 'Picked')
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Set Date Application">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#SetDateModal1" class="btn btn-outline-warning waves-effect waves-light text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center mt-2 btn-custom-width" onclick="setDateReturn('{{ $request->id }}', '{{ $request->date_return }}')">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="mdi mdi-calendar-check fs-3 me-2 black"></i>
                                                                    <span class="black">Set Return Date</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        @endif
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
                            <div id="lordIconContainer1" style="text-align: center;"></div>
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
                            <div class="col-md-6" style="padding-top: 10px;">
                                <label for="supply_tool" class="form-label">Tools &nbsp;<span class="required-asteroid red-asterisk">*</span></label>
                                <select id="supply_tool" name="supply_tool" class="form-select" style="width: 95%; " required onchange="toggleFields()">
                                    <option value="">Select Tools</option>
                                    @foreach($supplyTools as $id => $type)
                                    <option value="{{ $id }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-end">
                                    <div class="me-2" style="padding-top: 10px;">
                                        <label for="count_tool" class="form-label">Quantity &nbsp;<span class="required-asteroid red-asterisk">*</span></label>
                                        <input type="number" name="count_tool" id="count_tool" class="form-control" style="width: 109px;" title="This field is required to fill up" placeholder="Enter Quantity" required onchange="toggleFields()" />
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6" style="padding-top: 10px;">
                                <label for="supply_seedling" class="form-label">Seedlings &nbsp;<span class="required-asteroid red-asterisk">*</span></label>
                                <select id="supply_seedling" name="supply_seedling" class="form-select" style="width: 95%; " required onchange="toggleFields()">
                                    <option value="">Select Seedlings</option>
                                    @foreach($supplySeedlings as $id => $type)
                                    <option value="{{ $id }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-end">
                                    <div class="me-2" style="padding-top: 10px;">
                                        <label for="count_seedling" class="form-label">Quantity &nbsp;<span class="required-asteroid red-asterisk">*</span></label>
                                        <input type="number" name="count_seedling" id="count_seedling" class="form-control" style="width: 109px;" title="This field is required to fill up" placeholder="Enter Quantity" required onchange="toggleFields()" />
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn1">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="file-input-container">
                            <div class="file-input-wrapper">
                                <label for="letter_content" class="form-label">Request Letter &nbsp;<span class="required-asteroid">*</span></label>
                                <input type="file" name="letter_content" class="form-control file-input" accept="application/pdf" required />
                                <button type="button" class="btn btn-danger cancel-btn" title="This field is required to fill up" onclick="cancelUpload('letter_content')">Remove</button>
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

    <style></style>

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
                        <span class="badge" style="background-color: #007BFF; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Requested</span> -
                        Indicates that a user has made a request for a tool or seedling.
                    </p>
                    <p class="text-left">
                        <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">2</span>
                        <span class="badge" style="background-color: #A5DD9B; color: #FFF; font-size: 13px; padding-left: 5px; padding-right: 5px;">Available</span> -
                        Denotes that the requested tool or seedling is currently in stock and ready for allocation.
                    </p>
                    <p class="text-left">
                        <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">3</span>
                        <span class="badge" style="background-color: #524C42; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Unavailable</span> -
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
                        <span class="badge" style="background-color: #E65C19; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Ready to be Picked</span> -
                        Indicates that the approved tool or seedling is prepared and available for collection.
                    </p>
                    <p class="text-left">
                        <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">8</span>
                        <span class="badge" style="background-color: #121481; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Picked</span> -
                        Indicates that the approved tool or seedling has been collected by the requester.
                    </p>
                    <p class="text-left">
                        <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">9</span>
                        <span class="badge" style="background-color: #FA7070; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Failed to Pick</span> -
                        It implies the requester didn't pick up the approved tool or seedling within the given time frame or for some reason.
                    </p>
                    <p class="text-left">
                        <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">10</span>
                        <span class="badge" style="background-color: #86469C; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Returned</span> -
                        Denotes that the collected tool or seedling has been returned to the inventory for any reason.
                    </p>
                    <p class="text-left">
                        <span class="badge badge-dark" style="background-color: #000; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">11</span>
                        <span class="badge" style="background-color: #C08B5C; color: #fff; font-size: 13px; padding-left: 5px; padding-right: 5px;">Failed to Return</span> -
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
    <div class="modal fade modal-lg" id="viewModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-blue p-2">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; font-size: 24px;">Request Details</h5>
                    <h4 id="status_modal" style="color: white; font-size: 18px;"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="addFarmForm" action="" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="" id="request_id_modal">
                                <div class="col-md-6">
                                    <label for="supply_tool_modal" class="form-label custom-label">Supply Tool:</label>
                                    <input type="text" id="supply_tool_modal" class="form-control" name="supply_tool" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="supply_tool_modal1" class="form-control" name="supply_tool1" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="supply_tool_modal2" class="form-control" name="supply_tool2" disabled placeholder="N/A">
                                    <br>
                                    <label for="supply_seedling_modal" class="form-label custom-label">Supply Seedling:</label>
                                    <input type="text" id="supply_seedling_modal" class="form-control" name="supply_seedling" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="supply_seedling_modal1" class="form-control" name="supply_seedling1" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="supply_seedling_modal2" class="form-control" name="supply_seedling2" disabled placeholder="N/A">
                                    <br>
                                    <div class="list-group-item nested-2">
                                        <i class="mdi mdi-folder fs-16 align-middle text-warning me-2"></i> Content Letter (PDF)
                                        <div class="list-group nested-list nested-sortable">
                                            <div class="list-group-item nested-3" style="position: relative;">
                                                <i class="bx bxs-file-pdf fs-16 align-middle text-danger me-2"></i>
                                                <a id="letter_content_modal" href="#" target="_blank" class="pdf-link" data-name="letter_content">
                                                    View PDF for Request <span id="request_id_placeholder"></span> - <span id="letter_content_placeholder"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity_modal" class="form-label custom-label">Quantity:</label>
                                    <input type="text" id="count_tool_modal" class="form-control" name="count_tool" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="count_tool_modal1" class="form-control" name="count_tool1" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="count_tool_modal2" class="form-control" name="count_tool2" disabled placeholder="N/A">
                                    <br>
                                    <label for="quantity_modal" class="form-label custom-label">Quantity:</label>
                                    <input type="text" id="count_seedling_modal" class="form-control" name="count_seedling" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="count_seedling_modal1" class="form-control" name="count_seedling1" disabled placeholder="N/A">
                                    <br>
                                    <input type="text" id="count_seedling_modal2" class="form-control" name="count_seedling2" disabled placeholder="N/A">
                                    <br>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->

    <div class="modal fade" id="SetDateModal" tabindex="-1" role="dialog" aria-labelledby="SetDateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="SetDateModalLabel">Set Date of Pick</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Select the availability dates to pick-up in your farm.<br><br>

                    <!-- Error message for date selection -->
                    <div id="dateErrorMessage" style="color: red; text-align: center; display: none;">Select dates required</div>
                    <!-- Date selection inputs -->
                    <input type="radio" id="availability1" name="availability" value="option1">
                    <label for="availability1"></label><br>
                    <input type="radio" id="availability2" name="availability" value="option2">
                    <label for="availability2"></label><br>
                    <input type="radio" id="availability3" name="availability" value="option3">
                    <label for="availability3"></label>
                </div>
                <div class="modal-body" style="color: red; text-align: center;">
                    Are you sure you want to Set the date to Pick?
                </div>
                <hr>
                <div class="modal-footer">
                    <!-- No Button with custom text -->
                    <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Close</button>
                    <!-- Yes Button with custom text -->
                    <button type="button" class="btn btn-danger" id="SetDateBtn">Yes, Set it</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modals -->

    <div class="modal fade" id="SetDateModal1" tabindex="-1" role="dialog" aria-labelledby="SetDateModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-4">
                    <h5 class="modal-title" id="SetDateModal1Label">Set Date of Pick</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Select the availability dates to pick-up in your farm.<br><br>

                    <!-- Error message for date selection -->
                    <div id="dateErrorMessage" style="color: red; text-align: center; display: none;">Select dates required</div>
                    <!-- Date selection inputs -->
                    <input type="radio" id="availability11" name="availability1" value="option11">
                    <label for="availability11"></label><br>
                    <input type="radio" id="availability21" name="availability1" value="option21">
                    <label for="availability21"></label><br>
                    <input type="radio" id="availability31" name="availability1" value="option31">
                    <label for="availability31"></label>
                </div>
                <div class="modal-body" style="color: red; text-align: center;">
                    Are you sure you want to Set the date to Pick?
                </div>
                <hr>
                <div class="modal-footer">
                    <!-- No Button with custom text -->
                    <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Close</button>
                    <!-- Yes Button with custom text -->
                    <button type="button" class="btn btn-danger" id="SetDateBtn1">Yes, Set it</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,800;1,800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function setDateReturn(id, selectDateReturn) {
            var nextDate1 = new Date(selectDateReturn);
            var nextDate2 = new Date(selectDateReturn);
            nextDate1.setDate(nextDate1.getDate() + 1);
            nextDate2.setDate(nextDate2.getDate() + 2)

            var nextDateString1 = nextDate1.toISOString().split('T')[0];
            var nextDateString2 = nextDate2.toISOString().split('T')[0];

            $("#SetDateBtn1").data("request-id", id);

            $("#availability11").val(selectDateReturn);
            $("label[for='availability11']").text(selectDateReturn);

            $("#availability21").val(nextDateString1);
            $("label[for='availability21']").text(nextDateString1);

            $("#availability31").val(nextDateString2);
            $("label[for='availability31']").text(nextDateString2);

            $("#SetDateModal1").modal("show");
        }

        $("#SetDateBtn1").click(function() {
            var id = $(this).data("request-id");

            var selectDateReturn = $('input[name="availability1"]:checked').val();

            if (!selectDateReturn) {
                $("#dateErrorMessage").show();
                return;
            } else {
                $("#dateErrorMessage").hide();
            }

            $.ajax({
                url: "/set-date-request1/" + id,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: "Waiting-for-Return",
                    select_picked: selectDateReturn
                },
                success: function(response) {
                    console.log(response);

                    // Show SweetAlert success message with an OK button
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Process completed successfully!',
                        showConfirmButton: true, // Show the OK button
                        allowOutsideClick: false // Prevent closing by clicking outside
                    }).then((result) => {
                        // Reload the page when the OK button is clicked or the message is closed
                        location.reload();
                    });
                },
                error: function(error) {
                    console.error("Error updating request status:", error);
                }
            });

            $("#SetDateModal1").modal("hide");
        });



        function setDate(id, selectDate) {
            var nextDate1 = new Date(selectDate);
            var nextDate2 = new Date(selectDate);
            nextDate1.setDate(nextDate1.getDate() + 1);
            nextDate2.setDate(nextDate2.getDate() + 2)

            var nextDateString1 = nextDate1.toISOString().split('T')[0];
            var nextDateString2 = nextDate2.toISOString().split('T')[0];

            $("#SetDateBtn").data("request-id", id);

            $("#availability1").val(selectDate);
            $("label[for='availability1']").text(selectDate);

            $("#availability2").val(nextDateString1);
            $("label[for='availability2']").text(nextDateString1);

            $("#availability3").val(nextDateString2);
            $("label[for='availability3']").text(nextDateString2);

            $("#SetDateModal").modal("show");
        }

        $("#SetDateBtn").click(function() {
            var id = $(this).data("request-id");

            var selectedDate = $('input[name="availability"]:checked').val();

            if (!selectedDate) {
                $("#dateErrorMessage").show();
                return;
            } else {
                $("#dateErrorMessage").hide();
            }

            $.ajax({
                url: "/set-date-request/" + id,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: "Ready",
                    select_picked: selectedDate
                },
                success: function(response) {
                    console.log(response);

                    // Show SweetAlert success message with an OK button
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Process completed successfully!',
                        showConfirmButton: true, // Show the OK button
                        allowOutsideClick: false // Prevent closing by clicking outside
                    }).then((result) => {
                        // Reload the page when the OK button is clicked or the message is closed
                        location.reload();
                    });
                },
                error: function(error) {
                    console.error("Error updating request status:", error);
                }
            });

            $("#SetDateModal").modal("hide");
        });




        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim().toLowerCase();
                var resultsCount = 0;
                $('#farmTableBody tr').each(function() {
                    var idText = $(this).find('.id').text().toLowerCase();
                    var pattern = new RegExp(searchText, 'i');
                    if (pattern.test(idText)) {
                        $(this).show();
                        resultsCount++;
                    } else {
                        $(this).hide();
                    }
                });

                if (resultsCount === 0 && searchText.length > 0) {
                    $('#noFarmsMessageContainer').show();
                } else {
                    $('#noFarmsMessageContainer').hide();
                }
            });
        });

        function showRequestDetails(id, supplyTool, supplyTool1, supplyTool2, supplySeedling, supplySeedling1, supplySeedling2, countTool, countTool1, countTool2, countSeedling, countSeedling1, countSeedling2, requestedBy, status, letterContent, requestLeaderFirstName, requestLeaderLastName) {


            $('#request_id_modal').val(id);
            $('#supply_tool_modal').val(supplyTool);
            $('#supply_seedling_modal').val(supplySeedling);
            $('#supply_tool_modal1').val(supplyTool1);
            $('#supply_tool_modal2').val(supplyTool2);
            $('#supply_seedling_modal').val(supplySeedling);
            $('#supply_seedling_modal1').val(supplySeedling1);
            $('#supply_seedling_modal2').val(supplySeedling2);
            $('#count_tool_modal').val(countTool);
            $('#count_tool_modal1').val(countTool1);
            $('#count_tool_modal2').val(countTool2);
            $('#count_seedling_modal').val(countSeedling);
            $('#count_seedling_modal1').val(countSeedling1);
            $('#count_seedling_modal2').val(countSeedling2);



            $('#letter_content_modal')
                .attr('href', "/view-pdf/" + id)
                .attr('target', '_blank')
                .text('View PDF for Request ' + id);

        }

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
                        var statusAndValidatedParagraph = createParagraphss(statusAndValidatedText, true, '17px'); // Specify the font size
                        containerWrapper.appendChild(statusAndValidatedParagraph);

                        // Create a container for "Remarks" with border, padding, light gray background, light black font color, and updated box-shadow
                        var remarksContainer = createContainer();

                        // Create a paragraph for "Validated By"
                        var validatedByParagraph = createParagraphs(data.validated_by[index], true);

                        var remarkText = remark || "";
                        var visitDateText = data.select_picked[index] ? new Date(data.select_picked[index]).toLocaleDateString('en-US', {
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



        function goBack() {
            window.location.href = "/dashboard/analytics";
            window.onload = function() {
                window.location.reload(true);
            };
        }

        function openStatusModal() {
            $('#statusModal').modal('show');
        }


        document.addEventListener("DOMContentLoaded", function() {
            // Initialize counters for each button type
            const buttonCounts = {
                "add-btn": 0,
                "add-btn1": 0
            };

            // Function to remove the added row
            function removeRow(button) {
                const rowToRemove = button.closest(".row-item");
                const parentDiv = rowToRemove.closest(".row");
                const isTool = parentDiv.classList.contains("tools-row");

                // Decrement the count for the corresponding button type
                if (isTool) {
                    buttonCounts["add-btn1"]--;
                } else {
                    buttonCounts["add-btn"]--;
                }

                rowToRemove.parentNode.removeChild(rowToRemove);
            }

            function removeRow1(button) {
                const rowToRemove = button.closest(".row-item");
                const parentDiv = rowToRemove.closest(".row");
                const isSeedling = parentDiv.classList.contains("seedlings-row");

                // Decrement the count for the corresponding button type
                if (isSeedling) {
                    buttonCounts["add-btn"]--;
                } else {
                    buttonCounts["add-btn1"]--;
                }

                rowToRemove.parentNode.removeChild(rowToRemove);
            }

            // Get all the plus buttons for tools
            const plusButtons = document.querySelectorAll(".add-btn");

            // Add event listener to each plus button for tools
            plusButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Check if maximum count has been reached for this button type
                    if (buttonCounts["add-btn"] < 2) {
                        // Get the parent element of the clicked button
                        const parentDiv = button.closest(".row");

                        // Create the HTML content for tools to be appended
                        const htmlContent = `
                <div class=" row-item col-md-30 d-flex">
    <div class="col-md-6 d-flex" style="padding-top: 10px; ">
        <select id="supply_tool${buttonCounts["add-btn"] + 1}" name="supply_tool${buttonCounts["add-btn"] + 1}" class="form-select" style="width: 90%; "required onchange="toggleFields()">
            <option value="">Select Tools</option>
            @foreach($supplyTools as $id => $type)
            <option value="{{ $id }}">{{ $type }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-6">
        <div class="d-flex align-items-end">
            <div class="me-2" style="padding-top: 10px;padding-left: 13px;">
                <input type="number" name="count_tool${buttonCounts["add-btn"] + 1}" id="count_tool${buttonCounts["add-btn"] + 1}" class="form-control" style="width: 109px;" title="This field is required to fill up" placeholder="Enter Quantity" required onchange="toggleFields()" />
            </div>
            <div >
                <button type="button" class="btn btn-danger remove-btn">Remove</button>
            </div>
        </div>
    </div>
</div>

                `;

                        // Append the HTML content for tools to the parent div
                        parentDiv.insertAdjacentHTML("beforeend", htmlContent);

                        // Increment the count for the clicked button type
                        buttonCounts["add-btn"]++;

                        // Get the newly added remove button
                        const removeButtons = parentDiv.querySelectorAll(".remove-btn");
                        const lastRemoveButton = removeButtons[removeButtons.length - 1];

                        // Add event listener to the remove button
                        lastRemoveButton.addEventListener("click", function() {
                            removeRow(lastRemoveButton);
                        });
                    }
                });
            });

            // Get all the plus buttons for seedlings
            const plusButtons1 = document.querySelectorAll(".add-btn1");

            // Add event listener to each plus button for seedlings
            plusButtons1.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Check if maximum count has been reached for this button type
                    if (buttonCounts["add-btn1"] < 2) {
                        // Get the parent element of the clicked button
                        const parentDiv = button.closest(".row");

                        // Create the HTML content for seedlings to be appended
                        const htmlContent = `
                <div class=" row-item col-md-30 d-flex">
    <div class="col-md-6 d-flex" style="padding-top: 10px; ">
        <select id="supply_seedling${buttonCounts["add-btn1"] + 1}" name="supply_seedling${buttonCounts["add-btn1"] + 1}" class="form-select" style="width: 90%; "required onchange="toggleFields()">
            <option value="">Select Seedlings</option>
            @foreach($supplySeedlings as $id => $type)
            <option value="{{ $id }}">{{ $type }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-6">
        <div class="d-flex align-items-end">
            <div class="me-2" style="padding-top: 10px;padding-left: 13px;">
                <input type="number" name="count_seedling${buttonCounts["add-btn1"] + 1}" id="count_seedling${buttonCounts["add-btn1"] + 1}" class="form-control" style="width: 109px;" title="This field is required to fill up" placeholder="Enter Quantity" required onchange="toggleFields()" />
            </div>
            <div>
                <button type="button" class="btn btn-danger remove-btn1">Remove</button>
            </div>
        </div>
    </div>
</div>
                `;

                        // Append the HTML content for seedlings to the parent div
                        parentDiv.insertAdjacentHTML("beforeend", htmlContent);

                        // Increment the count for the clicked button type
                        buttonCounts["add-btn1"]++;

                        // Get the newly added remove button
                        const removeButtons = parentDiv.querySelectorAll(".remove-btn1");
                        const lastRemoveButton = removeButtons[removeButtons.length - 1];

                        // Add event listener to the remove button
                        lastRemoveButton.addEventListener("click", function() {
                            removeRow1(lastRemoveButton);
                        });
                    }
                });
            });
        });

        function toggleFields() {
            var supplyTool = document.getElementById('supply_tool');
            var supplySeedling = document.getElementById('supply_seedling');
            var countTool = document.getElementById('count_tool');
            var countSeedling = document.getElementById('count_seedling');

            var supply_tool_value = supplyTool.value;
            var supply_seedling_value = supplySeedling.value;

            if (supply_tool_value !== '') {
                supplySeedling.removeAttribute('required');
                countSeedling.removeAttribute('required');
                countTool.setAttribute('required', 'required');

                document.getElementById("error-messages1").style.display = "none";
                supplySeedling.previousElementSibling.querySelector('.required-asteroid').style.display = "none";
                countSeedling.previousElementSibling.querySelector('.required-asteroid').style.display = "none";
            } else if (supply_seedling_value !== '') {
                supplyTool.removeAttribute('required');
                countTool.removeAttribute('required');
                countSeedling.setAttribute('required', 'required');

                document.getElementById("error-messages").style.display = "none";
                supplyTool.previousElementSibling.querySelector('.required-asteroid').style.display = "none";
                countTool.previousElementSibling.querySelector('.required-asteroid').style.display = "none";
            } else {
                supplyTool.setAttribute('required', 'required');
                supplySeedling.setAttribute('required', 'required');
                countTool.setAttribute('required', 'required');
                countSeedling.setAttribute('required', 'required');

                document.querySelectorAll(".required-asteroid").forEach(function(element) {
                    element.style.display = "inline";
                });
            }
        }


        function submitForm() {
            var form = document.getElementById('addFarmForm');
            var requiredFields = form.querySelectorAll('[required]');
            var isValid = true;

            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            var supplyCountField = document.getElementsByName('count_tool')[0];
            if (supplyCountField.value.trim() === '0') {
                isValid = false;
                supplyCountField.classList.add('is-invalid');
                document.getElementById('error-messages1').style.display = 'block';
                document.getElementById('error-messages1').innerHTML = '<p>Quantity cannot be 0.</p>';
            }

            var supplySeedlingField = document.getElementsByName('count_seedling')[0];
            if (supplySeedlingField.value.trim() === '0') {
                isValid = false;
                supplySeedlingField.classList.add('is-invalid');
                document.getElementById('error-messages1').style.display = 'block';
                document.getElementById('error-messages1').innerHTML = '<p>Quantity cannot be 0.</p>';
            }

            if (!isValid) {
                document.getElementById('error-messages').style.display = 'block';
                document.getElementById('error-messages').innerHTML = '<p>Please fill out all required fields.</p>';
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to submit this form?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('error-messages').style.display = 'none';
                    document.getElementById('error-messages').innerHTML = '';
                    document.getElementById('error-messages1').style.display = 'none';
                    document.getElementById('error-messages1').innerHTML = '';

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
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Your form has been submitted successfully!',
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    html: data.errors ? Object.values(data.errors).join('<br>') : 'An error occurred while processing your request. Please try again later.',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while processing your request. Please try again later.',
                            });
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your form submission has been cancelled.',
                        icon: 'info'
                    });
                }
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

        var lordIconContainer = document.getElementById("lordIconContainer1");
        var lordIcon = document.createElement("lord-icon");
        lordIcon.setAttribute("src", "https://cdn.lordicon.com/anqzffqz.json");
        lordIcon.setAttribute("trigger", "loop");
        lordIcon.setAttribute("stroke", "bold");
        lordIcon.setAttribute("state", "morph-check");
        lordIcon.setAttribute("style", "width:250px;height:250px");
        lordIconContainer.appendChild(lordIcon);
    </script>

    <style>
        .bg-blue {
            background-color: blue;
        }

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
            width: 150px;
            height: 40px;
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