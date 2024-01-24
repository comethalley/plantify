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
                                <h5 class="card-title mb-0 flex-grow-1">Farm: &nbsp; {{ $farm->barangay_name }}</h5>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Farm</button>
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
        </ul>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
                
                console.log(data.farms);

                
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




            <!--end col-->

            <div class="col-xxl-3 col-sm-4 d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
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
                    <th scope="col" style="width: 40px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                        </div>
                    </th>
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
                
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
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
                    @case('for-visiting')
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
                        <button class="status status-{{ strtolower(str_replace(' ', '-', $farm->status)) }} btn btn-no-shadow">
                            {{ $farm->status }}
                        </button>
                @endswitch
            </td>
                            
                            <td>
                            <ul class="list-inline hstack gap-2 mb-0">
        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Application">
            <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="text-primary d-inline-block edit-item-btn" onclick="showFarmDetails('{{ $farm->id }}', '{{ $farm->farm_name }}', '{{ $farm->barangay_name }}', '{{ $farm->area }}', '{{ $farm->address }}', '{{ $farm->farm_leader }}', '{{ $farm->status }}')">
                <i class="ri-profile-line fs-3"></i>
            </a>
        </li>
    </ul>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Farm Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="status_modal" class="form-label custom-label">Status:</label>
                        <button id="status_modal" class="btn btn-primary btn-border"></button>
                        <br>
                        <br>
                        <label for="farm_name_modal" class="form-label custom-label">Farm Name:</label>
                        <input type="text" id="farm_name_modal" class="form-control" disabled>
                        <br>
                        <label for="barangay_name_modal" class="form-label custom-label">Barangay Name:</label>
                        <input type="text" id="barangay_name_modal" class="form-control" disabled>
                        <br>
                        <label for="area_modal" class="form-label custom-label">Area:</label>
                        <input type="text" id="area_modal" class="form-control" disabled>
                        <br>
                        <label for="address_modal" class="form-label custom-label">Address:</label>
                        <input type="text" id="address_modal" class="form-control" disabled>
                        <br>
                        <label for="farm_leader_modal" class="form-label custom-label">Farm Leader:</label>
                        <input type="text" id="farm_leader_modal" class="form-control" disabled>
                        <br>
                    </div>
                </div>
                
                <!-- Additional row with buttons -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <button class="btn rounded-pill btn-secondary">For Investigation</button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn rounded-pill btn-secondary">For Visiting</button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn rounded-pill btn-success">Approved</button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn rounded-pill btn-danger">Disapproved</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function showFarmDetails(id, farmName, barangayName, area, address, farmLeader, status) {
        switch (status.toLowerCase().replace(/\s+/g, '-')) {
            case 'created':
                $('#status_modal').html(status + '<i class="fas fa-check-double label-icon align-middle rounded-pill fs-16 ms-2"></i> ' )
                    .removeClass().addClass('btn btn-primary btn-label waves-effect right waves-light rounded-pill');
                break;
            case 'for-investigation':
            case 'for-visiting':
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

        $('#farm_name_modal').val(farmName);
        $('#barangay_name_modal').val(barangayName);
        $('#area_modal').val(area);
        $('#address_modal').val(address);
        $('#farm_leader_modal').val(farmLeader);
    }
</script>




<style>
    .custom-label {
        font-size: 1rem; /* Adjust the font size as needed */
    }
</style>


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
        <div class="noresult" style="display: none">
            <div class="text-center">
                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                <h5 class="mt-2">Sorry! No Result Found</h5>
                <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for your search.</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">
            <a class="page-item pagination-prev disabled" href="#">
                Previous
            </a>
            <ul class="pagination listjs-pagination mb-0"></ul>
            <a class="page-item pagination-next" href="#">
                Next
            </a>
        </div>
    </div>
</div>

<style>
.status {
        border-radius: 10px;
        padding: 15px;
        width: 200px;
        text-align: center;
    }



    </style>

    
@include('templates.footer')