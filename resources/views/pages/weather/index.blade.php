@include('templates.header')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/8ff31c595e.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/weather.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
  <div id="customModal" class="modal">
    <div class="modal-content">
        <span id="modalMessage"></span>
    </div>
</div>
  <div class="page-content">

    <div class="wrapper">
      <div class="sidebar">
        <div>
          <div class="weather-icon">
            <img id="icon" src="assets/weather-icon/icons/sun/27.png" alt="" />
          </div>
          <div class="temperature">
            <h1 id="temp">0</h1>
            <span class="temp-unit">°C</span>
          </div>
          <div class="feels-like">
            <h2 id="feels-like">Feels Like: 0</h2>
            <span class="temp-unit">°C</span>
          </div>
          <div class="date-time">
            <p id="date-time">Monday, 12:00</p>
          </div>
          <div class="divider"></div>
          <div class="condition-rain">
            <div class="condition">
              <i class="fas fa-cloud"></i>
              <p id="condition">condition</p>
            </div>
            <div class="rain">
              <i class="fas fa-tint"></i>
              <p id="rain">perc - 0%</p>
            </div>
          </div>
          <div class="location">
            <div class="location-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="location-text">
              <p id="location">location</p>
            </div>
          </div>
        </div>
        <span class="badge badge-label bg-primary"><i class="mdi mdi-circle-medium"></i> Weather Data - Visual Crossing</span>
  
  
      </div>
      <div class="main">
        <nav>
          <ul class="options">
            <button class="hourly">today</button>
            <button class="week active">week</button>
          </ul>
          <ul class="options units">
            <button class="fahrenheit ">°F</button>
            <button class="celcius active" >°C</button>
          </ul>
        </nav>
        <div class="cards" id="weather-cards"></div>
        <div id="detailModal" style="display:none;">
          <p>Feels Like: <span id="modalFeelsLike">--</span></p>
          <p>Chance of Rain: <span id="modalRainChance">--</span>%</p>
          <p>Humidity: <span id="modalHumidity">--</span>%</p>
          <p>Sunrise:  <span id="modalSunrise">--</span></p>
          <p>Sunset: <span id="modalSunset">--</span></p>
        </div>
        <div class="highlights">
          <h2 class="heading">today's highlights</h2>
          <div class="cards">
            <div class="card2">
              <h4 class="card-heading">UV Index</h4>
              <div class="content">
                <p class="uv-index">0</p>
                <p class="uv-text">Low</p>
              </div>
            </div>
            <div class="card2">
              <h4 class="card-heading">Wind Status</h4>
              <div class="content">
                <p class="wind-speed">0</p>
                <p class="">Low</p>
              </div>
            </div>
            <div class="card2">
              <h4 class="card-heading">Sunrise | Sunset</h4>
              <div class="content">
                <p class="sun-rise">0</p>
                <p class="sun-set">0</p>
              </div>
            </div>
            <div class="card2">
              <h4 class="card-heading">Humidity</h4>
              <div class="content">
                <p class="humidity">0</p>
                <p class="humidity-status">Normal</p>
              </div>
            </div>
            <div class="card2">
              <h4 class="card-heading">Visibility</h4>
              <div class="content">
                <p class="visibilty">0</p>
                <p class="visibilty-status">Normal</p>
              </div>
            </div>
            <div class="card2">
              <h4 class="card-heading">Air Quality</h4>
              <div class="content">
                <p class="air-quality">0</p>
                <p class="air-quality-status">Normal</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="{{ asset('assets/js/weather.js') }}"> </script>
      <script src="https://cdn.db-ip.com/js/dbip.js" data-api-key="p6bcac47ae71f0285cb6343d9697e56e41a2cb92"> </script>
    </div>
  </div>
  </div>
  </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Function to display SweetAlert alerts
  function showSweetAlert(message) {
    Swal.fire({
      title: 'Plantify remind you that',
      text: message,
      icon: 'warning',
      confirmButtonText: 'OK'
    });
  }

  // Function to check weather conditions for alerts
  function checkWeatherConditionsForAlerts(data) {
    const { temp, precip, windspeed, uvindex } = data.currentConditions;
    
    let alerts = []; // Array to store all alerts

    if (temp > weatherThresholds.temp) {
      alerts.push("High temperature alert! Consider adjusting planting schedules.");
    }
    if (precip > weatherThresholds.precip) {
      alerts.push("High precipitation alert! Ensure proper drainage for plants.");
    }
    if (windspeed > weatherThresholds.windspeed) {
      alerts.push("Strong wind alert! Secure plants to prevent damage.");
    }
    if (uvindex > weatherThresholds.uvindex) {
      alerts.push("High UV index alert! Provide shade or protect plants from sunburn.");
    }

    // If there are alerts, show them using SweetAlert
    if (alerts.length > 0) {
      const combinedAlert = alerts.join('\n'); // Concatenate alerts with new lines
      showSweetAlert(combinedAlert); // Show SweetAlert with combined alert message
    } else {
      // If no alerts, show a generic message using SweetAlert
      showSweetAlert("Good Conditions, you can start planting now!");
    }
  }
</script>
@include('templates.footer')