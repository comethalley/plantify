@include('templates.header')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/analytics.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.debug.js" integrity="sha512-+dBKPkFZW8e2RJv00jKz8d5MsWjI9g6I78I/zfE6hW7dPWGw/DLtCeEI+X3k/tEs+cOjDvg6Tbz5JG+LnVQQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script   script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
    {{-- <script src="{{ asset('assets/js/donut.js') }}"></script>
    {{-- <script src="assets/js/donut.js"></script> --}}
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/plants.png" class="img-fluid" />
    <link href="{{ asset('assets/css/analytics.css') }}" rel="stylesheet" type="text/css" />
</head>


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
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Analytics</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Dashboards</a></li>
                                        {{-- <li class="breadcrumb-item active">Analytics</li> --}}
                                        <li class="breadcrumb-item"><a href="javascript:void(0);" onclick="downloadPDF()">Download Report</a></li>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card crm-widget">
                                <div class="card-body p-0">
                                    <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                                        <div class="col">
                                            <div class="py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Number of Users </h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class=" ri-user-3-fill display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0"><span id="totalUserCounter" class="counter-value" data-target="">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col">
                                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Number of Farm Leaders</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="bx bx-user display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">  
                                                        <h2 class="mb-0"> <span id="farmLeaderCounter" class="counter-value" data-target="">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 mt-md-0 py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Number of Farms </h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class=" bx bx-scatter-chart display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0">  <span id="farmCounter" class="counter-value" data-target="">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col">
                                            <div class="mt-3 mt-md-0 py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Number of Farmers</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="bx bx-user display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0">   <span id="farmerCounter" class="counter-value" data-target="">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                       
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->


                    

                    <div class="row">
                        {{-- <div class="col-xl-6"> --}}
                            <div class="card">
                                <div class="card-header align-items-center d-flex justify-content-center">
                                    <h4 class="card-title mb-0">Harvesting Metrics</h4>             
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
                        {{-- <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Expense Analytics</h4>
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
                                    </div> --}}

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>


<script>
    function downloadPDF() {
    window.location.href = '{{ route('analytics.pdf') }}';
}


        function updateCounters() {
            // Make an AJAX request to fetch counts
            $.ajax({
                url: '/analytics/count',
                type: 'GET',
                success: function(data) {
                    // Update farm leader counter
                    $('#farmLeaderCounter').text(data.farmLeaderCount);
                    $('#farmLeaderCounter').attr('data-target', data.farmLeaderCount);

                    // Update farmer counter
                    $('#farmerCounter').text(data.farmerCount);
                    $('#farmerCounter').attr('data-target', data.farmerCount);

                    // Update total user counter
                    $('#totalUserCounter').text(data.totalUserCount);
                    $('#totalUserCounter').attr('data-target', data.totalUserCount);

                    // Update farm counter
                    $('#farmCounter').text(data.farmCount);
                    $('#farmCounter').attr('data-target', data.farmCount);

                    // Update analytics report details paragraph
                    $('#analyticsReportDetails').text(`Total numbers of users: ${data.totalUserCount}, Farms: ${data.farmCount}, Farm Leaders: ${data.farmLeaderCount}, and Farmers: ${data.farmerCount}`);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching counts:', error);
                }
            });
        }
    // Call the function when the page loads
    $(document).ready(function() {
        updateCounters();
    });
    
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

        // Generate the PDF with the chart data
        var formData = new FormData();
        formData.append('imageData', chart.exportChart({ format: 'png' }));
        formData.append('monthlyData', JSON.stringify(response.monthlyData));
        formData.append('farms', JSON.stringify(response.farms));

        $.ajax({
            url: '/generatePdf',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(pdfData) {
                console.log("PDF response:", pdfData);
                // Display or download the PDF as needed
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
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



    // DONUT CHART  0

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