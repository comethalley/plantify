@include('templates.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">District 5</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Farm management</a></li>
                                <li class="breadcrumb-item active">Farms</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <div class="search-box">
                                <input type="text" class="form-control" id="searchMemberList" placeholder="Search for barangay names ...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="list-grid-nav hstack gap-1">
                                @if(Auth::check())
                                @if(Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
                                <button class="btn btn-primary btn-label waves-effect waves-light" onclick="openTestPage()">
                                    <i class="ri-inbox-archive-line label-icon align-middle fs-16 me-2"></i> View Archive Farm
                                </button>
                                @endif
                                @endif
                                <button class="btn btn-danger addFarms-modal" data-bs-toggle="modal" data-bs-target="#addfarmModal">
                                    <i class="ri-add-line align-bottom me-1"></i> Add Farm
                                </button>
                            </div>
                        </div>
                    </div>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0" style="position: relative; overflow: hidden;">
                                                        <img src="{{ asset('assets/images/farms/planting.png') }}" style="position: absolute; top: 50%; left: 48%; transform: translate(-50%, -50%); width: 4rem; height: 4rem;" alt="Planting Image">
                                                    </div>
                                                    <div class="team-content">
                                                        <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">
                                                            <h5 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 2em;">{{ $barangay->barangay_name }}</h5>
                                                        </a>
                                                        <p style="margin-bottom: 0em;">Barangay</p>
                                                    </div>
                                                </div>
                                                <hr class="my-2 hr-animation">

                                            </div>
                                            <div class="col-lg-4 col">
                                                @if(Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
                                                <div class="col-lg-4 col">
                                                    <div class="row text-muted text-center">
                                                        <div class="col-6  mx-auto">
                                                            <h5 id="farm-count" class="mb-1 projects-num blade-animation">{{ sprintf('%02d', $barangay->farms_count) }}</h5>
                                                            <p class="text-muted mb-0">Number of Farms</p>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2 hr-animation">

                                                </div>
                                                <div class="text-end mx-auto text-center">
                                                    <div style="display: inline-block;">
                                                    <a href="{{ route('farms.view', ['barangay_name' => $barangay->barangay_name]) }}" class="btn btn-custom">
                                                        View Farm Applications
                                                    </a>
                                                    <br>
                                                    <br>
                                                    <i style="font-size: 13px;">Click "View Farm Applications" to see the farms</i>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">
                                    <div id="lordIconContainer" style="text-align: center;"></div>
                                    <p id="noFarmsMessage" style="text-align: center; font-size: 21px;">No Barangays Farms found.</p>
                                </td>
                            </tr>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="noFarmsMessageContainer" style="display: none;">
                    <td colspan="7">
                        <div id="lordIconContainer" style="text-align: center;"></div>
                        <p id="noFarmsMessage" style="text-align: center; font-size: 21px;">No Barangays Farms found.</p>
                    </td>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-secondary d-flex align-items-center justify-content-center mb-3" onclick="goBack()">
                            <i class="ri-arrow-left-line me-1"></i> Back
                        </button>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="addfarmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Add Farm &nbsp;</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form id="addFarmForm" action="" method="post">
                            @csrf
                            <div class="modal-body">
                                <label for="barangay-name" class="form-label">Barangay: &nbsp;</label>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="selectedBarangayBtn" title="This field is required to select">Select barangay</button>
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
                                    <div class="col-md-9">
                                        <label for="farm_name" class="form-label">Farm Name</label>
                                        <input type="text" name="farm_name" class="form-control" title="This field is required to fill up" placeholder="Enter Farm Name" required />
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <label for="farm_leader" class="form-label">Farm Leader</label>
                                        <select name="farm_leader" id="farmLeaderDropdown" class="form-select" title="This field is required to select">
                                            <option disabled selected>Select Farm Leader</option>
                                            @foreach ($farmLeaders as $user)
                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <div class="col-md-3">
                                        <label for="area" class="form-label"> &nbsp; Area (sqm)</label>
                                        <input type="text" name="area" class="form-control" title="This field is required to fill up" placeholder="Enter Area" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label"> &nbsp; Address</label>
                                        <input type="text" name="address" class="form-control" title="This field is required to fill up" placeholder="Enter Address" required />

                                
                                    </div>
                                    
                                </div>

                                <!-- <label for="title_land" class="form-label">Title Land</label>
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
                                <br> -->
                            </div>
                            <div class="alert alert-danger" style="display:none" id="error-messages"></div>
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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
                function goBack() {
                    window.location.href = "/dashboard/analytics";
                    window.onload = function() {
                        window.location.reload(true);
                    };
                }

                function cancelUpload(inputName) {
                    $('input[name="' + inputName + '"]').val(null);
                }

                function openTestPage() {
                    window.location.href = '/view-archivefarms';
                }


                function selectBarangay(barangay) {
                    document.getElementById('selectedBarangayBtn').innerHTML = barangay;
                    document.getElementById('selectedBarangay').value = barangay;
                }

                function submitForm() {
    document.getElementById('error-messages').style.display = 'none';
    var form = document.getElementById('addFarmForm');
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
    .catch(error => console.error('Error:', error));
}



                $(document).ready(function() {
                    $('#searchMemberList').on('keyup', function() {
                        var searchText = $(this).val().toLowerCase();
                        var resultCount = 0; // Initialize result count
                        $('.team-list .card.team-box').each(function() {
                            var barangayName = $(this).find('.team-content .member-name').text().toLowerCase();
                            if (barangayName.includes(searchText)) {
                                $(this).closest('.col').show();
                                resultCount++; // Increment result count for each match found
                            } else {
                                $(this).closest('.col').hide();
                            }
                        });
                        // Display message if no results found
                        if (resultCount === 0) {
                            $('#noFarmsMessageContainer').show();
                        } else {
                            $('#noFarmsMessageContainer').hide();
                        }
                        // Hide message if search input is empty
                        if (searchText === "") {
                            $('#noFarmsMessageContainer').hide();
                        }
                    });
                });


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
                                .btn-custom {
    background: linear-gradient(to bottom, #4CAF50, #45a049);
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 20px; /* Rounded corners */
}

.btn-custom:hover {
    background: linear-gradient(to bottom, #45a049, #4CAF50);
}
                @keyframes bladeOpen {
                    0% {
                        transform: translateY(100%);
                    }

                    100% {
                        transform: translateY(0);
                    }
                }

                .hr-animation {
                    animation: hrOpen 1s ease forwards;
                    width: 100%;
                    /* Ensure the <hr> spans the entire width */
                    opacity: 0;
                    /* Start the animation with element hidden */
                }
                @keyframes bladeOpen {
                    0% {
                        transform: translateY(100%);
                    }

                    100% {
                        transform: translateY(0);
                    }
                }

                .hr-animation {
                    animation: hrOpen 1s ease forwards;
                    width: 100%;
                    /* Ensure the <hr> spans the entire width */
                    opacity: 0;
                    /* Start the animation with element hidden */
                }

                @keyframes hrOpen {
                    from {
                        opacity: 0;
                        transform: scaleX(0);
                        /* Start with the <hr> completely collapsed */
                    }

                    to {
                        opacity: 1;
                        transform: scaleX(1);
                        /* Expand the <hr> to its full width */
                    }
                }

                .blade-animation {
                    animation: bladeOpen 1s ease forwards;
                    white-space: nowrap;
                    word-wrap: normal;
                    opacity: 0;
                    /* Start the animation with element hidden */
                }

                @keyframes bladeOpen {
                    from {
                        opacity: 0;
                        transform: translateX(-100%);
                    }

                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }


                .disabled {
                    pointer-events: none;
                    opacity: 1;
                }

                .team-box {
                    border: 1px solid #e5e5e5;
                    border-radius: 10px;
                    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
                    transition: box-shadow
                }

                .team-box:hover {
                    box-shadow: rgba(0, 0, 0, 0.4) 0px 4px 8px, rgba(0, 0, 0, 0.3) 0px 14px 26px -3px, rgba(0, 0, 0, 0.2) 0px -6px 0px inset;
                }

                .text-end {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100%;
                }

                .button-89 {
                    --b: 3px;
                    --s: .45em;
                    --color: #373B44;

                    padding: calc(.5em + var(--s)) calc(.9em + var(--s));
                    color: var(--color);
                    --_p: var(--s);
                    background:
                        conic-gradient(from 90deg at var(--b) var(--b), #0000 90deg, var(--color) 0) var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
                    transition: .3s linear, color 0s, background-color 0s;
                    outline: var(--b) solid #0000;
                    outline-offset: .6em;
                    font-size: 16px;

                    border: 0;

                    user-select: none;
                    -webkit-user-select: none;
                    touch-action: manipulation;
                    text-decoration: none;
                    display: inline-block;
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
                    width: calc(100% - 78px);
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
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Casas.
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