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
                                        <input type="text" class="form-control" id="searchMemberList" placeholder="Search for farms or status....">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-auto ms-auto">
                                    <div class="list-grid-nav hstack gap-1">

                                    @if(Auth::check())
                                        @if(Auth::user()->role_id == 1)
                                            <button class="btn btn-primary btn-label waves-effect waves-light" onclick="openTestPage()">
                                                <i class="ri-inbox-archive-line label-icon align-middle fs-16 me-2"></i> View Archive Farm
                                            </button>
                                        @endif
                                    @endif




    <button class="btn btn-danger addFarms-modal" data-bs-toggle="modal" data-bs-target="#addfarmModal">
        <i class="ri-add-line align-bottom me-1"></i> Create Farm
    </button>

                                    </div>
                                </div>
                                
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        </div>
          
<div class="row">          
    <div class="col-lg-12">
   
        <div id="teamlist">
            <div class="team-list grid-view-filter row" id="team-member-list">
            @if(isset($barangays) && count($barangays) > 0)
                 @foreach($barangays as $barangay)      
                        <div class="col">
                            <div class="card team-box">
                                <div class="team-cover">
                                <img src="https://cdn.dribbble.com/users/1162077/screenshots/4008153/city-skyline.gif" alt="CSS3 Pattern" class="img-fluid">

                                </div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center team-row">
                                        <div class="col team-settings">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="flex-shrink-0 me-2">
                                                        <button type="button" class="btn btn-light btn-icon rounded-circle btn-sm favourite-btn">
                                                            <i class=" ri-folder-5-line fs-14"></i>
                                                        </button>
                                                    </div>
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
                                                    <p class="text-muted mb-0">Farms</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-1 tasks-num">197</h5>
                                                    <p class="text-muted mb-0">Tasks</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col">
                                        @if(Auth::check() && Auth::user()->role_id == 3)
    
    <div class="text-end">
        <a href="{{ route('farms.view3', ['barangay_name' => $barangay->barangay_name]) }}" class="button-89">View Farms</a>
    </div>
   
@elseif(Auth::check() && Auth::user()->role_id == 1)
    <div class="text-end">
        <a href="{{ route('farms.view', ['barangay_name' => $barangay->barangay_name]) }}" class="button-89">View Farms</a>
    </div>
@endif

                                            
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



<div class="modal fade" id="addfarmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Create Farms &nbsp;</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="addFarmForm" data-action="/add-farms" method="post">
                @csrf
                <div class="modal-body">
                    <label for="barangay-name" class="form-label">Barangay: &nbsp;</label>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="selectedBarangayBtn" title="This field is required to select" >Select barangay</button>
                        <div class="dropdown-menu">
                            <!-- Add your barangay dropdown items here -->
                            <a class="dropdown-item" href="#" onclick="selectBarangay('BagBag')">BagBag</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Capri')">Capri</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Fairview')">Fairview</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Gulod')">Gulod</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Greater Lagro')">Greater Lagro</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Kaligayahan')">Kaligayahan</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Nagkaisang Nayon')">Nagkaisang Nayon</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('North Fairview')">North Fairview</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Novaliches Proper')">Novaliches Proper</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Pasong Putik Proper')">Pasong Putik Proper</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('San Agustin')">San Agustin</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('San Bartolome')">San Bartolome</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Sta. Lucia')">Sta. Lucia</a>
                            <a class="dropdown-item" href="#" onclick="selectBarangay('Sta. Monica')">Sta. Monica</a>
                        </div>
                        <input type="hidden" name="barangay_name" id="selectedBarangay" required>
                    </div>
                    <br><br>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="farm_name" class="form-label">Farm Name</label>
                            <input type="text" name="farm_name" class="form-control" title="This field is required to fill up" placeholder="Enter Farm Name" required />
                        </div>
                        <div class="col-md-6">
                            <label for="farm_leader" class="form-label">Farm Leader</label>
                                <select name="farm_leader" id="farmLeaderDropdown" class="form-select" title="This field is required to select">
                                    <option disabled selected>Select Farm Leader</option>
                                        @foreach ($farmLeaders as $user)
                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                        @endforeach
                                </select>
                        </div>


                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="address" class="form-label"> &nbsp; Address</label>
                            <input type="text" name="address" class="form-control"  title="This field is required to fill up" placeholder="Enter Address" required />
                        </div>
                        <div class="col-md-6">
                            <label for="area" class="form-label"> &nbsp; Area</label>
                            <input type="text" name="area" class="form-control" title="This field is required to fill up" placeholder="Enter Area" required />
                        </div>
                    </div>

                    <label for="title_land" class="form-label">Title Land</label>
                    <input type="file" name="title_land" class="form-control" title="This field is required to fill up" accept=".pdf, .doc, .docx" required />
                    <br>
                    <label for="picture_land" class="form-label">Picture Land</label>
                    <input type="file" name="picture_land" class="form-control" title="This field is required to fill up" accept="image/*" required />
                    <br>
                    <div class="file-input-container">
        <div class="file-input-wrapper">
            <input type="file" name="picture_land1" class="form-control file-input" accept="image/*">
            <button type="button" class="btn btn-danger cancel-btn" onclick="cancelUpload('picture_land1')">Cancel</button>
        </div>
    </div>

    <div class="file-input-container">
        <div class="file-input-wrapper">
            <input type="file" name="picture_land2" class="form-control file-input" accept="image/*">
            <button type="button" class="btn btn-danger cancel-btn" onclick="cancelUpload('picture_land2')">Cancel</button>
        </div>
    </div>

                    <br>

                </div>
                <div class="alert alert-danger" style="display:none" id="error-messages"></div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="submitForm()">Add Farm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

 




<script>
   

   function cancelUpload(inputName) {
        // Clear the selected file for the specified input
        $('input[name="' + inputName + '"]').val(null);
    }
   function openTestPage() {
        window.location.href = '{{ route('archivefarms.xfarms') }}';
    }
    

    function selectBarangay(barangay) {
        document.getElementById('selectedBarangayBtn').innerHTML = barangay;
        document.getElementById('selectedBarangay').value = barangay;
    }

    function submitForm() {
        // Clear previous error messages
        document.getElementById('error-messages').style.display = 'none';


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

<style>

.team-box {
        border: 1px solid #e5e5e5; /* Add a border to the card */
        border-radius: 10px; /* Adjust the border-radius to your preference */
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        /* Add the box-shadow with your specified values */
        transition: box-shadow 0.3s ease; /* Optional: Add a transition for a smooth effect */
    }

    .team-box:hover {
        box-shadow: rgba(0, 0, 0, 0.4) 0px 4px 8px, rgba(0, 0, 0, 0.3) 0px 14px 26px -3px, rgba(0, 0, 0, 0.2) 0px -6px 0px inset;
        /* Adjust the box-shadow for the hover effect */
    }
    .text-end {
        display: flex;
        justify-content: center; /* Center the content horizontally */
        align-items: center; /* Center the content vertically */
        height: 100%; /* Ensure the container takes the full height */
    }

    .button-89 {
        --b: 3px;   /* border thickness */
        --s: .45em; /* size of the corner */
        --color: #373B44;
        
        padding: calc(.5em + var(--s)) calc(.9em + var(--s));
        color: var(--color);
        --_p: var(--s);
        background:
            conic-gradient(from 90deg at var(--b) var(--b),#0000 90deg,var(--color) 0)
            var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
        transition: .3s linear, color 0s, background-color 0s;
        outline: var(--b) solid #0000;
        outline-offset: .6em;
        font-size: 16px;

        border: 0;

        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        text-decoration: none; /* Add this line to remove underlines from anchor tags */
        display: inline-block; /* Add this line to remove anchor tags' default styles */
    }

    .button-89:hover,
    .button-89:focus-visible {
        --_p: 0px;
        outline-color: var(--color);
        outline-offset: .05em;
    }

    .button-89:active {
        background: var(--color);
        color: #fff;
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
        width: calc(100% - 78px); /* Adjust width based on button width and margins */
        display: inline-block;
    }

    .cancel-btn {
        position: absolute;
        right: 0;
    }
    </style>
<footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Casas.
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