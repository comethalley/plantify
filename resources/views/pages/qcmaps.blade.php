
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
                        <h4 class="mb-sm-0">Farm Map</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                
                                <li class="breadcrumb-item active">Farm Map</li>
                                
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFarmLocationModal">Add Farm Location</button>
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
                                    <label for="locationName">Location Name:</label>
                                    <input type="text" class="form-control" id="locationName" name="locationName" required>
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    // Define predefined markers
    var predefinedLocations = [
        { coords: [14.696581413419649, 121.03241984130206], name: 'BagBag' },
        { coords: [14.717054785291488, 121.0284830908979], name: 'Capri' },
        { coords: [14.703781994760133, 121.06858143870275], name: 'Fairview' },
        { coords: [14.7110264787141, 121.04022213300071], name: 'Gulod' },
        { coords: [14.731531502207597, 121.06361814840842], name: 'Greater Lagro' },
        { coords: [14.735610007825965, 121.04624201654802], name: 'Kaligayahan' },
        { coords: [14.720497333320369, 121.02353995741312], name: 'Nagkaisang Nayon' },
        { coords: [14.712841342613753, 121.06136698356038], name: 'North Fairview' },
        { coords: [14.72159192206426, 121.03724325170134], name: 'Novaliches Proper' },
        { coords: [14.721023889807322, 121.05021447950583], name: 'Pasong Putik Proper' },
        { coords: [14.731079865181144, 121.03514900127126], name: 'San Agustin' },
        { coords: [14.703817240147075, 121.03011754032926], name: 'San Bartolome' },
        { coords: [14.707282122001462, 121.05171643949514], name: 'Sta. Lucia' },
        { coords: [14.714744742496935, 121.04734939475257], name: 'Sta. Monica' }
    ];

    // Add predefined markers to the map
    predefinedLocations.forEach(function (location) {
        L.marker(location.coords, { icon: redIcon })
            .addTo(map)
            .bindPopup(location.name);
    });

    // Fetch farm locations from the server on page load
    $(document).ready(function () {
        // Assuming you have a route that returns farm locations in the expected format
        $.ajax({
        url: '/farm_locations',
        method: 'GET',
        success: function (data) {
            console.log('Farm locations retrieved successfully:', data);
            addFarmLocationMarkers(data); // Add markers to the map
        },
        error: function (xhr, status, error) {
            console.error('Error retrieving farm locations:', error);
        },
    });
    });

    // Function to add markers for farm locations
    // Function to add markers for farm locations
    function addFarmLocationMarkers(locations) {
        if (Array.isArray(locations)) {
            locations.forEach(function (location) {
                if (location.latitude && location.longitude) {
                    L.marker([location.latitude, location.longitude], { icon: redIcon })
                        .addTo(map)
                        .bindPopup(location.location_name);
                }
            });
        } else {
            // Handle single object case
            if (locations.latitude && locations.longitude) {
                L.marker([locations.latitude, locations.longitude], { icon: redIcon })
                    .addTo(map)
                    .bindPopup(locations.location_name);
            }
        }
    }


    // Form submission handlerA
    $('#addFarmLocationForm').submit(function (e) {
        e.preventDefault();

        // Get form values
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var locationName = $('#locationName').val();

        // Make an AJAX request to store the farm location in the backend
        $.ajax({
            url: '/farm_locations',
            method: 'POST',
            data: {
                latitude: latitude,
                longitude: longitude,
                location_name: locationName,
            },
            success: function (data) {
                console.log('Farm location added successfully:', data);
                addFarmLocationMarkers(data); // Add the new marker to the map
                
            },
            error: function (error) {
                console.error('Error adding farm location:', error);
            },
        });

        // Close the modal
        $('#addFarmLocationModal').modal('hide');
    });
</script>

