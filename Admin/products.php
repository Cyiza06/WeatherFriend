<?php
    include("./config/connect.php");

    
    if (!isset($_SESSION["id"])) {
        header("location:index.php?log=Login or Signup first");
        exit();
    }
    if (isset($_GET['deleteId'])) {
        $key = $_GET['deleteId'];
        $select = mysqli_query($connect,"SELECT * FROM products WHERE p_id='$key' LIMIT 1");
        $row1 = mysqli_fetch_assoc($select);

        unlink('./img/uploads/'. $row1['p_image']);

        $query = mysqli_query($connect,"DELETE FROM products where p_id = '$key'");
        if ($query) {    
                echo "
                <script>
                    alert('Product Deleted Successfully !');location.href ='products.php'
                </script>
                ";

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Products</title>
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
            <a href="products.php" class="active">Products</a>
            <a href="weather.php">Weather</a>
        </div>
        <div class="logout">
            <a href="logout.php">Log out</a>
        </div>
    </nav>
    <table border="1" cellspacing="0">
        <caption>WeatherFriend products Table <a href="./controller/padd.php">&plus;Add Product</a></caption>
        <tr>
            <th>&numero;</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Weather Condition</th>
            <th>Shop Name</th>
            <th>Category</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
            $fetch = mysqli_query($connect,"SELECT * FROM products");
             $count = 1;
            if (mysqli_num_rows($fetch) > 0) {
                foreach ($fetch as $furn) {
        ?>
        <tr>
            <td><?=$count?></td>
            <td><?=$furn['p_name']?></td>
            <td>
                <center><img src="./img/uploads/<?=$furn['p_image']?>" alt=""></center>   
            </td>
            <td>
                <?php
                    $id = $furn["w_id"];
                    $sel = mysqli_query($connect,"SELECT weatherCondition FROM weathercondition WHERE w_id ='$id'");
                    $name = mysqli_fetch_assoc($sel);
                    echo $name['weatherCondition']
                ?>
            </td>
            <td>
                <?php
                    $id = $furn["shop_id"];
                    $sel = mysqli_query($connect,"SELECT shop_name FROM shop WHERE shop_id ='$id'");
                    $name = mysqli_fetch_assoc($sel);
                    echo $name['shop_name']
                ?>
            </td>
            <td><?=$furn['category']?></td>
            <td class="s">
                <a href="./controller/pup.php?updateId=<?=$furn['p_id']?>">Update</a>
                <a href="?deleteId=<?=$furn['p_id']?>">Delete</a>
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