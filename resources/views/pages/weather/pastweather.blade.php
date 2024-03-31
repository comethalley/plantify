<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .toggle-button {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
        }
    </style>

</head>

<body>
    @include('templates.header')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <!-- <h4 class="mb-sm-0">Inventory</h4> -->

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                <li class="breadcrumb-item active">Unit of Measurements</li> -->
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title mb-0">Hourly Weather Data For Quezon City</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <form>
                                    <div class="row g-3"> 
                                       

                                        <div class="col-xl-3 ">
                                            <div class="mt-3">
                                                <label class="form-label mb-0">Search Date</label>
                                                <div class="d-flex align-items-center ">
                                                    <input type="text" id="dateInput" class="form-control flatpickr-input me-2" data-provider="flatpickr" data-date-format="d M, Y" data-default-date="25 12,2021" readonly="readonly">
                                                    <button onclick="searchWeather()" type="button" class="btn btn-primary bg-gradient
                                             waves-effect waves-light mdi mdi-magnify search-widget-icon"></button>        
                                                </div>
                                                        
                                    </div>
                                    
                                    <!--end row-->
                                    <!-- Another Calender -->
                                    <!-- <div >
                                        <label for="exampleInputdate" class="form-label">Input Date</label>
                                        <div class="d-flex align-items-center ">
                                            <input type="date" class="form-control me-2" id="exampleInputdate">
                                            <button type="button" class="btn btn-primary bg-gradient
                                             waves-effect waves-light mdi mdi-magnify search-widget-icon"></button>
                                        </div> -->
                                </form>
                            </div>
                            <div class="card-body pt-0">
                                <div>

                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="example-table">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">


                                                    </th>
                                                    <th class="sort" data-sort="time">Time</th>
                                                    <th class="sort" data-sort="temperature">Temperature</th>
                                                    <th class="sort" data-sort="windspeed">Wind Speed</th>
                                                    <th class="sort" data-sort="humidity">Humidity</th>

                                                    <th class="sort" data-sort="condition">Condition</th>
                                                    <th class="sort" data-sort="visibility">Visibility (mi)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all" id="weatherTableBody">

                                            </tbody>

                                    </div>
                                </div>

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                    </div>
                    <!-- container-fluid -->
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button id="exportButton" class="btn btn-success waves-effect waves-light ml-auto">
                        <i class="ri-download-fill me-1"></i> Export file
                    </button>
                </div>

                
                <!-- End Page-content -->
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

            <!-- 
<button class="toggle-button" onclick="toggleTemperatureUnit()">
        Toggle °C/°F
    </button>
    <h1>Hourly Weather Data for Quezon City</h1>
    <input type="date" id="dateInput" />
    <button onclick="searchWeather()">Search</button>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Temperature</th>
                <th>Wind Speed</th>
                <th>Humidity</th>
                <th>UV Index</th>
                <th>Condition</th>
                <th>Visibility (mi)</th>
            </tr>
        </thead>
        <tbody id="weatherTableBody">
            Hourly weather data will be added here
        </tbody>
    </table> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <br>
            <script>
                flatpickr('#dateInput', {
                    dateFormat: 'd M, Y',
                    defaultDate: 'today',
                    readOnly: true
                });

                let isCelsius = true; // Global variable to track temperature unit
                let currentWeatherData = []; // Store the fetched data

                async function fetchWeatherDataForDate(date) {
                    const api_key = "UQCDAHREW2AP33F6RGNT3X2Z9"; // Replace with your API key
                    const location = "Quezon City";
                    const startDate = new Date(date);
                    const endDate = new Date(startDate);
                    endDate.setDate(endDate.getDate() + 1); // Add one day

                    const startDateTime = `${startDate.toISOString().split('T')[0]}T00:00:00`;
                    const endDateTime = `${endDate.toISOString().split('T')[0]}T00:00:00`;

                    const url = `https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/weatherdata/history?aggregateHours=1&startDateTime=${startDateTime}&endDateTime=${endDateTime}&location=${location}&unitGroup=us&contentType=json&key=${api_key}`;

                    try {
                        const response = await fetch(url);
                        const data = await response.json();
                        currentWeatherData = data.locations[location].values; // Store fetched data
                        displayWeatherData(); // Display the data
                    } catch (error) {
                        console.error('Error fetching weather data:', error);
                    }
                }

                function displayWeatherData() {
                    const weatherTableBody = document.getElementById('weatherTableBody');
                    weatherTableBody.innerHTML = ''; // Clear previous data

                    // Populate table with each hour's weather data
                    currentWeatherData.forEach(day => {
                        const dateTime = new Date(day.datetime);
                        const formattedTime = formatAMPM(dateTime);
                        const temp = isCelsius ? convertFtoC(day.temp) : day.temp;
                        const tempUnit = isCelsius ? '°C' : '°F';

                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${formattedTime}</td>
                    <td>${temp.toFixed(1)} ${tempUnit}</td>
                    <td>${day.wspd} mph</td>
                    <td>${day.humidity} %</td>
                   
                    <td>${day.conditions || 'N/A'}</td>
                    <td>${day.visibility || 'N/A'} mi</td>
                `;
                        weatherTableBody.appendChild(row);
                    });
                }

                function convertFtoC(fahrenheit) {
                    return (fahrenheit - 32) * 5 / 9;
                }

                function formatAMPM(date) {
                    let hours = date.getHours();
                    let minutes = date.getMinutes();
                    let ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    let strTime = hours + ':' + minutes + ' ' + ampm;
                    return strTime;
                }

                function toggleTemperatureUnit() {
                    isCelsius = !isCelsius;
                    displayWeatherData(); // Redisplay data with new unit
                }

                function searchWeather() {
                    const dateInput = document.getElementById('dateInput').value;
                    fetchWeatherDataForDate(dateInput);
                }

        $(document).ready(function() {
        $("#exportButton").click(function() {
        var table = $('#example-table').clone();
        var tableHtml = table.prop('outerHTML');

        var dataType = 'application/vnd.ms-excel';
        var filename = 'download.xls';

        var downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHtml], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            downloadLink.href = 'data:' + dataType + ', ' + encodeURIComponent(tableHtml);
            downloadLink.download = filename;
            downloadLink.click();
        }
    });
});
            </script>
</body>

</html>