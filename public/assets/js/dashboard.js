const temperaturePlaceholder = document.getElementById(
    "temperature-placeholder"
);
const weatherButton = document.getElementById("weather-button");
const weatherIcon = document.getElementById("weather-icon");

function updateTemperature(temperature) {
    temperaturePlaceholder.textContent = temperature + "°C";
}

function getTemperatureData(city) {
    const apiKey = "ERJGP7JJK2SVVZEAC4G7ZZ6F4";
    fetch(
        `https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/${city}?unitGroup=metric&include=current&key=${apiKey}&contentType=json`,
        { method: "GET" }
    )
        .then((response) => response.json())
        .then((data) => {
            const currentTemperature = data.currentConditions.temp;
            updateTemperature(currentTemperature);
            updateWeatherIcon(data.currentConditions.weather);
        })
        .catch((err) => {
            console.error("Error fetching temperature data:", err);
            // alert("Temperature data for Quezon City is unavailable.");
        });
}

function updateWeatherIcon(condition) {
    console.log("Updating weather icon for condition:", condition);

    // Get the icon URL based on the condition
    const iconSrc = getIcon(condition);

    // Set the icon source
    weatherIcon.src = iconSrc;
}

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
        // Default icon
        return "https://i.ibb.co/rb4rrJL/26.png";
    }
}

// Fetch and display temperature and weather icon when the page loads
document.addEventListener("DOMContentLoaded", function () {
    getTemperatureData("Quezon City");
});

// Redirect to weather page when the button is clicked
weatherButton.addEventListener("click", function () {
    window.location.href = "/weather"; // Change "/weather" to your desired URL
});
