<?php
include("./config/connect.php");


if (!isset($_SESSION["id"])) {
    header("location:index.php");
    exit();
}

    if (isset($_GET['delId'])) {
        $key = $_GET['delId'];
        $query = mysqli_query($connect,"DELETE FROM shop where shop_id =  '$key'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Shops</title>
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
            <a href="shop.php" class="active">Shops</a>
            <a href="products.php">Products</a>
            <a href="weather.php">Weather</a>
        </div>
        <div class="logout">
            <a href="logout.php">Log out</a>
        </div>
    </nav>
    <table border="1" cellspacing="0">
        <caption>Shops Available Review <a href="./controller/shadd.php">&plus;Add Shop</a></caption>
        <tr>
            <th>&numero;</th>
            <th>Shop Name</th>
            <th>Shop Location</th>
            <th>Shop Phone</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
            $fetch = mysqli_query($connect,"SELECT * FROM shop");
             $count = 1;
            if (mysqli_num_rows($fetch) > 0) {
                foreach ($fetch as $furn) {
        ?>
        <tr>
            <td><?=$count?></td>
            <td><?=$furn['shop_name']?></td>
            <td><?=$furn['shop_loc']?></td>
            <td><?=$furn['phone']?></td>
            <td class="s">
                <a href="./controller/shup.php?updateId=<?=$furn['shop_id']?>">Update</a>
                <a href="?delId=<?=$furn['shop_id']?>">Delete</a>
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