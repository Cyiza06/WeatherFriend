<?php
include("./config/connect.php");


if (!isset($_SESSION["id"])) {
    header("location:index.php");
    exit();
}

    if (isset($_GET['delId'])) {
        $key = $_GET['delId'];
        $query = mysqli_query($connect,"DELETE FROM weathercondition where w_id =  '$key'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | WeatherCondition</title>
    <style>
        <?php
            include './styles/products.css';
        ?>
    </style>
</head>
<body>
    <nav>
        <div class="welcome">
            Welcome, <?=$_SESSION['Names']?>
        </div>
        <div class="links">
            <a href="home.php">Home</a>
            <a href="admin.php">Admins</a>
            <a href="shop.php">Shops</a>
            <a href="products.php">Products</a>
            <a href="weather.php" class="active">Weather</a>
        </div>
        <div class="logout">
            <a href="logout.php">Log out</a>
        </div>
    </nav>
    <table border="1" cellspacing="0">
        <caption>Waether Condition Review <a href="./controller/wadd.php">&plus;Add Weather</a></caption>
        <tr>
            <th>&numero;</th>
            <th>Weather Condition</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
            $fetch = mysqli_query($connect,"SELECT * FROM weathercondition");
             $count = 1;
            if (mysqli_num_rows($fetch) > 0) {
                foreach ($fetch as $furn) {
        ?>
        <tr>
            <td><?=$count?></td>
            <td><?=$furn['weatherCondition']?></td>
            <td class="s">
                <a href="./controller/wup.php?updateId=<?=$furn['w_id']?>">Update</a>
                <a href="?delId=<?=$furn['w_id']?>">Delete</a>
            </td>
        </tr>
        <?php
        $count = $count + 1;
            }
        }
            ?>
    </table>
</body>
</html>