<?php
    include '../config/connect.php';

    if (!isset($_SESSION['id'])) {
        header('location:../index.php?log=Login or Signup first');
        exit;
    }
    $update = $_GET['updateId'];
    $select = mysqli_query($connect,"SELECT * FROM products WHERE p_id='$update' LIMIT 1");
    $row1 = mysqli_fetch_assoc($select);

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
            $insert = mysqli_query($connect,"UPDATE products SET p_name ='$name',p_image='$imagename',w_id='$we',shop_id='$sho,category='$pcat' WHERE p_id = '$update'");
            
            if ($insert) {
                unlink('../img/uploads/'. $row1['p_image']);
                echo "
                <script>
                    alert('Product Upadted !');location.href ='../products.php'
                </script>
                ";
            }

        }else{
            header('location:pup.php?log=Fill all fields');
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
        <input type="text" name="pname" value="<?=$row1['p_name']?>"required>
        <label for="funame">Product Image :</label>
        <input class="file" type="file" name="pimage" required>
        <label for="wid">Weather Condition</label>
            <select name="wid" id="wid" required>
                <option selected><?=$row1['w_id']?></option>
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
                <option selected><?=$row1['shop_id']?></option>
                <?php
                    $select = mysqli_query( $connect,"SELECT * FROM shop") or die(mysqli_error($connect));
                    while ($row = mysqli_fetch_array($select)) {?>
                        <option value="<?=$row['shop_id']?>"><?php echo $row['shop_id'] . "." .$row['shop_name']?></option>
                <?php 
                    }
                ?>
            </select>
            <label for="shname">Product Category :</label>
            <input type="text" name="pcat" value="<?=$row1['category']?>"required>
        <input type="submit" class="submit" name="submit" value="Update">
        </form>
        <script src="../js/alert.js"></script>
</body>
</html>