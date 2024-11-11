<?php
    include("./config/connect.php");
    $email = $_SESSION["email"];
    if (!isset($_SESSION["id"])) {
        header("location:index.php");
        exit();
    }

    if (isset($_GET['delId'])) {
        $key = $_GET['delId'];
        $query = mysqli_query($connect,"DELETE FROM admin where id =  '$key'");
    }
    if (isset($_GET['oya'])) {
        $key = $_GET['oya'];
        $query = mysqli_query($connect,"UPDATE admin SET status = 'accept' WHERE id = '$key'");
    }
    if (isset($_GET['oya2'])) {
        $key = $_GET['oya2'];
        $query = mysqli_query($connect,"UPDATE admin SET status = 'deny' WHERE id = '$key'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Admins</title>
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
            <a href="admin.php" class="active">Admins</a>
            <a href="shop.php">Shops</a>
            <a href="products.php">Products</a>
            <a href="weather.php">Weather</a>
        </div>
        <div class="logout">
            <a href="logout.php">Log out</a>
        </div>
    </nav>
    <table border="1" cellspacing="0">
        <caption>Admin Table</caption>
        <tr>
            <th>&numero;</th>
            <th>Admin Name</th>
            <th>Admin Email</th>
            <th>Status</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
            $fetch = mysqli_query($connect,"SELECT * FROM admin WHERE email NOT LIKE '%$email%'");
             $count = 1;
            if (mysqli_num_rows($fetch) > 0) {
                foreach ($fetch as $furn) {
        ?>
        <tr>
            <td><?=$count?></td>
            <td><?=$furn['Name']?></td>
            <td><?=$furn['email']?></td>
            <td style="text-align:center">
                <?php
                    if ($furn['status'] != 'accept') {?>
                        <a class="make" href="?oya=<?=$furn['id']?>">Make Admin</a>    
                <?php }else {?>
                    <a class="remo" href="?oya2=<?=$furn['id']?>">Remove Admin</a>    
                <?php }
                ?>
            </td>
            <td class="s">
                <a href="./controller/adup.php?updateId=<?=$furn['id']?>">Update</a>
                <a href="?delId=<?=$furn['id']?>">Delete</a>
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