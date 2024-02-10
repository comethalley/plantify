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
            <b style="color: blue; font-size: 16px;">FARM APPLICANTS</b><br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Farm Leader :</b> &nbsp;{{ strtoupper($farm->farm_leader) }}<br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Farm Name :</b> &nbsp;{{ strtoupper($farm->farm_name) }}<br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Area :</b> &nbsp;{{ strtoupper($farm->area) }}<br>
            <b style="font-family: 'Bahnschrift', sans-serif; font-size: 15px;">Address :</b> &nbsp;{{ strtoupper($farm->address) }}, {{ strtoupper($farm->barangay_name) }}<br>
          </td>

          <td class="status vertical-line">
    @switch(strtolower(str_replace(' ', '-', $farm->status)))
    @case('created')
        <button class="btn btn-primary btn-border btn-sm mx-auto mb-1"style="margin-bottom: 5px; padding: 1px;" onclick="return false;">{{ $farm->status }}</button>
        <button type="button" class="btn btn-light btn-icon waves-effect btn-sm"onclick="return false;">
            <i class="ri-question-line" style="font-size: 15px;"></i>
        </button>
        @break
    @case('for-investigation')
        <button class="btn btn-primary btn-border btn-sm" style="margin-bottom: 5px; padding: 1px;" onclick="return false;">{{ $farm->status }}</button>
        <button type="button" class="btn btn-light btn-icon waves-effect btn-sm"onclick="return false;">
            <i class="ri-question-line" style="font-size: 15px;"></i>
        </button>
        @break
    @case('for-visiting')
    @case('resubmit')
        <button class="btn btn-secondary btn-border btn-sm" style="margin-bottom: 5px; padding: 1px;" onclick="return false;">{{ $farm->status }}</button>
        <button type="button" class="btn btn-light btn-icon waves-effect btn-sm" onclick="return false;">
            <i class="ri-question-line" style="font-size: 15px;"></i>
        </button>
        @break
    @case('waiting-for-approval')
        <button class="btn btn-warning btn-border btn-sm" style="margin-bottom: 5px; padding: 1px;" onclick="return false;">{{ $farm->status }}</button>
        <button type="button" class="btn btn-light btn-icon waves-effect btn-sm" onclick="return false;">
            <i class="ri-question-line" style="font-size: 15px;"></i>
        </button>
        @break
    @case('approved')
        <button class="btn btn-success btn-border btn-sm" style="margin-bottom: 5px; padding: 1px;" onclick="return false;">{{ $farm->status }}</button>
        <button type="button" class="btn btn-light btn-icon waves-effect btn-sm" onclick="return false;">
            <i class="ri-question-line" style="font-size: 15px;"></i>
        </button>
        @break
    @case('disapproved')
    @case('cancelled')
        <button class="btn btn-danger btn-border btn-sm" style="margin-bottom: 5px; padding: 1px;" onclick="return false;">{{ $farm->status }}</button>
        <button type="button" class="btn btn-light btn-icon waves-effect btn-sm" onclick="return false;">
            <i class="ri-question-line" style="font-size: 15px;"></i>
        </button>
        @break
    @default
    @endswitch


            <br>
            <button class="btn btn-success btn-border equal-width-validation" style="font-weight: bold;">Validation Remarks</button>
            <br>
            <i style="font-size: 13px;">Click "Validation Remarks" for more specific updates</i>
          </td>

          <td class="actions vertical-line">
          <div class="centered-container times-new-roman-bold">
    <ul class="list-inline hstack gap-2 mb-0">
        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
            <a href="#" data-bs-toggle="modal" data-bs-target="#viewModals" class="btn btn-outline-secondary text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn mt-2" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}', '{{ $farm->title_land }}', '{{ $farm->picture_land }}', '{{ $farm->picture_land1 }}', '{{ $farm->picture_land2 }}'); updateButtonVisibility('{{ $farm->status }}');">
                <div class="d-flex align-items-center">
                    <i class="ri-profile-line fs-3 me-2 black"></i>
                    <span class="black">View Application</span>
                </div>
            </a>
        </li>
    </ul>
</div>

<div class="centered-container times-new-roman-bold">
    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Cancel Application">
        <a href="#" class="btn btn-outline-danger waves-effect waves-light text-primary d-inline-block edit-item-btn d-flex align-items-center justify-content-center custom-btn1 mt-2" onclick="confirmArchive('{{ $farm->id }}')">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-cancel fs-3 me-2 black"></i>
                <span class="black">Cancel Application</span>
            </div>
        </a>
    </li>
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


    <!-- Modal -->
<div class="modal fade" id="archiveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="archiveConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveConfirmationModalLabel">Cancel Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Cancel your application?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="archiveFarmBtn">Yes</button>
            </div>
        </div>
    </div>
</div>
    

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
    <div>
        <a id="title_land_modal" href="#" target="_blank" class="pdf-link">
            View PDF for Farm <span id="farm_id_placeholder"></span> - <span id="title_land_placeholder"></span>
        </a>
    </div>

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
    <div class="col-md-12">
        <label for="picture_land_modal" class="form-label custom-label">Picture of land:</label>
            <div>
                <a id="picture_land_modal" href="#" target="_blank" class="pdf-link">
                    View IMG for Farm 
                </a>
            </div>
            <div>
                <a id="picture_land_modal1" href="#" target="_blank" class="pdf-link">
                    View IMG for Farm 
                </a>
            </div>
            <div>
                <a id="picture_land_modal2" href="#" target="_blank" class="pdf-link">
                    View IMG for Farm
                </a>
            </div>
    </div>
</div>

                <!-- Additional row with buttons -->
            </div>
        </div>
    </div>
</div>
</div>
</div>







<!-- Add this modal at the end of your Blade file -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
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
    
    $('#title_land_modal')
    .attr('href', "/view-pdf/" + id)
    .attr('target', '_blank')
    .text('View PDF for Farm ' + id); 
    
    $('#picture_land_modal')
    .attr('href', "/view-image/" + id)
    .attr('target', '_blank')
    .text('View IMG for Farm ' + id);
    
    if (pictureLand1) {
    $('#picture_land_modal1')
        .attr('href', "/view-image1/" + id)
        .attr('target', '_blank')
        .text('View IMG for Farm ' + id)
        .show(); // Ensure the link is visible
} else {
    // Hide the link if pictureLand1 has no value
    $('#picture_land_modal1').hide();
}

// Check if pictureLand2 has a value before setting the link
if (pictureLand2) {
    $('#picture_land_modal2')
        .attr('href', "/view-image2/" + id)
        .attr('target', '_blank')
        .text('View IMG for Farm ' + id)
        .show(); // Ensure the link is visible
} else {
    // Hide the link if pictureLand2 has no value
    $('#picture_land_modal2').hide();
} // You can customize the text as needed
    // Concatenate pictures and set them to the #picture_land_modal input
    

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


</script>
<style>

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