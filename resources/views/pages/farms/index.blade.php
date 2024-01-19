@include('templates.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-content">
    <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Districts</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Farm management</a></li>
                                        <li class="breadcrumb-item active">Farms</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
<!-- end page title -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <div class="search-box">
                                        <input type="text" class="form-control" id="searchMemberList" placeholder="Search for name or designation...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-auto ms-auto">
                                    <div class="list-grid-nav hstack gap-1">
                                        <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 active filter-button"><i class="ri-grid-fill"></i></button>
                                        <button type="button" id="list-view-button" class="btn btn-soft-info nav-link  btn-icon fs-14 filter-button"><i class="ri-list-unordered"></i></button>
                                        <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="ri-more-2-fill"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" href="#">All</a></li>
                                            <li><a class="dropdown-item" href="#">Last Week</a></li>
                                            <li><a class="dropdown-item" href="#">Last Month</a></li>
                                            <li><a class="dropdown-item" href="#">Last Year</a></li>
                                        </ul>
                                        <button class="btn btn-success addFarms-modal" data-bs-toggle="modal" data-bs-target="#addFarmModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Farms</button>

                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        </div>
                        <div class="modal fade" id="addFarmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body">
                <form action="{{ route('saveFarms') }}" method="post" enctype="multipart/form-data" autocomplete="off" id="farm-form" class="needs-validation" novalidate="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" name="farmid-input" id="farmid-input" class="form-control" value="">
                            <div class="px-1 pt-1">
                                <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                    <img src="assets/images/small/img-9.jpg" alt="" id="cover-img" class="img-fluid">
                                    <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                        <div class="flex-grow-1">
                                            <h5 class="modal-title text-white" id="createFarmLabel">Add New Farm</h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="d-flex gap-3 align-items-center">
                                                <div>
                                                    <label for="cover-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Select Cover Image" data-bs-original-title="Select Cover Image">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                <i class="ri-image-fill"></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input class="form-control d-none" name="cover-image-input" id="cover-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                </div>
                                                <button type="button" class="btn-close btn-close-white" id="createFarmBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-4 mt-n5 pt-2">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute bottom-0 end-0">
                                        <label for="farm-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Select Farm Image" data-bs-original-title="Select Farm Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" name="farm-image-input" id="farm-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded-circle">
                                            <img src="assets/images/users/user-dummy-img.jpg" id="farm-img" class="avatar-md rounded-circle h-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="farmName" class="form-label">Farm Name</label>
                                <input type="text" class="form-control" name="farmName" id="farmName" placeholder="Enter farm name" required="">
                                <div class="invalid-feedback">Please enter a farm name.</div>
                            </div>
                            <div class="mb-4">
                                <label for="area" class="form-label">Area</label>
                                <input type="text" class="form-control" name="area" id="area" placeholder="Enter area" required="">
                                <div class="invalid-feedback">Please enter the area.</div>
                            </div>
                            <input type="hidden" name="project-input" id="project-input" class="form-control" value="">
                            <input type="hidden" name="task-input" id="task-input" class="form-control" value="">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="addNewFarm">Add Farm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>
<!--end modal-->




                        <div class="row">
    <div class="col-lg-12">
        <div id="teamlist">
            <div class="team-list grid-view-filter row" id="team-member-list">
                @if(isset($farms) && count($farms) > 0)
                    @foreach($farms as $farm)
                        <div class="col">
                            <div class="card team-box">
                                <div class="team-cover">
                                    <img src="{{ asset('assets/images/small/img-9.jpg') }}" alt="" class="img-fluid">
                                </div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center team-row">
                                        <div class="col team-settings">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="flex-shrink-0 me-2">
                                                        <button type="button" class="btn btn-light btn-icon rounded-circle btn-sm favourite-btn">
                                                            <i class="ri-star-fill fs-14"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12">
                                                                <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12">
                                                                <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="team-profile-img">
                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="member-img img-fluid d-block rounded-circle">
                                                </div>
                                                <div class="team-content">
                                                    <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">
                                                        <h5>{{ $farm->farm_name }}</h5>
                                                    </a>
                                                    <p>{{ $farm->area }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="row text-muted text-center">
                                                <div class="col-6 border-end border-end-dashed">
                                                    <h5 class="mb-1 projects-num">225</h5>
                                                    <p class="text-muted mb-0">Projects</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-1 tasks-num">197</h5>
                                                    <p class="text-muted mb-0">Tasks</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col">
                                            <div class="text-end">
                                                <a href="{{ url('pages-profile.html') }}" class="btn btn-light view-btn">View Farms</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
        <!-- Load More button -->
        <div class="text-center mb-3">
            <a href="javascript:void(0);" class="text-success load-more-btn"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load More </a>
        </div>
    @else
        <!-- No farms found message -->
        <div class="text-center mb-3 no-farms-message">
            No farms found.
        </div>
    @endif
</div>
        </div>
    </div>


</div>
<script>
    

  

    document.getElementById('saveFarms').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Get details from the form
    const farmName = document.getElementById('farmName').value;
    const area = document.getElementById('area').value;
    const address = document.getElementById('address').value;
    const farm_leader = document.getElementById('farm_leader').value;
    const createdBy = document.getElementById('createdBy').value;
    const status = document.getElementById('status').value;

    // Make an AJAX request to save to the database
    fetch('{{ route("saveFarms") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            // Add any additional headers if needed
        },
        body: JSON.stringify({
            farmName: farmName,
            area: area,
            address: address,
            farm_leader: farm_leader,
            createdBy: createdBy,
            status: status,
            // Add other details from the form if needed
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the server if needed
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});


</script>

<footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script>© Casas.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design &amp; Develop by SBIT-4C
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
@include('templates.footer')