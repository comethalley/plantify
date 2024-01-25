@include('templates.header')
<div class="main-content">
    <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Districts 5</h4>

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
                                        <input type="text" class="form-control" id="searchMemberList" placeholder="Search for farms or designation...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-auto ms-auto">
                                    <div class="list-grid-nav hstack gap-1">
                                    <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="ri-more-2-fill"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" href="#">All</a></li>
                                            <li><a class="dropdown-item" href="#">Last Week</a></li>
                                            <li><a class="dropdown-item" href="#">Last Month</a></li>
                                            <li><a class="dropdown-item" href="#">Last Year</a></li>
                                        </ul>
                                        <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 active filter-button"><i class="ri-archive-fill"></i></button>
                                        
                                        <button class="btn btn-success addFarms-modal" data-bs-toggle="modal" data-bs-target="#addfarmModal">
    <i class="ri-add-fill me-1 align-bottom"></i> Add Farms
</button>

                                    </div>
                                </div>
                                
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        </div>
                        
                        <div class="modal fade" id="addfarmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Create Farms&nbsp;</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="addFarmForm" data-action="/add-farms" method="post"> <!-- Correct the action attribute -->
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id-field" />
                    <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Barangay Name</label>
                        <input type="text" name="barangay-name" id="customername-field" class="form-control" placeholder="Enter Barangay name" required /> <!-- Correct the input name attribute -->
                    </div>
                    <div class="alert alert-danger" style="display:none" id="error-messages"></div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="submitForm()">Add Barangay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        // Clear previous error messages
        document.getElementById('error-messages').style.display = 'none';
        document.getElementById('error-messages').innerHTML = '';

        // Perform asynchronous form submission
        var form = document.getElementById('addFarmForm');
        var formData = new FormData(form);

        fetch(form.getAttribute('data-action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // If success, reload the page
                location.reload();
            } else {
                // If errors, display error messages
                document.getElementById('error-messages').style.display = 'block';
                for (var key in data.errors) {
                    document.getElementById('error-messages').innerHTML += '<p>' + data.errors[key][0] + '</p>';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

                        <div class="row">
    <div class="col-lg-12">
        <div id="teamlist">
            <div class="team-list grid-view-filter row" id="team-member-list">
            @if(isset($barangays) && count($barangays) > 0)
                 @foreach($barangays as $barangay)
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
                                                            
                                                            <a class="dropdown-item" href="{{ route('archive.barangay', ['id' => $barangay->id]) }}">
                                                                <i class="ri-archive-line me-2 align-bottom text-muted"></i>Archive
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
                                                        <h5>{{ $barangay->barangay_name }}</h5>
                                                    </a>
                                                    <p>Barangay</p>
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
<a href="{{ route('farms.view', ['barangay_name' => $barangay->barangay_name]) }}" class="btn btn-light view-btn">View Farms</a>


</div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No farms found.</p>
                @endif

                
            </div>
        </div>
    </div>
    
</div>






@include('templates.footer')