@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Farms</h4>

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
                <div class="col-lg-12">
                    <div class="card" id="tasksList">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Farms of :&nbsp; {{ $farm->barangay_name }}</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap gap-2">
                                   
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form>
    <div class="card-body border border-dashed border-end-0 border-start-0">
        <div class="row g-3">
            <div class="col-xxl-5 col-sm-12">
                <div class="search-box">
                    <!-- Your search box content here -->
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

            <div class="col-xxl-2 col-sm-3 ms-auto">
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
        </ul>
    </div>
</div>

            <!--end col-->

            <div class="col-xxl-3 col-sm-4 d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-dark w-100" onclick="SearchData();">
                    <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
                </button>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</form>



                                <!--end card-body-->
                                <div class="card-body">
    <div class="table-responsive table-card mb-4">
        <table class="table align-middle table-nowrap mb-0" id="tasksTable">
            <thead class="table-light text-muted">
                <tr>  
                    <th class="sort" data-sort="id">Farm ID</th>
                    <th class="sort" data-sort="farm_name">Farm Name</th>
                    <th class="sort" data-sort="barangay_name">Barangay</th>
                    <th class="sort" data-sort="area">Area</th>
                    <th class="sort" data-sort="address">Address</th>
                    <th class="sort" data-sort="farm_leader">Farm Leader</th>
                    <th class="sort text-center" data-sort="status">Status</th>
                    <th class="sort text-center" data-sort="actions">Actions </th>
                </tr>
            </thead>
            @endif
            <tbody id="farmTableBody" class="list form-check-all">
           
            <tr class="farm-row {{ strtolower(str_replace(' ', '-', $farm->status)) }}">
                            <td class="id">#{{ $farm->id }}</td>
                            <td class="farm_name">{{ $farm->farm_name }}</td>
                            <td class="barangay_name">{{ $farm->barangay_name }}</td>
                            <td class="area">{{ $farm->area }}</td>
                            <td class="address">{{ $farm->address }}</td>
                            <td class="farm_leader">{{ $farm->farm_leader }}</td>
                            <td class="text-center status">
                @switch(strtolower(str_replace(' ', '-', $farm->status)))
                    @case('created')
                        <button class="btn btn-primary btn-border">{{ $farm->status }}</button>
                        @break
                    @case('for-investigation')
                    <button class="btn btn-primary btn-border">{{ $farm->status }}</button>
                        @break
                    @case('for-visiting')
                    @case('resubmit')
                        <button class="btn btn-secondary btn-border">{{ $farm->status }}</button>
                        @break
                    @case('waiting-for-approval')
                        <button class="btn btn-warning btn-border">{{ $farm->status }}</button>
                        @break
                    @case('approved')
                        <button class="btn btn-success btn-border">{{ $farm->status }}</button>
                        @break
                    @case('disapproved')
		            @case('cancelled')
                        <button class="btn btn-danger btn-border">{{ $farm->status }}</button>
                        @break
                    @default
                    
                @endswitch
            </td>
                            
                            <td>
                            <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
    <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="text-primary d-inline-block edit-item-btn" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}'); updateButtonVisibility('{{ $farm->status }}');">
        <i class="ri-profile-line fs-3"></i>
    </a>
</li>

            &nbsp;
            <!-- Update the "Archive Application" button in your Blade file -->
<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Archive Application">
    <a href="#" class="text-primary d-inline-block edit-item-btn" onclick="confirmArchive('{{ $farm->id }}')">
    <i class="ri-archive-line fs-3"></i>
</a>
</li>


        </li>
    </ul>
    
</td>

                            </td>
                            <td>
                               
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


<div class="modal fade" id="archiveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="archiveConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveConfirmationModalLabel">Archive Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to archive this farm?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="archiveFarmBtn">Archive</button>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    
    <div class="modal fade modal-lg" id="viewModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Farm Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
    <!-- Status -->
    <label for="status_modal" class="form-label custom-label">Status:</label>
    <button id="status_modal" class="btn btn-primary btn-border">Active</button>
    <br>
    <br>
</div>

<div class="row">
    <div class="col-md-6">
        <!-- Farm Information -->
        <label for="farm_name_modal" class="form-label custom-label">Farm Name:</label>
        <input type="text" id="farm_name_modal" class="form-control" disabled placeholder="Farm Name">
        <br>
        <label for="barangay_name_modal" class="form-label custom-label">Barangay Name:</label>
        <input type="text" id="barangay_name_modal" class="form-control" disabled placeholder="Barangay Name">
        <br>
        <label for="title_land_modal" class="form-label custom-label">Title of land:</label>
        <input type="text" id="title_land_modal" class="form-control" disabled placeholder="Title of Land">
        <br>
    </div>

    <div class="col-md-6">
        <!-- Additional Information -->
        <label for="farm_leader_modal" class="form-label custom-label">Farm Leader:</label>
        <input type="text" id="farm_leader_modal" class="form-control" disabled placeholder="Farm Leader">
        <br>
        <label for="address_modal" class="form-label custom-label">Address:</label>
        <input type="text" id="address_modal" class="form-control" disabled placeholder="Title of Land">
        <br>
        <label for="area_modal" class="form-label custom-label">Area:</label>
        <input type="text" id="area_modal" class="form-control" disabled placeholder="Area">

    </div>
</div>
        <div class="row">
                <div class="col-md-12"><label for="picture_land_modal" class="form-label custom-label">Picture of land:</label>
                    <p="text" id="picture_land_modal" class="form-control" disabled placeholder="Picture of Land">
                </div>
        </div>
                </div>

                <!-- Additional row with buttons -->
                <div class="row mt-3">
    <!-- For Investigation and For Visiting buttons -->
    <div class="col-md-4">
        <a href="#" class="text-primary d-inline-block edit-item-btn text-start" id="forInvestigationBtn" data-bs-dismiss="modal" onclick="updateStatus('For-Investigation')">
            <button id="forInvestigationBtn" class="farm-btn btn btn-primary btn-label waves-effect waves-light equal-width-btn equal-height-btn"><i class="ri-search-eye-line label-icon align-middle fs-16 me-2"></i>For Investigation</button>
        </a>
    </div>
    <div class="col-md-4">
        <a href="#" class="text-primary d-inline-block edit-item-btn" id="forVisitingBtn" data-bs-dismiss="modal" onclick="updateStatus('For-Visiting')">
            <button id="forVisitingBtn" class="farm-btn btn btn-secondary btn-label waves-effect waves-light equal-width-btn1 equal-height-btn"><i class="ri-gps-fill label-icon align-middle fs-16 me-2"></i>For Visiting</button>
        </a>
    </div>

    <!-- Approved and Disapproved buttons -->
    <div class="col-md-4">
        <a href="#" class="text-primary d-inline-block edit-item-btn" id="approvedBtn" data-bs-dismiss="modal" onclick="updateStatus('Approved')">
            <button id="approvedBtn" class="farm-btn btn btn-success btn-label waves-effect waves-light equal-width-btn1 equal-height-btn"><i class="ri-check-line label-icon align-middle fs-16 me-2"></i>Approved</button>
        </a>
    </div>
</div>

<div class="row mt-3">
    <!-- Disapproved and Waiting-for-approval buttons -->
    <div class="col-md-4">
        <a href="#" class="text-primary d-inline-block edit-item-btn" id="disapprovedBtn" data-bs-dismiss="modal" onclick="updateStatus('Disapproved')">
            <button id="disapprovedBtn" class="farm-btn btn btn-danger btn-label waves-effect waves-light equal-width-btn3 equal-height-btn"><i class="ri-close-line label-icon align-middle fs-16 me-2"></i>Disapproved</button>
        </a>
    </div>
    <div class="col-md-4">
        <a href="#" class="text-primary d-inline-block edit-item-btn" id="waitingForApprovalBtn" data-bs-dismiss="modal" onclick="updateStatus('Waiting-for-Approval')">
            <button id="waitingForApprovalBtn" class="farm-btn btn btn-warning btn-label waves-effect waves-light equal-width-btn4 equal-height-btn"><i class="ri-time-fill label-icon align-middle fs-16 me-2"></i>Waiting for Approval</button>
        </a>
    </div>

    <!-- Resubmit button -->
    <div class="col-md-4">
        <a href="#" class="text-primary d-inline-block edit-item-btn" id="resubmitBtn" data-bs-dismiss="modal" onclick="updateStatus('Resubmit')">
            <button id="resubmitBtn" class="farm-btn btn btn-info btn-label waves-effect waves-light equal-width-btn5 equal-height-btn"><i class="ri-refresh-line label-icon align-middle fs-16 me-2"></i>Resubmit</button>
        </a>
    </div>
</div>


            </div>
        </div>
    </div>
</div>







<!-- Add this modal at the end of your Blade file -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
// Function to update the status buttons visibility in the modal
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
        }
    } else {
        console.error('Status is undefined.');
    }
}


// Function to show farm details in the modal
function showFarmDetails(id, farmName, barangayName, area, address, farmLeader, status, titleLand, pictureLand, pictureLand1, pictureLand2) {
    // Switch based on the lowercased, hyphenated status
    switch (status.toLowerCase().replace(/\s+/g, '-')) {
        case 'for-investigation':
        case 'created':
            $('#status_modal').html(status + '<i class="fas fa-check-double label-icon align-middle rounded-pill fs-16 ms-2"></i> ')
                .removeClass().addClass('btn btn-primary btn-label waves-effect right waves-light rounded-pill');
            break;
        case 'for-visiting':
        case 'resubmit':
            $('#status_modal').html('<i class="fas fa-info-circle label-icon align-middle rounded-pill fs-16 ms-2"></i> ' + status)
                .removeClass().addClass('btn btn-secondary btn-label waves-effect right waves-light rounded-pill');
            break;
        case 'waiting-for-approval':
            $('#status_modal').html('<i class="fas fa-hourglass-half label-icon align-middle rounded-pill fs-16 ms-2"></i> ' + status)
                .removeClass().addClass('btn btn-warning btn-label waves-effect right waves-light rounded-pill');
            break;
        case 'approved':
            $('#status_modal').html('<i class="fas fa-check-circle label-icon align-middle rounded-pill fs-16 ms-2"></i> ' + status)
                .removeClass().addClass('btn btn-success btn-label waves-effect right waves-light rounded-pill');
            break;
        case 'disapproved':
        case 'cancelled':
            $('#status_modal').html('<i class="fas fa-times-circle label-icon align-middle rounded-pill fs-16 ms-2"></i> ' + status)
                .removeClass().addClass('btn btn-danger btn-label waves-effect right waves-light rounded-pill');
            break;
        default:
            $('#status_modal').text(status).removeClass().addClass('status status-' + status.toLowerCase().replace(/\s+/g, '-') + ' btn btn-no-shadow');
    }

    // Set values for other fields
    $('#farm_name_modal').val(farmName);
    $('#barangay_name_modal').val(barangayName);
    $('#area_modal').val(area);
    $('#address_modal').val(address);
    $('#farm_leader_modal').val(farmLeader);
    $('#title_land_modal').val(titleLand);

    // Concatenate pictures and set them to the #picture_land_modal input
    var concatenatedPictures = [pictureLand, pictureLand1, pictureLand2].filter(Boolean).join('<br>');
    $('#picture_land_modal').html(concatenatedPictures);

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




   function confirmArchive(id) {
        // Set the farm ID to be archived
        $("#archiveFarmBtn").data("farm-id", id);
        // Show the confirmation modal
        $("#archiveConfirmationModal").modal("show");
    }

    // Attach click event to archive button
    $("#archiveFarmBtn").click(function () {
        // Get the farm ID from the data attribute
        var id = $(this).data("farm-id");
        // Redirect to the archive route
        window.location.href = "/archive-farm/" + id;
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

function updateStatus(newStatus) {
    
    // Get the farm ID from the data attribute
    var id = $('#forInvestigationBtn').data('farm-id');

    // Perform an AJAX request to update the status
    $.ajax({
        url: '/update-status/' + id,
        type: 'POST', // Adjust the HTTP method if needed
        data: {
            _token: '{{ csrf_token() }}', // Add CSRF token if not using X-CSRF-Token header
            status: newStatus
        },
        success: function (data) {
            // Handle success response
            console.log('Status updated successfully');
            location.reload();
        },
        error: function (error) {
            // Handle error response
            console.log('Error updating status:', error);
        }
    });
    var statusModal = document.getElementById('status_modal');
    statusModal.textContent = newStatus;
    updateButtonVisibility(newStatus.toLowerCase().replace(/\s/g, '-'));
}



</script>
<style>


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