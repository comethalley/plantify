const temp = document.getElementById("temp"),
date = document.getElementById("date-time"),
currentLocation = document.getElementById("location"),
condition = document.getElementById("condition"),
rain = document.getElementById("rain"),
mainIcon = document.getElementById("icon"),
uvIndex = document.querySelector(".uv-index"),
uvText = document.querySelector(".uv-text"),
windSpeed = document.querySelector(".wind-speed"),
sunRise = document.querySelector(".sun-rise"),
sunSet = document.querySelector(".sun-set"),
humidity = document.querySelector(".humidity"),
visibilty = document.querySelector(".visibilty"),
humidityStatus = document.querySelector(".humidity-status"),
airQuality = document.querySelector(".air-quality"),
airQualityStatus = document.querySelector(".air-quality-status"),
visibilityStatus = document.querySelector(".visibilty-status"),
weatherCards = document.querySelector("#weather-cards"),
celciusBtn = document.querySelector(".celcius"),
fahrenheitBtn = document.querySelector(".fahrenheit"),
hourlyBtn = document.querySelector(".hourly"),
weekBtn = document.querySelector(".week"),
tempUnit = document.querySelectorAll(".temp-unit"),
feelsLike = document.querySelector("#feels-like");




    let currentCity = "";
    let currentUnit = "c";
    let hourlyorWeek = "Week";

    // function to get date and time
    function getDateTime() {
      let now = new Date(),
        hour = now.getHours(),
        minute = now.getMinutes();

      let days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ];
      // 12 hours format
      hour = hour % 12;
      if (hour < 10) {
        hour = "0" + hour;
      }
      if (minute < 10) {
        minute = "0" + minute;
      }
      let dayString = days[now.getDay()];
      return `${dayString}, ${hour}:${minute}`;
    }
    date.innerText = getDateTime();

    // Updating date and time
    date.innerText = getDateTime();
    setInterval(() => {
      date.innerText = getDateTime();
    }, 1000);


// function to get public ip address
document.addEventListener("DOMContentLoaded", function() {
  currentUnit = "c"; // Set the default unit to Celsius
  getLocation();
  changeUnit(currentUnit); // This will set up the UI for Celsius
});

function getLocation() {
  const latitude = 14.6760;
  const longitude = 121.0437;

  getLocationDetails({
    coords: {
      latitude: latitude,
      longitude: longitude
    }
  });
}

function getLocationDetails(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;

  // Use OpenCage Geocoding API to get location details
  const apiKey = '64a339cd7d3748e38976be505208ecb7';
  const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${apiKey}`;

  fetch(apiUrl)
  fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    const city = "Quezon City"; // Manually setting the city
    const country = "Philippines"; // Manually setting the country

      // Assuming you have the getWeatherData function defined somewhere
      currentCity = city;
      getWeatherData(city);
       
       document.getElementById("location").innerHTML = `${city}, ${country}`;
     })
     .catch(error => {
       console.error('Error fetching location details:', error);
       document.getElementById("location").innerHTML = "Error fetching location details.";
     });
}

function showError(error) {
  const errorMessage = {
    1: "User denied the request for Geolocation.",
    2: "Location information is unavailable.",
    3: "The request to get user location timed out.",
    default: "An unknown error occurred."
  };

  document.getElementById("location").innerHTML = errorMessage[error.code] || errorMessage.default;
}


// function getWeatherData(city, unit, hourlyorWeek) {
//   const apiKey = "UQCDAHREW2AP33F6RGNT3X2Z9";
//   fetch(
//     `https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/${city}?unitGroup=metric&key=${apiKey}&contentType=json`,
//     {
//       method: "GET",
//     }
//   )
//     .then(response => {
//       if (!response.ok) {
//         throw new Error(`Unable to fetch weather data. HTTP status: ${response.status}`);
//       }
//       return response.json();
//     })
//     .then(data => {
//       const today = data.currentConditions;

//       // Update temperature based on the unit
//       const tempElement = document.getElementById("temperature");
//       tempElement.innerText = currentUnit === "c" ? today.temp : celciusToFahrenheit(today.temp);

//       // Set the initial unit to Celsius
//       changeUnit("c");

//       // Update other UI elements based on weather data
//       updateWeatherUI(today, data, unit, hourlyorWeek);
//     })
//     .catch(err => {
//       console.error('Error fetching weather data:', err);
//       alert("City not found in our database or weather data unavailable.");
//     });
// }

function updateWeatherUI(today, data, unit, hourlyorWeek) {
  tempUnit.forEach((elem) => {
    elem.innerText = `°${unit.toUpperCase()}`;
  });
}
// function getPublicIp() {
//   fetch("https://geolocation-db.com/json/", {
//     method: "GET",
 
//   })
//     .then((response) => response.json())
//     .then((data) => {
//      console.log(data);
//      currentCity = data.city;
//      getWeatherData(data.city, currentCity, hourlyorWeek);
//     });
// }

// getPublicIp();



function getWeatherData(city, unit, hourlyorWeek) {
  const apiKey = "C4YX6WXF38XQJPM9LJ533B8E4";
  fetch(
    `https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/${city}?unitGroup=metric&key=${apiKey}&contentType=json`,
    {
      method: "GET",
      
    }
  )
    .then((response) => response.json())
    .then((data) => {
      
      let today = data.currentConditions;
      if (unit === "f") {
        temp.innerText = celciusToFahrenheit(today.temp);
      } else {
        temp.innerText = today.temp;
      }
      
      currentLocation.innerText = data.resolvedAddress;
      condition.innerText = today.conditions;
      rain.innerText = "Perc - " + today.precip + "%";
      uvIndex.innerText = today.uvindex;
      windSpeed.innerText = today.windspeed;
      measureUvIndex(today.uvindex);
      mainIcon.src = getIcon(today.icon);
      // changeBackground(today.icon);
      humidity.innerText = today.humidity + "%";
      updateHumidityStatus(today.humidity);
      visibilty.innerText = today.visibility;
      updateVisibiltyStatus(today.visibility);
      airQuality.innerText = today.winddir;
      updateAirQualityStatus(today.winddir);
      feelsLike.innerText = "Feels Like: " + today.feelslike; // Assuming 'feelslike' is the key for Feels Like temperature in the API response
      if (hourlyorWeek === "hourly") {
        updateForecast(data.days[0].hours, unit, "day");
      } else {
        updateForecast(data.days, unit, "week");
      }
      sunRise.innerText = covertTimeTo12HourFormat(today.sunrise);
      sunSet.innerText = covertTimeTo12HourFormat(today.sunset);
    })
    .catch((err) => {
      console.error("Error fetching weather data:", err);
    });
}

//function to update Forecast
function updateForecast(data, unit, type) {
  weatherCards.innerHTML = ""; // Clear existing weather cards

  let startIndex = 1;
  let numCards = type === "day" ? 24 : 6; // Use 6 for weekly forecast

  for (let i = startIndex; i < startIndex + numCards; i++) {
    // Start from 1 to exclude the current day
    (function (index) {
      let card = document.createElement("div");
      card.classList.add("card");
      card.style.cursor = "pointer"; // Add this line

      let dayName = type === "week" ? getDayName(data[index].datetime) : getHour(data[index].datetime);
      let dayTemp = unit === "f" ? celciusToFahrenheit(data[index].temp) : data[index].temp;
      let iconSrc = getIcon(data[index].icon);

      card.innerHTML = `
        <h2 class="day-name">${dayName}</h2>
        <div class="card-icon">
          <img src="${iconSrc}" class="day-icon" alt="Weather Icon" />
        </div>
        <div class="day-temp">
          <h2 class="temp">${dayTemp}</h2>
          <span class="temp-unit">${unit === "f" ? "°F" : "°C"}</span>
        </div>
      `;

      // Add event listener to each card to show modal with details
      card.addEventListener('click', () => {
        populateAndShowModal(data[index]); // Use captured index
      });

      weatherCards.appendChild(card);
    })(i);
  }
}

function populateAndShowModal(detail) {
  // Populate the modal with details
  document.getElementById("modalRainChance").innerText = detail.precip || '0'; // Assuming 'precip' is your chance of rain
  document.getElementById("modalHumidity").innerText = detail.humidity || '--'; // Assuming 'humidity' is in your data
  document.getElementById("modalSunrise").innerText = covertTimeTo12HourFormat(detail.sunrise) || '--'; // Convert sunrise time as needed
  document.getElementById("modalSunset").innerText = covertTimeTo12HourFormat(detail.sunset) || '--'; // Convert sunset time as needed

  // Show the modal
  document.getElementById("detailModal").style.display = 'block';

  // Add event listener to close the modal when clicking outside of it
  document.addEventListener('click', function(event) {
    if (event.target.id === 'detailModal' || event.target.id === 'modalClose') {
      document.getElementById("detailModal").style.display = 'none';
    }
  });
}

function closeModal() {
  document.getElementById("detailModal").style.display = 'none';
}

  
// function to change weather icons
function getIcon(condition) {
  if (condition === "partly-cloudy-day") {
    return "https://i.ibb.co/PZQXH8V/27.png";
  } else if (condition === "partly-cloudy-night") {
    return "https://i.ibb.co/Kzkk59k/15.png";
  } else if (condition === "rain") {
    return "https://i.ibb.co/vqBCT93/rain-removebg-preview.png";
  } else if (condition === "clear-day") {
    return "https://i.ibb.co/rb4rrJL/26.png";
  } else if (condition === "clear-night") {
    return "https://i.ibb.co/1nxNGHL/10.png";
  } else {
    return "https://i.ibb.co/rb4rrJL/26.png";
  }
}

// function to change background depending on weather conditions
function changeBackground(condition) {
  const body = document.querySelector("body");
  let bg = "";
  if (condition === "partly-cloudy-day") {
    bg = "https://i.ibb.co/qNv7NxZ/pc.webp";
  } else if (condition === "partly-cloudy-night") {
    bg = "https://i.ibb.co/RDfPqXz/pcn.jpg";
  } else if (condition === "rain") {
    bg = "https://i.ibb.co/h2p6Yhd/rain.webp";
  } else if (condition === "clear-day") {
    bg = "https://i.ibb.co/WGry01m/cd.jpg";
  } else if (condition === "clear-night") {
    bg = "https://i.ibb.co/kqtZ1Gx/cn.jpg";
  } else {
    bg = "https://i.ibb.co/qNv7NxZ/pc.webp";
  }
  body.style.backgroundImage = `linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ),url(${bg})`;
}

//get hours from hh:mm:ss
function getHour(time) {
  let hour = time.split(":")[0];
  let min = time.split(":")[1];
  if (hour > 12) {
    hour = hour - 12;
    return `${hour}:${min} PM`;
  } else {
    return `${hour}:${min} AM`;
  }
}

// convert time to 12 hour format
function covertTimeTo12HourFormat(time) {
  let hour = time.split(":")[0];
  let minute = time.split(":")[1];
  let ampm = hour >= 12 ? "pm" : "am";
  hour = hour % 12;
  hour = hour ? hour : 12; // the hour '0' should be '12'
  minute = Number(minute); // Convert minutes to a number
  minute = minute < 10 ? "0" + minute : minute; // Pad minutes with a leading zero if needed
  let strTime = hour + ":" + minute + " " + ampm;
  return strTime;
}

// function to get day name from date
function getDayName(date) {
  let day = new Date(date);
  let days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];
  return days[day.getDay()];
}

// function to get uv index status
function measureUvIndex(uvIndex) {
  if (uvIndex <= 2) {
    uvText.innerText = "Low";
  } else if (uvIndex <= 5) {
    uvText.innerText = "Moderate";
  } else if (uvIndex <= 7) {
    uvText.innerText = "High";
  } else if (uvIndex <= 10) {
    uvText.innerText = "Very High";
  } else {
    uvText.innerText = "Extreme";
  }
}

// function to get humidity status
function updateHumidityStatus(humidity) {
  if (humidity <= 30) {
    humidityStatus.innerText = "Low";
  } else if (humidity <= 60) {
    humidityStatus.innerText = "Moderate";
  } else {
    humidityStatus.innerText = "High";
  }
}

// function to get visibility status
function updateVisibiltyStatus(visibility) {
  if (visibility <= 0.03) {
    visibilityStatus.innerText = "Dense Fog";
  } else if (visibility <= 0.16) {
    visibilityStatus.innerText = "Moderate Fog";
  } else if (visibility <= 0.35) {
    visibilityStatus.innerText = "Light Fog";
  } else if (visibility <= 1.13) {
    visibilityStatus.innerText = "Very Light Fog";
  } else if (visibility <= 2.16) {
    visibilityStatus.innerText = "Light Mist";
  } else if (visibility <= 5.4) {
    visibilityStatus.innerText = "Very Light Mist";
  } else if (visibility <= 10.8) {
    visibilityStatus.innerText = "Clear Air";
  } else {
    visibilityStatus.innerText = "Very Clear Air";
  }
}

// function to get air quality status
function updateAirQualityStatus(airquality) {
  if (airquality <= 50) {
    airQualityStatus.innerText = "Good";
  } else if (airquality <= 100) {
    airQualityStatus.innerText = "Moderate";
  } else if (airquality <= 150) {
    airQualityStatus.innerText = "Unhealthy";
  } else if (airquality <= 200) {
    airQualityStatus.innerText = "Unhealthy";
  } else if (airquality <= 250) {
    airQualityStatus.innerText = "Very Unhealthy";
  } else {
    airQualityStatus.innerText = "Hazardous";
  }
}


// function to conver celcius to fahrenheit
function celciusToFahrenheit(temp) {
  return ((temp * 9) / 5 + 32).toFixed(1);
}


// var currentFocus;
// search.addEventListener("input", function (e) {
//   removeSuggestions();
//   var a,
//     b,
//     i,
//     val = this.value;
//   if (!val) {
//     return false;
//   }
//   currentFocus = -1;

//   a = document.createElement("ul");
//   a.setAttribute("id", "suggestions");

//   this.parentNode.appendChild(a);

//   for (i = 0; i < cities.length; i++) {
//     /*check if the item starts with the same letters as the text field value:*/
//     if (
//       cities[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()
//     ) {
//       /*create a li element for each matching element:*/
//       b = document.createElement("li");
//       /*make the matching letters bold:*/
//       b.innerHTML =
//         "<strong>" + cities[i].name.substr(0, val.length) + "</strong>";
//       b.innerHTML += cities[i].name.substr(val.length);
//       /*insert a input field that will hold the current array item's value:*/
//       b.innerHTML += "<input type='hidden' value='" + cities[i].name + "'>";
//       /*execute a function when someone clicks on the item value (DIV element):*/
//       b.addEventListener("click", function (e) {
//         /*insert the value for the autocomplete text field:*/
//         search.value = this.getElementsByTagName("input")[0].value;
//         removeSuggestions();
//       });

//       a.appendChild(b);
//     }
//   }
// });
// /*execute a function presses a key on the keyboard:*/
// search.addEventListener("keydown", function (e) {
//   var x = document.getElementById("suggestions");
//   if (x) x = x.getElementsByTagName("li");
//   if (e.keyCode == 40) {
//     /*If the arrow DOWN key
//       is pressed,
//       increase the currentFocus variable:*/
//     currentFocus++;
//     /*and and make the current item more visible:*/
//     addActive(x);
//   } else if (e.keyCode == 38) {
//     /*If the arrow UP key
//       is pressed,
//       decrease the currentFocus variable:*/
//     currentFocus--;
//     /*and and make the current item more visible:*/
//     addActive(x);
//   }
//   if (e.keyCode == 13) {
//     /*If the ENTER key is pressed, prevent the form from being submitted,*/
//     e.preventDefault();
//     if (currentFocus > -1) {
//       /*and simulate a click on the "active" item:*/
//       if (x) x[currentFocus].click();
//     }
//   }
// });
// function addActive(x) {
//   /*a function to classify an item as "active":*/
//   if (!x) return false;
//   /*start by removing the "active" class on all items:*/
//   removeActive(x);
//   if (currentFocus >= x.length) currentFocus = 0;
//   if (currentFocus < 0) currentFocus = x.length - 1;
//   /*add class "autocomplete-active":*/
//   x[currentFocus].classList.add("active");
// }
// function removeActive(x) {
//   /*a function to remove the "active" class from all autocomplete items:*/
//   for (var i = 0; i < x.length; i++) {
//     x[i].classList.remove("active");
//   }
// }

// function removeSuggestions() {
//   var x = document.getElementById("suggestions");
//   if (x) x.parentNode.removeChild(x);
// }


celciusBtn.addEventListener("click", () => {
  changeUnit("c");
});

fahrenheitBtn.addEventListener("click", () => {
  changeUnit("f");
});


// // function to change unit
function changeUnit(unit) {
  if (currentUnit !== unit) {
    currentUnit = unit;
    tempUnit.forEach((elem) => {
      elem.innerText = `°${unit.toUpperCase()}`;
    });
    // Set the active class based on the current unit
    if (unit === "c") {
      celciusBtn.classList.add("active");
      fahrenheitBtn.classList.remove("active");
    } else {
      celciusBtn.classList.remove("active");
      fahrenheitBtn.classList.add("active");
    }
    // Fetch new weather data if the city is set
    if (currentCity) {
      getWeatherData(currentCity, currentUnit, hourlyorWeek);
    }
  }
}


hourlyBtn.addEventListener("click", () => {
  changeTimeSpan("hourly");
});
weekBtn.addEventListener("click", () => {
  changeTimeSpan("week");
});

// // function to change hourly to weekly or vice versa
function changeTimeSpan(unit) {
  if (hourlyorWeek !== unit) {
    hourlyorWeek = unit;
    if (unit === "hourly") {
      hourlyBtn.classList.add("active");
      weekBtn.classList.remove("active");
    } else {
      hourlyBtn.classList.remove("active");
      weekBtn.classList.add("active");
    }
    getWeatherData(currentCity, currentUnit, hourlyorWeek);
  }
}


