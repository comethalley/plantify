
@include('templates.header')
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">District 5, Quezon City Metro Manila Farm Map</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                
                                <li class="breadcrumb-item active">Map</li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">District 5, Quezon City Metro Manila</h4>
                        @if(auth()->user()->role_id == 1)
                        {{-- Display only for role_id 1 (Admin) --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFarmLocationModal">Add Farm Location</button>
                        @elseif(auth()->user()->role_id == 2)
                        {{-- Display only for role_id 2 (Admin) --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFarmLocationModal">Add Farm Location</button>
                        @elseif(auth()->user()->role_id == 3)
                        {{-- Display for role_id 3 (Farm Leader) --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFarmLocationModal">Add Farm Location</button>
                        @elseif(auth()->user()->role_id == 4)
                        {{-- Display for role_id 4 (Farmers) --}}
                        <button hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFarmLocationModal">Add Farm Location</button>
                        @elseif(auth()->user()->role_id == 5)
                        {{-- Display for role_id 5 (Public Users) --}}
                        <button hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFarmLocationModal">Add Farm Location</button>
                        @endif
                        
                    </div>
                    <div class="card-body">
                    
                        <div id="leaflet-map" class="leaflet-map" style="height: 73vh; width: 100%"></div>
                    </div>
                </div>
            </div>

        </div>

            <!-- end row -->
    </div>
        <!-- container-fluid -->
        <!-- Add Farm Location Modal -->
            <div class="modal fade" id="addFarmLocationModal" tabindex="-1" role="dialog" aria-labelledby="addFarmLocationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFarmLocationModalLabel">Add Farm Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your form fields here (e.g., latitude, longitude, location name) -->
                            <form id="addFarmLocationForm">
                                <!-- Example: Latitude -->
                                <div class="form-group">
                                    <label for="latitude">Latitude:</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" required>
                                </div>

                                <!-- Example: Longitude -->
                                <div class="form-group">
                                    <label for="longitude">Longitude:</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                                </div>

                                <!-- Example: Location Name -->
                                <div class="form-group">
                                    <label for="locationName">Farm Name:</label>
                                    <input type="text" class="form-control" id="locationName" name="locationName" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="address">Exact Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Location</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>




</div>
    <!-- End Page-content -->

    <!--end back-to-top-->
    @include('templates.footer')
    <!--preloader-->

    <!-- Include Leaflet library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- Include Leaflet library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Include Leaflet JS -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize the map
    var map = L.map('leaflet-map').setView([14.717499241909843, 121.04829782475622], 14);

    var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© Plantify'
    }).addTo(map);

    $(document).ready(function () {
        // Fetch farm locations from the server on page load
        $.ajax({
            url: '/get_maps',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log('Farm locations retrieved successfully:', data);
                displayFarmLocations(data); // Display farm locations on the map
            },
            error: function (xhr, status, error) {
                console.error('Error retrieving farm locations:', error);
            },
        });
    });

    // Function to display farm locations on the map
    function displayFarmLocations(farmLocations) {
    farmLocations.forEach(function (location) {
        if (location.latitude && location.longitude) {
            // Create a custom HTML string for the popup content
            var popupContent = "<b>Farm Name: " + location.location_name + "</b><br>Address: " + location.address;

            // Create a marker and bind a popup with custom content
            L.marker([parseFloat(location.latitude), parseFloat(location.longitude)], { icon: redIcon })
                .addTo(map)
                .bindPopup(popupContent);
        }
    });
}


    // Form submission handler
    $('#addFarmLocationForm').submit(function (e) {
        e.preventDefault();

        // Get form values
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var locationName = $('#locationName').val();
        var address = $('#address').val();

        // Make an AJAX request to store the farm location in the backend
        $.ajax({
            url: '/farm_locations',
            method: 'POST',
            data: {
                latitude: latitude,
                longitude: longitude,
                location_name: locationName,
                address: address,
            },
            success: function (data) {
                        // Assuming your Laravel controller returns a JSON response with a success message
                        console.log(data.message);
                        Swal.fire({
                        title: "Farm Location added Successfully",
                        icon: "success"
                    });
                    if (data.latitude && data.longitude) {
                        L.marker([parseFloat(data.latitude), parseFloat(data.longitude)], { icon: redIcon })
                        .addTo(map)
                        .bindPopup(data.location_name);
                    }
                    setTimeout(function() {
                        location.reload(); // Reload the page after 2 seconds
                    }, 2000);
                    },
                    error: function (error) {       
                    Swal.fire({
                        title: "Error",
                        text: "Error Adding Farm Location. Please try again.",
                        icon: "error"
                    });
                    }
        });

        // Close the modal
        $('#addFarmLocationModal').modal('hide');
    });
</script>
