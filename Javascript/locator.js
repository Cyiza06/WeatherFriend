// locator javascript
 
if ("geolocation" in navigator) {

    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

}else{

    console.error("Geolocation is not supported by your browser");

}
// function for success
function successCallback(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    getCityName(latitude, longitude);

    setInterval(() => getCityName(latitude, longitude), 300000);
}
//function for error
function errorCallback(error) {
    console.error(`Error getting location: ${error.message}`);
}

let weatherIcon = document.querySelector('.icon');


function getCityName(latitude, longitude) {
    
    const apiKey = '8220fed63641b31dff665b5334793302';
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&exclude=current&appid=${apiKey}&units=metric`;
   
    fetch(apiUrl)
    .then(response => response.json())

    .then(data => {
        console.log(data)
        const inputTime = data.dt; 
        var day = new Date(inputTime*1000);
        console.log(day); 
        
        document.querySelector(".name").innerHTML = data.name;
        document.querySelector('.humid').innerHTML = data.main.humidity + '%';
        document.querySelector('.wind').innerHTML = data.wind.speed + 'KM/H';
        document.querySelector(".temp").innerHTML = Math.round(data.main.temp) + '&deg;C';
        document.querySelector('.time').innerHTML = day.toLocaleTimeString();

        
        const weatherCondition = data.weather[0].main;
        const temperature =Math.round(data.main.temp) ;

        document.querySelector('.weather').innerHTML = `Current Weather : ${weatherCondition} \n Temperature:${temperature}&deg;C <br/> `

        let recommendations ='';

        if (weatherCondition == "Clouds") {
            weatherIcon.src = "images/Thumbs/cloud.png";
           
            recommendations =`
                <ul>
                    <li>Jeans</li>
                    <li>Jumper</li>
                    <li>Snikers</li>
                </ul>    
            `   
        }
        else if (weatherCondition == "Clear") {
            weatherIcon.src = "images/Thumbs/sun.png";
            
            recommendations = `
            <ul>
                <li>Sunglasses</li>
                <li>Beach towels</li>
                <li>Sunscreen</li>
                <li>Outdoor activities like hiking</li>
            </ul>`;
        }
        else if (weatherCondition == "Rain") {
            weatherIcon.src = "images/Thumbs/rainfall.jpg";
            
            recommendations = `
            <ul>
                <li>Winter jackets</li>
                <li>Snow boots</li>
                <li>Gloves and scarves</li>
                <li>Hot chocolate kits</li>
            </ul>`;
        }
        else if (weatherCondition == "Drizzle") {
            weatherIcon.src = "images/Thumbs/drizzle.png"   
        }
        else if (weatherCondition == "Mist") {
            weatherIcon.src = "images/Thumbs/mist.png"   
        } 
        else {
            weatherIcon.src = "images/Backgrounds/bg.jpg";

            recommendations = `
                <ul>
                    <li>Everyday essentials</li>
                    <li>Casual clothing</li>
                </ul>`;
        }

        document.getElementById('recommendations').innerHTML = `<h4>Recommended for You:</h4>${recommendations}`;

    })
    .catch(error => {
        console.error("Error fetching city name:", error);
    });
    
}
if (navigator.onLine) {  
    console.log("Device is online. Updating weather data.");
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }
};