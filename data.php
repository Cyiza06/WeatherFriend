<?php
include './config/connect.php';

$apiKey = "8220fed63641b31dff665b5334793302";

$lat = isset($_GET['lat']) ? $_GET['lat'] : "YOUR_DEFAULT_LATITUDE";
$lon = isset($_GET['lon']) ? $_GET['lon'] : "YOUR_DEFAULT_LONGITUDE";

$weatherApiUrl = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&units=metric";
$weatherData = file_get_contents($weatherApiUrl);
$weather = json_decode($weatherData, true);

if (!$weatherData) {
    echo "<p class='weatherError'>Unable to retrieve weather data.</p>";
    exit;
}

if ($weather && isset($weather['weather'][0]['main'])) {
    $condition = $weather['weather'][0]['main'];
    $temperature = round($weather['main']['temp']);

    echo "<h3>Current Weather: $condition, Temperature: $temperature °C</h3>";

    // Handle category from GET request
    if (isset($_GET['get'])) {
        $key = $_GET['get'];
        $sql = "SELECT products.p_name,products.p_image,products.shop_id,weathercondition.weatherCondition
                FROM products 
                INNER JOIN weathercondition
                ON products.w_id = weathercondition.w_id
                WHERE weathercondition.weatherCondition = ? AND products.category = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $condition, $key);
    } else {
        $sql = "SELECT products.p_name,products.p_image,products.shop_id,weathercondition.weatherCondition
                FROM products 
                INNER JOIN weathercondition
                ON products.w_id = weathercondition.w_id
                WHERE weathercondition.weatherCondition = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $condition);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='card-container'>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = './Admin/img/uploads/' . htmlspecialchars($row['p_image']);
            $shop_id = $row['shop_id'];

            $shopSql = "SELECT * FROM shop WHERE shop_id = ?";
            $shopStmt = $connect->prepare($shopSql);
            $shopStmt->bind_param("i", $shop_id);
            $shopStmt->execute();
            $shopResult = $shopStmt->get_result();
            $shop = $shopResult->fetch_assoc();

            echo "
            <div class='card'>
                <img src='$imagePath' alt='" . htmlspecialchars($row['p_name']) . "'>
                <h5>Product Name: " . htmlspecialchars($row['p_name']) . "</h5>
                <h5>Available in: " . htmlspecialchars($shop['shop_name']) . "</h5>
                <h5>Shop in: " . htmlspecialchars($shop['shop_loc']) . "</h5>
                <h5>Phone number: " . htmlspecialchars($shop['phone']) . "</h5>
            </div>";
        }
    } else {
        echo "<div class='card'><p>No products available for this category.</p></div>";
    }
    echo "</div>";

    $stmt->close();
} else {
    echo "<p class='weatherError'>Unable to retrieve weather data.</p>";
}
?>
