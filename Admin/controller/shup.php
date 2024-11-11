<?php
    include '../config/connect.php';
    
    
    if (!isset($_SESSION["id"])) {
        header("location:../index.php?log=Login or Signup first");
        exit();
    }
    $update = $_GET['updateId'];
    $select = mysqli_query($connect,"SELECT * FROM shop WHERE shop_id='$update' LIMIT 1");
    $row1 = mysqli_fetch_assoc($select);

    if (isset($_POST['submit'])) {
        $shname = $_POST['shname'];
        $shloc = $_POST['shloc'];
        $shphn= $_POST['phn'];

        $sele = mysqli_query($connect,"SELECT * FROM shop WHERE shop_name='$shname' AND shop_loc ='$shloc'") or die(mysqli_error($connect));
        $row = mysqli_fetch_assoc($sele);
        
        if (empty($shname) && empty($shloc)) {
            header('location:shup.php?log=fill all fields');
            exit();
        }elseif ($row['shop_name'] == $shname && $row['shop_loc'] == $shloc) {
            header('location:shup.php?log=Shop already exists');
            exit();
        }else{
            
            $insert = mysqli_query($connect,"UPDATE shop SET shop_name='$shname',shop_loc='$shloc',phone='$shphn' WHERE shop_id='$update'") or die(mysqli_error($connect));
            
            if ($insert) {
                    echo "<script>
                        alert('Shop Updated !');window.location.href='../shop.php';
                    </script>";
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo ltd | Furniture Add</title>
    <style>
        <?php
            include './form.css';
        ?>
    </style>
</head>
<body>
    <?php if (isset($_GET['log'])){ ?>
        <div class="alert"><p><?php echo $_GET['log']; ?></p> <span class="close">&times;</span></div>
    <?php }?>
    <form action="" method="post">
        <h3>Update Shop</h3>
        <label for="shname">Shop Name :</label>
        <input type="text" name="shname" value="<?=$row1['shop_name']?>" required>
        <label for="funame">Shop Location :</label>
        <input type="text" name="shloc" id="shloc" value="<?=$row1['shop_loc']?>" required>
        <label for="foname">Phone :</label>
        <input type="text" name="phn" id="phn" value="<?=$row1['phone']?>" required><br>
        <input type="submit" class="submit" name="submit" value="Update">
    </form>
    <script src="../js/alert.js"></script>
</body>
</html>