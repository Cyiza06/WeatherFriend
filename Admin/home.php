<?php
    include("./config/connect.php");
    if (!isset($_SESSION["id"])) {
        header("location:index.php?log=Login or Signup first");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend Admin Dashboard</title>
    <style>
        <?php
            include './Styles/home.css';
        ?>
    </style>
</head>
<body>
    <nav>
        <div class="welcome">
            Welcome, <?=$_SESSION['Names']?>
        </div>
        <div class="links">
            <a href="home.php" class="active">Home</a>
            <a href="admin.php">Admins</a>
            <a href="shop.php">Shops</a>
            <a href="products.php">Products</a>
            <a href="weather.php">Weather</a>
        </div>
        <div class="logout">
            <a href="logout.php">Log out</a>
        </div>
    </nav>
    <div class="container">
        <h2>WeatherFriend Management Dashboard</h2><br>
        <div class="cards">
            <div class="card">
                <h3>Total Admin :</h3>
                <p>
                    <?php 
                        $select  = mysqli_query($connect,"SELECT * FROM admin");
                        $total = mysqli_num_rows($select);
                        echo $total;
                    ?>
                </p>
                <div class="sep">
                    <span>Admins :
                    <?php 
                        $select1  = mysqli_query($connect,"SELECT * FROM admin WHERE status ='accept'");
                        $total1 = mysqli_num_rows($select1);
                        echo $total1;
                    ?>
                    </span>
                    <span>Pending :
                    <?php 
                        $select2  = mysqli_query($connect,"SELECT * FROM admin WHERE status ='deny'");
                        $total2 = mysqli_num_rows($select2);
                        echo $total2;
                    ?>    
                    </span>
                </div>
                <a href="admin.php">View Admins</a>  
            </div>
            <div class="card">
                <h3>Total Shops :</h3>
                <p>
                    <?php 
                        $select1  = mysqli_query($connect,"SELECT * FROM shop");
                        $total1 = mysqli_num_rows($select1);
                        echo $total1;
                    ?>
                </p>
                <div class="sep">
                    <span>Admins :
                    <?php 
                        $select1  = mysqli_query($connect,"SELECT * FROM admin WHERE status ='accept'");
                        $total1 = mysqli_num_rows($select1);
                        echo $total1;
                    ?>
                    </span>
                    <span>Pending :
                    <?php 
                        $select2  = mysqli_query($connect,"SELECT * FROM admin WHERE status ='deny'");
                        $total2 = mysqli_num_rows($select2);
                        echo $total2;
                    ?>    
                    </span>
                </div>
                <a href="shop.php">View Shops</a>  
            </div>
            <div class="card">
                <h3>Total Products :</h3>
                <p>
                    <?php 
                        $select1  = mysqli_query($connect,"SELECT * FROM products");
                        $total1 = mysqli_num_rows($select1);
                        echo $total1;
                    ?>
                </p>
                <div class="sep">
                    <span>Admins :
                    <?php 
                        $select1  = mysqli_query($connect,"SELECT * FROM admin WHERE status ='accept'");
                        $total1 = mysqli_num_rows($select1);
                        echo $total1;
                    ?>
                    </span>
                    <span>Pending :
                    <?php 
                        $select2  = mysqli_query($connect,"SELECT * FROM admin WHERE status ='deny'");
                        $total2 = mysqli_num_rows($select2);
                        echo $total2;
                    ?>    
                    </span>
                </div>
                <a href="products.php">View Products</a>  
            </div>
        </div>
    </div>
    <div class="footer">
        
    </div>
</body>
</html>