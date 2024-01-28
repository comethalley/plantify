@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Farm Maps</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                
                                <li class="breadcrumb-item active">Farm Maps</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">District 5, Quezon City
                                                    Metro Manila</h4>
                    </div><!-- end card header -->

                    <div class="card-body" >
                        <div id="leaflet-map" class="leaflet-map" style="height: 445px;"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

            </div>

            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!--end back-to-top-->
    @include('templates.footer')
    <!--preloader-->

    <!-- Include Leaflet library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Initialize the map
        var map = L.map('leaflet-map').setView([14.717499241909843, 121.04829782475622], 12.75);
         
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

    L.marker([14.696581413419649, 121.03241984130206], { icon: redIcon })
    .addTo(map)
    .bindPopup('BagBag');

    L.marker([14.717054785291488, 121.0284830908979], { icon: redIcon })
    .addTo(map)
    .bindPopup('Capri');

    L.marker([14.703781994760133, 121.06858143870275], { icon: redIcon })
    .addTo(map)
    .bindPopup('Fairview');

    L.marker([14.7110264787141, 121.04022213300071], { icon: redIcon })
    .addTo(map)
    .bindPopup('Gulod');

    L.marker([14.731531502207597, 121.06361814840842], { icon: redIcon })
    .addTo(map)
    .bindPopup('Greater Lagro');

    L.marker([14.735610007825965, 121.04624201654802], { icon: redIcon })
    .addTo(map)
    .bindPopup('Kaligayahan');

    L.marker([14.720497333320369, 121.02353995741312], { icon: redIcon })
    .addTo(map)
    .bindPopup('Nagkaisang Nayon');

    L.marker([14.712841342613753, 121.06136698356038], { icon: redIcon })
    .addTo(map)
    .bindPopup('North Fairview');

    L.marker([14.72159192206426, 121.03724325170134], { icon: redIcon })
    .addTo(map)
    .bindPopup('Novaliches Proper');

    L.marker([14.721023889807322, 121.05021447950583], { icon: redIcon })
    .addTo(map)
    .bindPopup('Pasong Putik Proper');

    L.marker([14.731079865181144, 121.03514900127126], { icon: redIcon })
    .addTo(map)
    .bindPopup('San Agustin');

    L.marker([14.703817240147075, 121.03011754032926], { icon: redIcon })
    .addTo(map)
    .bindPopup('San Bartolome');
    
    L.marker([14.707282122001462, 121.05171643949514], { icon: redIcon })
    .addTo(map)
    .bindPopup('Sta. Lucia');

    L.marker([14.714744742496935, 121.04734939475257], { icon: redIcon })
    .addTo(map)
    .bindPopup('Sta. Monica');

    </script>
</div>
