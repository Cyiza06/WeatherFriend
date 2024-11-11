
const apiKey = '8220fed63641b31dff665b5334793302';
const apiUrl = 'https://api.openweathermap.org/data/2.5/weather?&units=metric&q=';

const searchBox = document.querySelector('.search input');
const searchButton = document.querySelector('.search123');
var weatherIcon1 = document.querySelector('.searchedImage');

async function checkWeather(city) {
    const response = await fetch(apiUrl + city + `&appid=${apiKey}`);

    if(response.status !== 404){
        var data = await response.json();
        console.log(data);
        const inputTime = data.dt; 
        var day = new Date(inputTime*1000);
        console.log(day);

        document.querySelector('.city').innerHTML = data.name;
        document.querySelector('.time1').innerHTML = day.toLocaleTimeString();
        document.querySelector('.humidUp').innerHTML = data.main.humidity + '%';
        document.querySelector('.wind00').innerHTML = data.wind.speed + 'KM/H';
        document.querySelector('.temp2').innerHTML = Math.round(data.main.temp) + '&deg;C';

        if (data.weather[0].main == "Clouds") {
            weatherIcon1.src = "images/Thumbs/cloud.png";    
        }
        else if (data.weather[0].main == "Clear") {
            weatherIcon1.src = "images/Thumbs/sun.png"       
        }
        else if (data.weather[0].main == "Rain") {
            weatherIcon1.src = "images/Thumbs/rainfall.jpg"    
        }
        else if (data.weather[0].main == "Drizzle") {
            weatherIcon1.src = "images/Thumbs/drizzle.png"  
        }
        else if (data.weather[0].main == "Mist") {
            weatherIcon1.src = "images/Thumbs/mist.png"   
        }
    } 
}
function myFunction(){
    checkWeather(searchBox.value);
}