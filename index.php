<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend Home Page</title>
    <style>
        <?php
            include './Styles/index.css';
        ?>
    </style>
</head>
<body>
    <div class="preloader">
        <div class="circles">
            <div class="cir"></div>
            <div class="cir cir2"></div>
            <div class="cir cir3"></div>
        </div>
    </div>
    <div class="header">
        <div class="brand">
            <a href="">WeatherFriend</a>
        </div>
        <div class="search">
            <input type="search" oninput="myFunction()" placeholder="type your city name" autofocus>
        </div>
        <div class="info">
            <a href="about.html">About us</a>
        </div>
    </div>
    <div class="container">
        <div class="left">
            <h2>Based on your Location in <span class="name"></span></h2>
            <div class="temperature">Temperature: <span class="temp"></span></div>
            <div class="icon1">
                <img  class="icon" alt="">
            </div>
            <div class="datas">
                <p>Humidity <br>
                    <span class="u humid"></span>
                </p>
                <p>Wind Speed <br>
                    <span class="u wind"></span>
                </p>
            </div>
            <div class="times">
                Time : <span class="time"></span>
            </div>
        </div>
        
        <div class="card">
            <h2>Based on searched result in : <span class="city"></span> city</h2>
            <p>It is : <span class="temp2"></span></p>
            <div class="icon1">
                <img class="searchedImage" alt="">
            </div>
            <div class="datas">
                <p>Humidity <br>
                    <span class="u humidUp"></span>
                </p>
                <p>Wind Speed <br>
                    <span class="u wind00"></span>
                </p>
            </div>
            <div class="times">
                Time : <span class="time1"></span>
            </div>
        </div>
        
        <div class="recommend">
            <div class="weather"></div>
            <div id="recommendations" class="recommenda">
            </div>
            <div class="view">
                <a href="recommend.html">View More</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <div id="forecast">
            <h3>In <span class="dog"></span> next 3 hours</h3>
            <div class="tudivs">
                    <div class="one">
                        <span class="span"></span>
                        <div class="infos">
                            <div class="foreimg">
                                <img class="icon2" alt="weather">
                            </div>
                            <div class="use">
                                <p class="d"></p>
                                <p class="e"></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="./Javascript/loading.js"></script>
    <script src="./Javascript/locator.js"></script>
    <script src="./Javascript/weather.js"></script>
    <script src="./Javascript/hourly.js"></script>
</body>
</html>
