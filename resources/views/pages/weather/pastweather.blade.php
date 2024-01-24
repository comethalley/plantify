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
        th, td {
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
    <script>
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
                    <td>${day.uvindex || 'N/A'}</td>
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
            minutes = minutes < 10 ? '0'+minutes : minutes;
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
    </script>
</head>
<body>
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
            <!-- Hourly weather data will be added here -->
        </tbody>
    </table>
</body>
</html>
