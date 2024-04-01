const temp = document.getElementById("temp"),
weatherCards = document.querySelector("#weather-cards");


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



function updateForecast(data, unit, type) {
    weatherCards.innerHTML = ""; // Clear existing weather cards
    let day = 0;
    let numCards = 6;
    let startIndex = 1;
    if (type === "day") {
      numCards = 24;
    } else {
      numCards = 7;
    }
    for (let i = startIndex; i < numCards; i++) {
      let card = document.createElement("div");
      card.classList.add("card");
      let dayName = getHour(data[day].datetime);
      if (type === "week") {
        dayName = getDayName(data[i].datetime);
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
    