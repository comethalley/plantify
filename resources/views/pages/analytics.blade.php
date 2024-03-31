@include('templates.header')

{{-- <script src="{{ asset('assets/js/donut.js') }}"></script>
{{-- <script src="assets/js/donut.js"></script> --}}

<link href="{{ asset('assets/css/analytics.css') }}" rel="stylesheet" type="text/css" />


<body>

    <!-- Begin page -->
  
                <!-- Sidebar -->
{{-- 
            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div> --}}

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Analytics</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Analytics</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-5">
                            <div class="d-flex flex-column h-100">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Users</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="28.05">0</span>k</h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 16.24 % </span> vs. previous month</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="users" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Sessions</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="97.66">0</span>k</h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 3.96 % </span> vs. previous month</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="activity" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Avg. Visit Duration</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="3">0</span>m
                                                            <span class="counter-value" data-target="40">0</span>sec
                                                        </h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 0.24 % </span> vs. previous month</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="clock" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Bounce Rate</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="33.48">0</span>%</h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 7.05 % </span> vs. previous month</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="external-link" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Harvesting Metrics</h4>
                                    <div>
                                        <button type="button" class="btn btn-soft-secondary btn-sm" onclick="updateChart('ALL')">
                                            ALL
                                        </button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm" onclick="updateChart('1MONTH')">
                                            1M
                                        </button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm" onclick="updateChart('6M')">
                                            6M
                                        </button>
                                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="updateChart('1Y')">
                                            1Y
                                        </button>
                                    </div>
                                  
                                </div><!-- end card header -->
                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-4">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="854">0</span>
                                                    <span class="text-success ms-1 fs-12">49%<i class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                                </h5>
                                                <p class="text-muted mb-0">Avg. Session</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-4">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="1278">0</span>
                                                    <span class="text-success ms-1 fs-12">60%<i class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                                </h5>
                                                <p class="text-muted mb-0">Conversion Rate</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-4">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="3">0</span>m
                                                    <span class="counter-value" data-target="40">0</span>sec
                                                    <span class="text-success ms-1 fs-12">37%<i class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                                </h5>
                                                <p class="text-muted mb-0">Avg. Session Duration</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body p-0 pb-2">
                                    <div>
                                        <div class="barangaySelector">
                                            <label for="barangaySelect">Select Barangay:</label>
                                            <select id="barangaySelect" class="form-control">
                                            @foreach($barangayOptions as $option)
                                                <option value="{{ $option['text'] }}">{{ $option['text'] }}</option>
                                            @endforeach
                                            </select>
                                            <div class="farmSelector">
                                            <label for="farmSelect">Selected Farm:</label>
                                            <select id="farmSelect" class="form-control" >
                                                <option></option>
                                            </select>
                                            </div>
                                        <div class="year-selector">
                                            <label for="yearSelect">Select Year:</label>
                                            <select id="yearSelect" class="form-control">
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <!-- Add more years as needed -->
                                            </select>
                                        </div>
                                        <div id="farmChart"></div>
                                        <hr>
                                        <div id="month-details" style="display: none;"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        </div>
                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Users by Device</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                                <a class="dropdown-item" href="#">Current Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div id="donut-chart"></div>
                                    <hr>
                                    <div id="details-section" style="display: none;">
                                        <h4>Details</h4>
                                        <p id="details-description"></p>
                                        <p id="details-amount"></p>
                                        <p id="details-created-at"></p>
                                    </div>

                                    {{-- <div class="table-responsive mt-3">
                                        <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                                            <tbody class="border-0">
                                                <tr>
                                                    <td>
                                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-primary me-2"></i>Desktop Users</h4>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-0"><i data-feather="users" class="me-2 icon-sm"></i>78.56k</p>
                                                    </td>
                                                    <td class="text-end">
                                                        <p class="text-success fw-medium fs-12 mb-0"><i class="ri-arrow-up-s-fill fs-5 align-middle"></i>2.08% </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-warning me-2"></i>Mobile Users</h4>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-0"><i data-feather="users" class="me-2 icon-sm"></i>105.02k</p>
                                                    </td>
                                                    <td class="text-end">
                                                        <p class="text-danger fw-medium fs-12 mb-0"><i class="ri-arrow-down-s-fill fs-5 align-middle"></i>10.52%
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-info me-2"></i>Tablet Users</h4>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-0"><i data-feather="users" class="me-2 icon-sm"></i>42.89k</p>
                                                    </td>
                                                    <td class="text-end">
                                                        <p class="text-danger fw-medium fs-12 mb-0"><i class="ri-arrow-down-s-fill fs-5 align-middle"></i>7.36%
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> --}}
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




      <!------------------------------------------- Theme Settings ------------------------------------------------------ -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcRharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

   document.addEventListener('DOMContentLoaded', function() {
    // Parse the data from the controller
    var expensesData = JSON.parse('{!! $expensesData !!}');
    var plantingData = {!! $plantingData !!};
    var farmsData = {!! $farmsData !!};
    var farmSelector = document.getElementById('farmSelect');
    var barangaySelector = document.getElementById('barangaySelect');
    var plantingChart;
// Populate farm selector options
    farmsData.forEach(function(farm) {
        var option = new Option(farm.farm_name, farm.id);
        farmSelector.add(option);
    });

    $(document).ready(function() {
    $('#barangaySelect').change(function() {
        var selectedOption = $(this).val();

        // Clear existing options in farmSelect, except for a default or placeholder option if you have one
        $('#farmSelect').find('option').not(':first').remove();
        // Perform AJAX request
        $.ajax({
            url: '/farmsAnalytics/' + selectedOption, // Replace with your API endpoint
            method: 'GET', // or 'GET' depending on your API
            success: function(response) {
                // Assume response.farms contains the relevant farms for the selected barangay
                $.each(response.farms, function(index, farm) {
                    $('#farmSelect').append($('<option>', {
                        value: farm.id, // Assuming farm ID is used as value
                        text: farm.farm_name // Assuming farm name is displayed as text
                    }));
                });
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    if (typeof ApexCharts !== 'undefined') {
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                events: {
                    dataPointSelection: function(event, chartContext, config) {
                        var selectedMonth = chartContext.w.config.xaxis.categories[config.dataPointIndex];
                        var detailsHtml = '';
                        if (!window.farmData) {
                            console.error('Farm data is not available.');
                            return;
                        }
                        var selectedYear = $('#yearSelect').val();
                        var details = window.farmData.filter(function(item) {
                            var itemMonth = new Date(item.start).toLocaleString('default', { month: 'long' });
                            var itemYear = new Date(item.start).getFullYear().toString();
                            return itemMonth === selectedMonth && itemYear === selectedYear;
                        });

                        details.forEach(function(item) {
                            var createdDate = new Date(item.start);
                            var formattedCreatedDate = createdDate.toLocaleDateString('en-US', {
                                year: 'numeric', month: 'long', day: 'numeric'
                            }) + ' | ' + createdDate.toLocaleTimeString('en-US', {
                                hour: '2-digit', minute: '2-digit', hour12: true
                            });
                            detailsHtml += `<div><h4>${item.title}</h4><p>Created At: ${formattedCreatedDate}</p><p>Harvested: ${item.harvested}</p><p>Destroyed: ${item.destroyed}</p></div>`;
                        });

                        var monthDetailsElement = document.getElementById('month-details');
                        monthDetailsElement.innerHTML = detailsHtml;
                        monthDetailsElement.style.display = details.length > 0 ? 'block' : 'none';
                    }
                }
            },
            series: [
                {
                    name: 'Harvested',
                    data: []
                },
                {
                    name: 'Destroyed',
                    data: []
                }
            ],
            xaxis: {
                categories: [] // This will be updated dynamically
            }
        };

        var farmChart = new ApexCharts(document.querySelector("#farmChart"), options);
        farmChart.render();

        // Trigger the chart update when the year or farm selection changes
        $('#farmSelect, #yearSelect').change(function() {
            var selectedOption = $('#farmSelect').val();
            var selectedYear = $('#yearSelect').val();

            // Perform AJAX request
            $.ajax({
                url: `/farmsAnalyticsData/${selectedOption}?year=${selectedYear}`,
                method: 'GET',
                success: function(response) {
                    console.log("AJAX response:", response);

                    if (response && response.monthlyData) {
                        var harvestedData = [];
                        var destroyedData = [];
                        var categories = Object.keys(response.monthlyData);

                        categories.forEach(function(month) {
                            harvestedData.push(parseFloat(response.monthlyData[month].harvested));
                            destroyedData.push(parseFloat(response.monthlyData[month].destroyed));
                        });

                        // Store the farms data in a global variable for access in the dataPointSelection event
                        window.farmData = response.farms;

                        // Update the chart with new data and months
                        farmChart.updateOptions({
                            series: [
                                {
                                    name: 'Harvested',
                                    data: harvestedData
                                },
                                {
                                    name: 'Destroyed',
                                    data: destroyedData
                                }
                            ],
                            xaxis: {
                                categories: categories
                            }
                        });
                    } else {
                        console.error('Fetched data is not in the expected format', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    } else {
        console.error('ApexCharts library is not loaded.');
    }
});



    // DONUT CHART  

        // Prepare the data for the expenses donut chart
        var expensesSeries = expensesData.map(function(data) {
            return parseFloat(data.amount);
        });

        var expensesLabels = expensesData.map(function(data) {
            return data.description;
        });

    // Define the donut chart options
    var donutOptions = {
        series: expensesSeries,
        chart: {
            type: 'donut',
            events: {
                dataPointSelection: function(event, chartContext, config) {
                    // Get the index of the clicked segment
                    var clickedIndex = config.dataPointIndex;
                    var clickedData = expensesData[clickedIndex];

                    // Format the date and time
                    var dateCreated = new Date(clickedData.created_at);
                    var formattedDate = (dateCreated.getMonth() + 1).toString().padStart(2, '0') + '/'
                                        + dateCreated.getDate().toString().padStart(2, '0') + '/'
                                        + dateCreated.getFullYear();
                    var hours = dateCreated.getHours();
                    var minutes = dateCreated.getMinutes().toString().padStart(2, '0');
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; 
                    var formattedTime = hours.toString().padStart(2, '0') + ':' + minutes + ' ' + ampm;

                    var friendlyDateTime = formattedDate + ' | ' + formattedTime;

                    document.getElementById('details-description').textContent = 'Description: ' + clickedData.description;
                    document.getElementById('details-amount').textContent = 'Amount: ₱' + clickedData.amount;
                    document.getElementById('details-created-at').textContent = 'Date: ' + friendlyDateTime;

                    // Make the details section visible
                    var detailsSection = document.getElementById('details-section');
                        detailsSection.style.display = 'block';
                }
            }
        },
        labels: expensesLabels,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                }
            }
        }],
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                               
                                return w.globals.seriesTotals.reduce(function(a, b) {
                                    return a + b;
                                }, 0).toFixed(2); // Format to two decimal places
                            }
                        }
                    }
                }
            }
        }
    };

    var donutChart = new ApexCharts(document.querySelector("#donut-chart"), donutOptions);
    donutChart.render();
    createPlantingBarChart();
});

</script>
</body>
</html>