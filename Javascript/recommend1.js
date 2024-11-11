function fetchWeatherRecommendations(category) {
    // Check if the user is online
    if (!navigator.onLine) {
        document.getElementById('weatherOutput').innerHTML = 
        `<p class="weatherError">No Internet</p>`;
        return; // Exit if no internet
    }

    // Get geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                // Now that we have the location, we make the fetch request to retrieve weather data
                fetch(`./data.php?lat=${lat}&lon=${lon}&category=${category}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('weatherOutput').innerHTML = data;
                    })
                    .catch(error => {
                        console.log("Error fetching data:", error);
                        document.getElementById('weatherOutput').innerHTML = 
                        `<p class="weatherError">Unable to retrieve weather data.</p>`;
                    });
            },
            (error) => {
                console.log("Geolocation error: ", error);
                document.getElementById('weatherOutput').innerHTML = 
                `<p class="weatherError">Geolocation permission denied or unavailable.</p>`;
            }
        );
    } else {
        document.getElementById('weatherOutput').innerHTML = 
        `<p class="weatherError">Geolocation is not supported by this browser.</p>`;
    }
}

// Automatically call the function when the page loads
$(document).ready(function() {
    // Fetch the weather recommendations for a default category (e.g., 'Clothes') when the page loads
    fetchWeatherRecommendations('Clothes');  // You can set a default category here

    $(".prod").click(function() {
        $(".drop").slideToggle("slow");
    });

    $(".load-data").click(function(e) {
        e.preventDefault();
        let category = $(this).data("get");

        // Call the function to fetch recommendations based on the selected category
        fetchWeatherRecommendations(category);  // Pass the category selected by the user
    });
});
