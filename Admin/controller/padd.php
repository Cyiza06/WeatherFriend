<?php
    include '../config/connect.php';

    if (!isset($_SESSION['id'])) {
        header('location:../index.php?log=Login or Signup first');
        exit;
    }

    if (isset($_POST['submit'])) {
        $name = $_POST['pname'];
        $image = $_FILES['pimage'];
        $imagename = $image['name'];
        $dir = '../img/uploads/' . $imagename;
        move_uploaded_file($image['tmp_name'], $dir);
        $we = $_POST['wid'];
        $sho = $_POST['shid'];
        $pcat = $_POST['pcat'];

        if (!empty($name) && !empty($sho)) {
            $insert = mysqli_query($connect,"INSERT INTO products VALUES('','$name','$imagename','$we','$sho','$pcat')");

            if ($insert) {
            echo "
            <script>
                alert('Product added');location.href ='../products.php'
            </script>
            ";
            }
        }else{
            header('location:padd.php?log=Fill all fields');
            exit();
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Add product</title>
    <style>
        <?php include './form.css' ?>
    </style>
</head>
<body>
<?php if (isset($_GET['log'])){ ?>
        <div class="alert"><p><?php echo $_GET['log']; ?></p> <span class="close">&times;</span></div>
    <?php }?>
    <form action="" enctype="multipart/form-data" method="post">
        <h3>Add Product</h3>
        <label for="shname">Product Name :</label>
        <input type="text" name="pname" placeholder="Enter product name"required>
        <label for="funame">Product Image :</label>
        <input class="file" type="file" name="pimage" required>
        <label for="wid">Weather Condition</label>
            <select name="wid" id="wid" required>
                <option disabled selected>Select Condition</option>
                <?php
                    $select = mysqli_query( $connect,"SELECT * FROM weathercondition") or die(mysqli_error($connect));
                    while ($row = mysqli_fetch_array($select)) {?>
                        <option value="<?=$row['w_id']?>"><?php echo $row['w_id'] . "." .$row['weatherCondition']?></option>
                <?php 
                    }
                ?>
            </select>
        <label for="shid">Shop Name</label>
            <select name="shid" id="shid" required>
                <option disabled selected>Select Shop</option>
                <?php
                    $select = mysqli_query( $connect,"SELECT * FROM shop") or die(mysqli_error($connect));
                    while ($row = mysqli_fetch_array($select)) {?>
                        <option value="<?=$row['shop_id']?>"><?php echo $row['shop_id'] . "." .$row['shop_name']?></option>
                <?php 
                    }
                ?>
            </select>
            <label for="pcat">Product Category :</label>
            <select name="pcat" required>
                <option value="<?='Clothes'?>">Clothes</option>
                <option value="<?='Drinks'?>">Drinks</option>
                <option value="<?='Meal'?>">Meal</option>
                <option value="<?='Beverage'?>">Beverage</option>
            </select>

        <input type="submit" class="submit" name="submit" value="Add">
        </form>
</body>
</html>