!function(){"use strict";var t,a,e;sessionStorage.getItem("defaultAttribute")&&(t=document.documentElement.attributes,a={},Object.entries(t).forEach(function(t){var e;t[1]&&t[1].nodeName&&"undefined"!=t[1].nodeName&&(e=t[1].nodeName,a[e]=t[1].nodeValue)}),sessionStorage.getItem("defaultAttribute")!==JSON.stringify(a)?(sessionStorage.clear(),window.location.reload()):((e={})["data-layout"]=sessionStorage.getItem("data-layout"),e["data-sidebar-size"]=sessionStorage.getItem("data-sidebar-size"),e["data-layout-mode"]=sessionStorage.getItem("data-layout-mode"),e["data-layout-width"]=sessionStorage.getItem("data-layout-width"),e["data-sidebar"]=sessionStorage.getItem("data-sidebar"),e["data-sidebar-image"]=sessionStorage.getItem("data-sidebar-image"),e["data-layout-direction"]=sessionStorage.getItem("data-layout-direction"),e["data-layout-position"]=sessionStorage.getItem("data-layout-position"),e["data-layout-style"]=sessionStorage.getItem("data-layout-style"),e["data-topbar"]=sessionStorage.getItem("data-topbar"),e["data-preloader"]=sessionStorage.getItem("data-preloader"),e["data-body-image"]=sessionStorage.getItem("data-body-image"),Object.keys(e).forEach(function(t){e[t]&&document.documentElement.setAttribute(t,e[t])})))}();


// Weather 

function getWeatherData(city, unit, hourlyorWeek) {
    const apiKey = "UQCDAHREW2AP33F6RGNT3X2Z9";
    fetch(
      `https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/${city}?unitGroup=metric&key=${apiKey}&contentType=json`,
      {
        method: "GET",
        
      }
    )
      .then((response) => response.json())
      .then((data) => {
        let today = data.currentConditions;
        if (unit === "c") {
          temp.innerText = today.temp;
        } else {
          temp.innerText = celciusToFahrenheit(today.temp);
        }
        currentLocation.innerText = data.resolvedAddress;
        condition.innerText = today.conditions;
        rain.innerText = "Perc - " + today.precip + "%";
        uvIndex.innerText = today.uvindex;
        windSpeed.innerText = today.windspeed;
        measureUvIndex(today.uvindex);
        mainIcon.src = getIcon(today.icon);
        changeBackground(today.icon);
        humidity.innerText = today.humidity + "%";
        updateHumidityStatus(today.humidity);
        visibilty.innerText = today.visibility;
        updateVisibiltyStatus(today.visibility);
        airQuality.innerText = today.winddir;
        updateAirQualityStatus(today.winddir);
        if (hourlyorWeek === "hourly") {
          updateForecast(data.days[0].hours, unit, "day");
        } else {
          updateForecast(data.days, unit, "week");
        }
        sunRise.innerText = covertTimeTo12HourFormat(today.sunrise);
        sunSet.innerText = covertTimeTo12HourFormat(today.sunset);
      })
      .catch((err) => {
        alert("City not found in our database");
      });
  }

  function updateForecast(data, unit, type) {
    weatherCards.innerHTML = "";
    let day = 0;
    let numCards = 0;
    if (type === "day") {
      numCards = 24;
    } else {
      numCards = 7;
    }
    for (let i = 0; i < numCards; i++) {
      let card = document.createElement("div");
      card.classList.add("card");
      let dayName = getHour(data[day].datetime);
      if (type === "week") {
        dayName = getDayName(data[day].datetime);
      }
      let dayTemp = data[day].temp;
      if (unit === "f") {
        dayTemp = celciusToFahrenheit(data[day].temp);
      }
      let iconCondition = data[day].icon;
      let iconSrc = getIcon(iconCondition);
      let tempUnit = "°C";
      if (unit === "f") {
        tempUnit = "°F";
      }
      card.innerHTML = `
                  <h2 class="day-name">${dayName}</h2>
              <div class="card-icon">
                <img src="${iconSrc}" class="day-icon" alt="" />
              </div>
              <div class="day-temp">
                <h2 class="temp">${dayTemp}</h2>
                <span class="temp-unit">${tempUnit}</span>
              </div>
    `;
      weatherCards.appendChild(card);
      day++;
    }
  } 