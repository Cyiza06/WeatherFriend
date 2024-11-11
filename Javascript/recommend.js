// getting latitude and longitude

if (!navigator.onLine) {
    document.getElementById('weatherOutput').innerHTML = 
    `<p class="weatherError">
        No Internet
    </p>`;
} else {
    function fetchWeatherRecommendations(category = '') {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    
                    // Construct URL to fetch weather and recommendations
                    let url = `./data.php?lat=${lat}&lon=${lon}`;
                    
                    if (category) {
                        url += `&get=${category}`; // Add the category to the request
                    }
                    
                    fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('weatherOutput').innerHTML = data;
                        })
                        .catch(error => {
                            console.log("Error fetching data:", error);
                            document.getElementById('weatherOutput').innerHTML = `<p class="weatherError">Unable to retrieve weather data.</p>`;
                        });
                },
                (error) => {
                    console.log("Geolocation error: ", error);
                    document.getElementById('weatherOutput').innerHTML = `<p class="weatherError">Geolocation permission denied or unavailable.</p>`;
                }
            );
        } else {
            document.getElementById('weatherOutput').innerHTML = `<p class="weatherError">Geolocation is not supported by this browser.</p>`;
        }
    }
    
    // Add event listeners to category links
    const categoryLinks = document.querySelectorAll('.load-data');
    categoryLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const category = e.target.getAttribute('data-get');
            fetchWeatherRecommendations(category); // Fetch recommendations for the selected category
        });
    });
    
    // Initially fetch weather data with no category
    fetchWeatherRecommendations();    
}
