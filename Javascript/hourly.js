if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
} else {
    console.error("Geolocation is not supported by your browser");
}

function successCallback(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    getThreeHourForecast(latitude, longitude);
    setInterval(() => getThreeHourForecast(latitude, longitude), 10800000);
}

function errorCallback(error) {
    console.error(`Error getting location: ${error.message}`);
}


function getThreeHourForecast(latitude, longitude) {
    const apiKey = '8220fed63641b31dff665b5334793302';
    const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?lat=${latitude}&lon=${longitude}&units=metric&appid=${apiKey}`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            
            const forecastContainer = document.querySelector('.tudivs');
            forecastContainer.innerHTML = ''; 
            

            for (let i = 0; i < 2; i++) {
                const forecastData = data.list[i];
                
                const time = new Date(forecastData.dt * 1000).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const temperature = Math.round(forecastData.main.temp);
                const weatherCondition = forecastData.weather[0].main;

               document.querySelector('.dog').innerHTML = forecastData.name;
               document.querySelector('.span').innerHTML = `${time}`;
               document.querySelector('.d').innerHTML = `${temperature}`;
               document.querySelector('.e').innerHTML = `${weatherCondition}`;

                let weatherIcon2 = document.getElementsByClassName('.icon2');

                weatherIcon2.forEach(icon2 => {
                    if (weatherCondition === "Clouds") {
                        icon2.src = "images/Thumbs/cloud.png";
                    } else if (weatherCondition === "Clear") {
                        icon2.src = "images/Thumbs/sun.png";
                    } else if (weatherCondition === "Rain") {
                        icon2.src = "images/Thumbs/rainfall.jpg";
                    } else if (weatherCondition === "Drizzle") {
                        icon2.src = "images/Thumbs/drizzle.png";
                    } else if (weatherCondition === "Mist") {
                        icon2.src = "images/Thumbs/mist.png";
                    } else {
                        icon2.src = "images/Backgrounds/bg.jpg";
                    }
                });
                // Set the weather icon based on the condition
            }
        })
        .catch(error => {
            console.error("Error fetching forecast data:", error);
        });
}
    
if (navigator.onLine) {  
    console.log("Device is online. Updating weather data.");
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }
};