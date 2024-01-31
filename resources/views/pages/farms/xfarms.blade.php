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

           
                <div class="col-lg-12">
                    <div class="card" id="tasksList">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Archive Farms</h5>
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
                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for id or old id...">
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
            <li><a class="dropdown-item" href="javascript:void(0);">Disapproved</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Cancelled</a></li>
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
                    
                    <th class="sort text-center" data-sort="id">Farm ID &nbsp;</th>
                    <th class="sort text-center" data-sort="old_id">Old Farm ID &nbsp;</th>
                    <th class="sort text-center" data-sort="farm_name">Farm Name &nbsp;</th>
                    <th class="sort text-center" data-sort="barangay_name">Barangay &nbsp;</th>
                    <th class="sort text-center" data-sort="area">Area &nbsp;</th>
                    <th class="sort text-center" data-sort="address">Address &nbsp;</th>
                    <th class="sort text-center" data-sort="farm_leader">Farm Leader &nbsp;</th>
                    <th class="sort text-center" data-sort="status">Status &nbsp;</th>

                </tr>
            </thead>
            @if(isset($archivefarms) && count($archivefarms) > 0)
        @foreach($archivefarms as $key => $archivefarm)
            <tbody id="farmTableBody" class="list form-check-all">
           
            <tr class="farm-row {{ strtolower(str_replace(' ', '-', $archivefarm->status)) }}">
                
                            
                            <td class="id text-center">#{{ $archivefarm->id }}</td>
                            <td class="old_id text-center">#{{ $archivefarm->old_id }}</td>
                            <td class="farm_name text-center">{{ $archivefarm->farm_name }}</td>
                            <td class="barangay_name text-center">{{ $archivefarm->barangay_name }}</td>
                            <td class="area text-center">{{ $archivefarm->area }}</td>
                            <td class="address text-center">{{ $archivefarm->address }}</td>
                            <td class="farm_leader text-center">{{ $archivefarm->farm_leader }}</td>
                            <td class="status text-center">{{ $archivefarm->status }}</td>
                           
                               
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
        // Assuming you are using Bootstrap 5
        $('#archiveFarmModal').on('show.bs.modal', function (e) {
            // Load the content of the 'test' blade file into the modal body
            $('#archiveFarmModal .modal-body').load('{{ route('archivefarms.xfarms') }}');
        });
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