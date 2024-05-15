@include('templates.header')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-e5WfKVfL25ax9BJ0zVs53XnmtoM3veeUGJNV5iFFeVOq82kV4ky4R5p5ocD9z/L" crossorigin="anonymous"></script>
</head>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Request List</h5>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-soft-success material-shadow-none" onclick="downloadPDF()">
                                        <i class="ri-add-circle-line align-middle"></i>Download Report
                                    </button>
                                </div>
                                <!-- <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Order</button>
                                        <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                        <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Search">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body pt-0">
                            <div class="text-center">
                                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link All py-3 active" data-bs-toggle="tab" id="All" href="#all" role="tab" aria-selected="true" tabindex="0">
                                            <i class="ri-store-2-fill me-1 align-bottom"></i> All
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3" data-bs-toggle="tab" id="Requested" href="#requested" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Request List
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3" data-bs-toggle="tab" id="Available" href="#available" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Available List
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3" data-bs-toggle="tab" id="Approval" href="#approval" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-truck-line me-1 align-bottom"></i> Approval List
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3" data-bs-toggle="tab" id="Disapproved" href="#disapproved" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-delete-bin-5-fill me-1 align-bottom"></i> Disapproved List
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3" data-bs-toggle="tab" id="Picked" href="#picked" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-inbox-archive-line me-1 align-bottom"></i> Picking
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3" data-bs-toggle="tab" id="Returned" href="#returned" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returnees
                                        </a>
                                    </li>
                                </ul>

                                <div id="all" class="tab-pane">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="">ID</th>
                                                    <th width="15%">Supply Tools</th>
                                                    <th width="10%">Tools Qty</th>
                                                    <th width="15%">Supply Seeds</th>
                                                    <th width="10%">Seeds Qty</th>
                                                    <th width="15%">Requested By</th>
                                                    <!-- <th>Farm Name</th> -->
                                                    <th width="15%">Status</th>
                                                    <th width="20%">Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <!-- Loop through all requests and populate the table rows -->
                                                @forelse($all_requests as $request)
                                                <tr>
                                                    <td class="text-center">{{ $request->id }}</td>
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? '' }}
                                                        {{ $request->supplyTool1 ? ', ' . $request->supplyTool1->type : '' }}
                                                        {{ $request->supplyTool2 ? ', ' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="text-center">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="text-center">{{ $request->farm_name }}</td> -->
                                                    <td class="text-center">{{ $request->status }}</td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                                @empty
                                                <!-- If no requests found, display a message -->
                                                <tr>
                                                    <td colspan="11">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">No Request Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for you search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- request list table -->
                                <div id="requested" class="tab-pane fade">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="" data-sort="id">ID</th>
                                                    <!-- <th data-sort="supply_id">Supply Type</th> -->
                                                    <th width="15%" data-sort="tool_type">Supply Tools</th>
                                                    <th width="5%" data-sort="count_tool">Tools Qty</th>
                                                    <th width="15%" data-sort="seedling_type">Supply Seeds</th>
                                                    <th width="5%" data-sort="count_seedling">Seeds Qty</th>
                                                    <th width="5%" data-sort="letter_content">Letter</th>
                                                    <th width="15%" data-sort="farm_leader">Requested By</th>
                                                    <!-- <th data-sort="farm_name">Farm Name</th> -->
                                                    <th width="10%" data-sort="status">Status</th>
                                                    <th width="15%" data-sort="change_stat">Set As</th>
                                                    <th width="10%" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @forelse($request_tbl as $key => $request)
                                                <tr>
                                                    <td class="id">{{ $request->id }}</td>
                                                    <!-- <td class="supply_id">{{ $request->supply_tool }}</td> -->
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? '' }}
                                                        @if($request->supply_tool1 || $request->supply_tool2)
                                                        ,
                                                        @endif
                                                        <br>
                                                        {{ $request->supplyTool1 ? '' . $request->supplyTool1->type : '' }}
                                                        @if($request->supply_tool1 || $request->supply_tool2)
                                                        ,
                                                        @endif
                                                        <br>
                                                        {{ $request->supplyTool2 ? '' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="letter_content">
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent({{ $request->id }})">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="farm_leader">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="farm_name">{{ optional($request->farm)->farm_name }}</td> -->
                                                    <td class="status">
                                                        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                    </td>
                                                    <td>
                                                        <select class="form-select change_stat">
                                                            <option value="0" disabled selected>Set As</option>
                                                            <option value="Available">Available</option>
                                                            <option value="Unavailable">Unavailable</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>
                                                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">Set Return Date</button> -->
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="11">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for you search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- available list -->
                                <div id="available" class="tab-pane fade">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="" data-sort="id">ID</th>
                                                    <!-- <th data-sort="supply_id">Supply Type</th> -->
                                                    <th width="15%" data-sort="tool_type">Supply Tools</th>
                                                    <th width="5%" data-sort="count_tool">Tools Qty</th>
                                                    <th width="15%" data-sort="seedling_type">Supply Seeds</th>
                                                    <th width="5%" data-sort="count_seedling">Seeds Qty</th>
                                                    <th width="5%" data-sort="letter_content">Letter</th>
                                                    <th width="15%" data-sort="farm_leader">Requested By</th>
                                                    <!-- <th data-sort="farm_name">Farm Name</th> -->
                                                    <th width="10%" data-sort="status">Status</th>
                                                    <th width="15%" data-sort="change_stat">Set As</th>
                                                    <th width="10%" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <!-- Loop through the available requests and populate the table rows -->
                                                @forelse($available_requests as $request)
                                                <tr>
                                                    <td class="id">{{ $request->id }}</td>
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? ' ' }}
                                                        @if($request->supply_tool1 || $request->supply_tool2)
                                                        ,
                                                        @endif
                                                        <br>
                                                        {{ $request->supplyTool1 ? ' ' . $request->supplyTool1->type : '' }}
                                                        @if($request->supply_tool1 || $request->supply_tool2)
                                                        ,
                                                        @endif
                                                        <br>
                                                        {{ $request->supplyTool2 ? ' ' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="letter_content">
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent({{ $request->id }})">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center farm_leader">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="text-center farm_name">{{ optional($request->farm)->farm_name }}</td> -->
                                                    <td class="status">
                                                        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                    </td>
                                                    <td>
                                                        @if($request->status === 'Available')
                                                            <select class="form-select change_stat">
                                                                <option selected="" value="0" disabled selected>Set As</option>
                                                                <option value="Waiting-for-approval">Waiting for Approval</option>
                                                            </select>
                                                        @elseif($request->status === 'Waiting for Approval')
                                                            <select class="form-select change_stat">
                                                                <option value="Approved">Approved</option>
                                                                <option value="Disapproved">Disapproved</option>
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>
                                                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">Set Return Date</button> -->
                                                    </td>
                                                </tr>
                                                @empty
                                                <!-- If no available requests found, display a message -->
                                                <tr>
                                                    <td colspan="11">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for you search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Approval list -->
                                <div id="approval" class="tab-pane fade">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="" data-sort="id">ID</th>
                                                    <!-- <th data-sort="supply_id">Supply Type</th> -->
                                                    <th width="15%" data-sort="tool_type">Supply Tools</th>
                                                    <th width="5%" data-sort="count_tool">Tools Qty</th>
                                                    <th width="15%" data-sort="seedling_type">Supply Seeds</th>
                                                    <th width="5%" data-sort="count_seedling">Seeds Qty</th>
                                                    <th width="5%" data-sort="letter_content">Letter</th>
                                                    <th width="15%" data-sort="farm_leader">Requested By</th>
                                                    <!-- <th data-sort="farm_name">Farm Name</th> -->
                                                    <th width="10%" data-sort="status">Status</th>
                                                    <th width="15%" data-sort="change_stat">Set As</th>
                                                    <th width="10%" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <!-- Loop through the approval requests and populate the table rows -->
                                                @forelse($approval_requests as $request)
                                                <tr>
                                                    <td class="id">{{ $request->id }}</td>
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? '' }}
                                                        {{ $request->supplyTool1 ? ', ' . $request->supplyTool1->type : '' }}
                                                        {{ $request->supplyTool2 ? ', ' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="letter_content">
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent({{ $request->id }})">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center farm_leader">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="text-center farm_name">{{ optional($request->farm)->farm_name }}</td> -->
                                                    <td class="status">
                                                        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                    </td>
                                                    <td>
                                                        @if($request->status === 'Approved')
                                                        Approved
                                                        @else
                                                        <select class="form-select change_stat">
                                                            <option selected="" value="0" disabled selected>Set As</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Disapproved">Disapproved</option>
                                                        </select>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($request->status === 'Approved')
                                                        <button type="button" class="btn btn-primary waves-effect waves-light setPickingDateButton" data-request-id="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#setPickingDateModal">Set Picking Date</button>
                                                        @else
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <!-- If no approval requests found, display a message -->
                                                <tr>
                                                    <td colspan="11">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for you search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Disapproved list -->
                                <div id="disapproved" class="tab-pane fade">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="" data-sort="id">ID</th>
                                                    <!-- <th data-sort="supply_id">Supply Type</th> -->
                                                    <th width="15%" data-sort="tool_type">Supply Tools</th>
                                                    <th width="5%" data-sort="count_tool">Tools Qty</th>
                                                    <th width="15%" data-sort="seedling_type">Supply Seeds</th>
                                                    <th width="5%" data-sort="count_seedling">Seeds Qty</th>
                                                    <th width="5%" data-sort="letter_content">Letter</th>
                                                    <th width="15%" data-sort="farm_leader">Requested By</th>
                                                    <!-- <th data-sort="farm_name">Farm Name</th> -->
                                                    <th width="10%" data-sort="status">Status</th>
                                                    <th width="15%" data-sort="change_stat">Set As</th>
                                                    <th width="10%" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <!-- Loop through the approval requests and populate the table rows -->
                                                @forelse($disapproved_requests as $request)
                                                <tr>
                                                    <td class="id">{{ $request->id }}</td>
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? '' }}
                                                        {{ $request->supplyTool1 ? ', ' . $request->supplyTool1->type : '' }}
                                                        {{ $request->supplyTool2 ? ', ' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="letter_content">
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent({{ $request->id }})">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center farm_leader">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="text-center farm_name">{{ optional($request->farm)->farm_name }}</td> -->
                                                    <td class="status">
                                                        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                    </td>
                                                    <td>
                                                        <select class="form-select change_stat">
                                                            <option selected="" value="0" disabled selected>Set As</option>
                                                            <option value="Resubmit">Resubmit</option>
                                                            <option value="Waiting-for-approval">Waiting for approval</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        @if($request->status === 'Approved')
                                                        <button type="button" class="btn btn-primary waves-effect waves-light setPickingDateButton" data-request-id="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#setPickingDateModal">Set Picking Date</button>
                                                        @else
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <!-- If no approval requests found, display a message -->
                                                <tr>
                                                    <td colspan="11">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for you search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Picked list -->
                                <div id="picked" class="tab-pane fade">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="" data-sort="id">ID</th>
                                                    <!-- <th data-sort="supply_id">Supply Type</th> -->
                                                    <th width="15%" data-sort="tool_type">Supply Tools</th>
                                                    <th width="5%" data-sort="count_tool">Tools Qty</th>
                                                    <th width="15%" data-sort="seedling_type">Supply Seeds</th>
                                                    <th width="5%" data-sort="count_seedling">Seeds Qty</th>
                                                    <th width="5%" data-sort="letter_content">Letter</th>
                                                    <th width="15%" data-sort="farm_leader">Requested By</th>
                                                    <!-- <th data-sort="farm_name">Farm Name</th> -->
                                                    <th width="10%" data-sort="status">Status</th>
                                                    <th width="15%" data-sort="created_at">Pick up date</th>
                                                    <th width="20%" data-sort="change_stat">Set As</th>
                                                    <th width="10%" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <!-- Loop through the picked requests and populate the table rows -->
                                                @forelse($picked_requests as $request)
                                                <tr>
                                                    <td class="id">{{ $request->id }}</td>
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? '' }}
                                                        {{ $request->supplyTool1 ? ', ' . $request->supplyTool1->type : '' }}
                                                        {{ $request->supplyTool2 ? ', ' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="letter_content">
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent({{ $request->id }})">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center farm_leader">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="text-center farm_name">{{ optional($request->farm)->farm_name }}</td> -->
                                                    <td class="status">
                                                        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                    </td>
                                                    <td class="created_at">{{ \Carbon\Carbon::parse($request->picked_date)->format('Y-m-d / h:i A') }}</td>
                                                    <td>
                                                        @if($request->status === 'Picked')
                                                        Picked
                                                        @else
                                                        <select class="form-select change_stat">
                                                            <option selected="" value="0" disabled selected>Set As</option>
                                                            <option value="Picked">Picked</option>
                                                            <option value="Failed-to-pick">Failed to pick</option>
                                                        </select>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($request->status === 'Picked')
                                                        <button type="button" class="btn btn-primary waves-effect waves-light setReturnDateButton" data-request-id="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#setReturnDateModal">Set Return Date</button>
                                                        @else
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <!-- If no picked requests found, display a message -->
                                                <tr>
                                                    <td colspan="10">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for your search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Return list -->
                                <div id="returned" class="tab-pane fade">
                                    <div class="table-responsive mb-1">
                                        <table class="table nowrap dt-responsive align-middle table-hover" style="width:100%">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th width="" data-sort="id">ID</th>
                                                    <!-- <th data-sort="supply_id">Supply Type</th> -->
                                                    <th width="15%" data-sort="tool_type">Supply Tools</th>
                                                    <th width="5%" data-sort="count_tool">Tools Qty</th>
                                                    <th width="15%" data-sort="seedling_type">Supply Seeds</th>
                                                    <th width="5%" data-sort="count_seedling">Seeds Qty</th>
                                                    <th width="5%" data-sort="letter_content">Letter</th>
                                                    <th width="15%" data-sort="farm_leader">Requested By</th>
                                                    <!-- <th data-sort="farm_name">Farm Name</th> -->
                                                    <th width="10%" data-sort="status">Status</th>
                                                    <th width="15%" data-sort="created_at">Return Date</th>
                                                    <th width="20%" data-sort="change_stat">Set As</th>
                                                    <th width="" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <!-- Loop through the picked requests and populate the table rows -->
                                                @forelse($return_requests as $request)
                                                <tr>
                                                    <td class="id">{{ $request->id }}</td>
                                                    <td class="text-center tool_type">
                                                        {{ $request->supplyTool->type ?? '' }}
                                                        {{ $request->supplyTool1 ? ', ' . $request->supplyTool1->type : '' }}
                                                        {{ $request->supplyTool2 ? ', ' . $request->supplyTool2->type : '' }}
                                                    </td>
                                                    <td class="count_tool">
                                                        {{ strtoupper($request->count_tool) }}
                                                        {{ $request->count_tool1 ? ', ' . strtoupper($request->count_tool1) : '' }}
                                                        {{ $request->count_tool2 ? ', ' . strtoupper($request->count_tool2) : '' }}
                                                    </td>
                                                    <td class="text-center seedling_type">
                                                        {{ $request->supplySeedling->type ?? '' }}
                                                        {{ $request->supplySeedling1 ? ', ' . $request->supplySeedling1->type : '' }}
                                                        {{ $request->supplySeedling2 ? ', ' .$request->supplySeedling2->type : '' }}
                                                    </td>
                                                    <td class="count_seedling">
                                                        {{ strtoupper($request->count_seedling) }}
                                                        {{ $request->count_seedling1 ? ', ' . strtoupper($request->count_seedling1) : '' }}
                                                        {{ $request->count_seedling2 ? ', ' . strtoupper($request->count_seedling2) : '' }}
                                                    </td>
                                                    <td class="letter_content">
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent({{ $request->id }})">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center farm_leader">{{ $request->requestedBy->firstname }} {{ $request->requestedBy->lastname }}</td>
                                                    <!-- <td class="text-center farm_name">{{ optional($request->farm)->farm_name }}</td> -->
                                                    <td class="status">
                                                        <label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">{{ $request->status }}</label>
                                                    </td>
                                                    <td class="created_at">{{ \Carbon\Carbon::parse($request->date_return)->format('Y-m-d / h:i A') }}</td>
                                                    <td>
                                                        <select class="form-select change_stat">
                                                            <option selected="" value="0" disabled selected>Set As</option>
                                                            <option value="Returned">Returned</option>
                                                            <option value="Failed-to-return">Failed to return</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <!-- If no picked requests found, display a message -->
                                                <tr>
                                                    <td colspan="10">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                                            <p class="text-muted">We've searched more than 150+ Request We did not find any orders for your search.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            <li class="active"><a class="page" href="#" data-i="1" data-page="10">1</a></li>
                                            <li><a class="page" href="#" data-i="2" data-page="10">2</a></li>
                                        </ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for setting picking date -->
                            <div class="modal fade" id="setPickingDateModal" tabindex="-1" aria-labelledby="setPickingDateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="setPickingDateModalLabel">Set Picking Date</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="setPickingDateForm">
                                                <!-- Change the input type from hidden to text and set its id to request_id -->
                                                <input type="text" id="request_id" value="" hidden>
                                                <div class="mb-3">
                                                    <label for="pickingDate" class="form-label">Picking Date</label>
                                                    <input type="date" class="form-control" id="pickingDate" name="pickingDate" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation Remarks</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Type your remarks update below</h5>
                                            <div class="form-floating">
                                                <textarea class="form-control" name="remarks" rows="3" style="height: 150px;" placeholder="Enter your remarks..."></textarea>
                                                <label for="remarkstext">-Optional-</label>
                                            </div>
                                            <br>
                                            <!-- <div class="mb-3">
                                                <label for="dateInput" class="form-label">Select Date:</label>
                                                <input type="date" class="form-control" id="dateInput" min="<?php echo date('Y-m-d'); ?>">
                                            </div> -->

                                            <h5>Are you sure you want to update the status?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary wider-btn" id="confirmUpdateBtn">Confirm</button>
                                            <button type="button" class="btn btn-outline-secondary wider-btn" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for setting return date -->
                            <div class="modal fade" id="setReturnDateModal" tabindex="-1" aria-labelledby="setReturnDateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="setReturnDateModalLabel">Set Return Date</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="setReturnDateForm">
                                                <!-- Change the input type from hidden to text and set its id to request_id -->
                                                <input type="text" id="request_id" value="" hidden>
                                                <div class="mb-3">
                                                    <label for="returnDate" class="form-label">Return Date</label>
                                                    <input type="date" class="form-control" id="returnDate" name="returnDate" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">View Letter Content</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img id="letterContent" class="img-fluid" alt="Letter Content">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Modal -->
                            <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>You are about to delete a order ?</h4>
                                                <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                    <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

    function downloadPDF() {
        window.location.href = "{{ route('downloadPdf') }}";
    }

    function viewLetterContent(id) {
        window.open("/view-pdf/" + id, '_blank');
    }

    // Function to set return date
    function setReturnDate(requestId, returnDate) {
        // Send an AJAX request to set the return date
        $.ajax({
            url: "/set-return-date",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                requestId: requestId,
                date_return: returnDate // Change return_date to date_return
            },
            success: function(response) {
                if (response.success) {
                    // If the request is successful, update the status to "Returned"
                    updateStatusInDatabase(requestId, 'Waiting-for-return');
                    // Close the modal and show a success message
                    $('#setReturnDateModal').modal('hide');
                    alert('Return date set successfully!');
                } else {
                    // If there's an error, show the error message
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while processing your request. Please try again.');
            }
        });
    }

    // Event listener for submitting return date
    $('#setReturnDateForm').submit(function(event) {
        event.preventDefault();
        var returnDate = $('#returnDate').val();
        var requestId = $('#request_id').val();
        setReturnDate(requestId, returnDate);
    });

    // Function to open the set return date modal
    function openSetReturnDateModal(requestId) {
        // Set the request ID in the hidden input field
        $('#request_id').val(requestId);

        // Enable the date input field
        $('#returnDate').prop('disabled', false);

        // Show the modal
        $('#setReturnDateModal').modal('show');
    }

    // Add an event listener to the set return date buttons
    $('.setReturnDateButton').click(function() {
        // Get the request ID from the table row
        var requestId = $(this).closest('tr').find('.id').text();

        // Open the set return date modal with the request ID
        openSetReturnDateModal(requestId);
    });

    // Function to set picking date
    function setPickingDate(requestId, pickingDate) {
        // Send an AJAX request to set the picking date
        $.ajax({
            url: "/set-picking-date",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                requestId: requestId,
                picked_date: pickingDate // Change pickingDate to picked_date
            },
            success: function(response) {
                if (response.success) {
                    // If the request is successful, update the status to "Ready to be Picked"
                    updateStatusInDatabase(requestId, 'Confirmed-pick-date');
                    // Close the modal and show a success message
                    $('#setPickingDateModal').modal('hide');
                    alert('Picking date set successfully!');
                } else {
                    // If there's an error, show the error message
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while processing your request. Please try again.');
            }
        });
    }

    // Event listener for submitting picking date
    $('#setPickingDateForm').submit(function(event) {
        event.preventDefault();
        var pickingDate = $('#pickingDate').val();
        var requestId = $('#request_id').val();
        setPickingDate(requestId, pickingDate);
    });

    // Function to open the set picking date modal
    function openSetPickingDateModal(requestId) {
        // Set the request ID in the hidden input field
        $('#request_id').val(requestId);

        // Enable the date input field
        $('#pickingDate').prop('disabled', false);

        // Show the modal
        $('#setPickingDateModal').modal('show');
    }

    // Add an event listener to the set picking date buttons
    $('.setPickingDateButton').click(function() {
        // Get the request ID from the table row
        var requestId = $(this).closest('tr').find('.id').text();

        // Open the set picking date modal with the request ID
        openSetPickingDateModal(requestId);
    });

    $(document).ready(function() {
        // Show the requested list table by default
        $("#requested").show();

        // Tab click event
        $(".nav-link").click(function() {
            // Hide all tables
            $(".tab-pane").hide();
            
            // Get the target tab's href attribute value
            var target = $(this).attr("href");
            
            // Show the corresponding table
            $(target).show();
        });

        // Function to fetch and display available list
        function fetchAvailableList() {
            $.ajax({
                url: '/availableList', // Route to fetch available list data
                method: 'GET',
                success: function(response) {
                    // Clear the existing table rows
                    $('#available .list').empty();

                    // Loop through the fetched data and populate the table
                    $.each(response, function(index, request) {
                        var row = createTableRow(request);
                        $('#available .list').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error fetching available list:', error);
                }
            });
        }

        // Function to fetch and display approved list
        function fetchApprovalList() {
            $.ajax({
                url: '/approvalList', // Route to fetch approved list data
                method: 'GET',
                success: function(response) {
                    // Clear the existing table rows
                    $('#approval .list').empty();

                    // Loop through the fetched data and populate the table
                    $.each(response, function(index, request) {
                        var row = createTableRow(request);
                        $('#approval .list').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error fetching approval list:', error);
                }
            });
        }

        function fetchDisapprovedList() {
            $.ajax({
                url: '/disapprovedList', // Route to fetch approved list data
                method: 'GET',
                success: function(response) {
                    // Clear the existing table rows
                    $('#disapproved .list').empty();

                    // Loop through the fetched data and populate the table
                    $.each(response, function(index, request) {
                        var row = createTableRow(request);
                        $('#disapproved .list').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error fetching disapproved list:', error);
                }
            });
        }

        // Function to fetch and display picked list
        function fetchPickedList() {
            $.ajax({
                url: '/pickedList', // Route to fetch picked list data
                method: 'GET',
                success: function(response) {
                    // Clear the existing table rows
                    $('#picked .list').empty();

                    // Loop through the fetched data and populate the table
                    $.each(response, function(index, request) {
                        var row = createTableRow(request);
                        $('#picked .list').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error fetching picked list:', error);
                }
            });
        }

        // Function to fetch and display returned list
        function fetchReturnedList() {
            $.ajax({
                url: '/returnList', // Route to fetch picked list data
                method: 'GET',
                success: function(response) {
                    // Clear the existing table rows
                    $('#returned .list').empty();

                    // Loop through the fetched data and populate the table
                    $.each(response, function(index, request) {
                        var row = createTableRow(request);
                        $('#returned .list').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error fetching return list:', error);
                }
            });
        }

        fetchAvailableList();
        fetchApprovalList();
        fetchDisapprovedList();
        fetchPickedList();
        fetchReturnedList();
    });

    // Function to set status badge color based on status
    function setStatusBadgeColor(status) {
        switch (status.toLowerCase().replace(' ', '-')) {
            case 'requested':
                return { backgroundColor: '#007BFF', color: '#FFF' };
            case 'available':
                return { backgroundColor: '#A5DD9B', color: '#FFF' };
            case 'unavailable':
                return { backgroundColor: '#524C42', color: '#FFF' };
            case 'confirmed-pick-date':
                return { backgroundColor: '#E65C19', color: '#FFF' };
            case 'picked':
            case 'resubmit':
                return { backgroundColor: '#121481', color: '#FFF' };
            case 'failed-to-pick':
                return { backgroundColor: '#FA7070', color: '#FFF' };
            case 'failed-to-return':
                return { backgroundColor: '#C08B5C', color: '#FFF' };
            case 'waiting-for-approval':
            case 'waiting-for-return':
                return { backgroundColor: '#FFC107', color: '#000' };
            case 'approved':
                return { backgroundColor: '#28a745', color: '#FFF' };
            case 'disapproved':
                return { backgroundColor: '#990000', color: '#FFF' };
            case 'returned':
                return { backgroundColor: '#86469C', color: '#FFF' };
            default:
                return { backgroundColor: '', color: '' };
        }
    }

    // Update status badge color
    $(document).ready(function() {
        $('.status').each(function() {
            var statusText = $(this).text().trim();
            var badgeColor = setStatusBadgeColor(statusText);
            $(this).find('label').css({ backgroundColor: badgeColor.backgroundColor, color: badgeColor.color });
        });
    });

    // Function to create a table row for a request object
    function createTableRow(request) {
        var row = '<tr>' +
            '<td class="id">' + request.id + '</td>' +
            '<td class="text-center tool_type">' + (request.supply_tool ? request.supplyTool.type : 'N/A') + '</td>' +
            '<td class="text-center seedling_type">' + (request.supply_seedling ? request.supplySeedling.type : 'N/A') + '</td>' +
            '<td class="text-center count_tool">' + request.count_tool + '</td>' +
            '<td class="text-center count_seedling">' + request.count_seedling + '</td>' +
            '<td class="letter_content">' +
            '<button type="button" class="btn btn-success waves-effect waves-light" onclick="viewLetterContent(' + request.id + ')">' +
            '<i class="ri-eye-line align-bottom"></i>' +
            '</button>' +
            '</td>' +
            '<td class="text-center farm_leader">' + request.requestedBy.firstname + ' ' + request.requestedBy.lastname + '</td>' +
            '<td class="text-center farm_name">' + (request.farm_name ? request.farm_name : 'N/A') + '</td>' + // Fetch farm_name attribute
            '<td class="status">' +
            '<label class="badge text-wrap" style="font-size: 12px; margin-bottom: 10px; padding: 2px; background-color: #007BFF; color: #FFF;" onclick="return false;">' + request.status + '</label>' +
            '</td>' +
            '<td>';

        // Add the dropdown menu based on the status
        if (request.status === 'Available') {
            row += '<select class="form-select change_stat">' +
                '<option selected disabled value="0">Set As</option>' +
                '<option value="Approval">Waiting for Approval</option>' +
                '</select>';
        } else if (request.status === 'Waiting for Approval') {
            row += '<select class="form-select change_stat">' +
                '<option selected disabled value="0">Set As</option>' +
                '<option value="Approved">Approved</option>' +
                '<option value="Disapproved">Disapproved</option>' +
                '</select>';
        } else {
            row += 'N/A';
        }

        row += '</td>' +
            '<td>' +
            '<button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateStatus(this)">Confirm</button>' +
            '</td>' +
            '</tr>';

        return row;
    }

    // Function to update status
    function updateStatus(buttonElement) {
        var row = $(buttonElement).closest('tr');
        var selectedStatus = row.find('.change_stat').val();
        var rowId = row.find('.id').text();

        // Get the remarks from the modal textarea
        var remarks = $('#confirmationModal textarea[name="remarks"]').val();

        // Show the confirmation modal
        $('#confirmationModal').modal('show');

        // Store the row ID, selected status, and remarks as data attributes on the confirm button
        $('#confirmUpdateBtn').data('rowId', rowId);
        $('#confirmUpdateBtn').data('selectedStatus', selectedStatus);
        $('#confirmUpdateBtn').data('remarks', remarks);

        // Disable the date input if the selected status is "Failed-to-return"
        if (selectedStatus === 'Failed-to-return' || selectedStatus === 'Returned' || selectedStatus === 'Requested' 
        || selectedStatus === 'Available' || selectedStatus === 'Unavailable' || selectedStatus === 'Waiting-for-approval' 
        || selectedStatus === 'Approved' || selectedStatus === 'Disapproved' || selectedStatus === 'Resubmit' 
        || selectedStatus === 'Picked' || selectedStatus === 'Failed-to-pick' || selectedStatus === 'Confirmed-pick-date') {
            $('#dateInput').prop('disabled', true);
        } else {
            $('#dateInput').prop('disabled', false);
        }
    }

    // Event listener for status change
    $('.change_stat').change(function() {
        var selectedStatus = $(this).val();

        // Disable the date input if the selected status is "Failed-to-return"
        if (selectedStatus === 'Failed-to-return' || selectedStatus === 'Returned' || selectedStatus === 'Requested' 
        || selectedStatus === 'Available' || selectedStatus === 'Unavailable' || selectedStatus === 'Waiting-for-approval' 
        || selectedStatus === 'Approved' || selectedStatus === 'Disapproved' || selectedStatus === 'Resubmit' 
        || selectedStatus === 'Picked' || selectedStatus === 'Failed-to-pick' || selectedStatus === 'Confirmed-pick-date') {
            $('#dateInput').prop('disabled', true);
        } else {
            $('#dateInput').prop('disabled', false);
        }
    });

    $('#confirmUpdateBtn').click(function() {
        // Get the stored row ID and selected status
        var rowId = $(this).data('rowId');
        var selectedStatus = $(this).data('selectedStatus');

        // Get the remarks from the modal textarea
        var remarks = $('textarea[name="remarks"]').val();

        // Perform the update with remarks
        updateStatusInDatabase(rowId, selectedStatus, remarks);

        // Close the modal
        $('#confirmationModal').modal('hide');
    });

    // Function to update status in the database
    function updateStatusInDatabase(rowId, selectedStatus, remarks) {
        $.ajax({
            url: '/updateStatus',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: rowId,
                status: selectedStatus,
                remarks: remarks // Include remarks in the data
            },
            success: function(response) {
                console.log('Status updated successfully');
                location.reload(); // Reload the page after successful update
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error updating status:', error);
            }
        });
    }
</script>
@include('templates.footer')