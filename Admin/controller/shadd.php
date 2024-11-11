<?php
    include '../config/connect.php';

    
    if (!isset($_SESSION["id"])) {
        header("location:../index.php?log=Login or Signup first");
        exit();
    }

    if (isset($_POST['submit'])) {
        $shname = $_POST['shname'];
        $shloc = $_POST['shloc'];
        $shphn= $_POST['phn'];

        $sele = mysqli_query($connect,"SELECT * FROM shop WHERE shop_name='$shname' AND shop_loc ='$shloc'") or die(mysqli_error($connect));
        $row = mysqli_fetch_assoc($sele);
        
        if (empty($shname) && empty($shloc)) {
            header('location:shadd.php?log=fill all fields');
            exit();
        }elseif ($row['shop_name'] == $shname && $row['shop_loc'] == $shloc) {
            header('location:shadd.php?log=Shop already exists');
            exit();
        }else{
            
            $insert = mysqli_query($connect,"INSERT INTO shop VALUES('','$shname','$shloc','$shphn')") or die(mysqli_error($connect));
            
            if ($insert) {
                    echo "<script>
                        alert('Shop Added');window.location.href='../shop.php';
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
        <h3>Add Shop</h3>
        <label for="shname">Shop Name :</label>
        <input type="text" name="shname" placeholder="Enter shop name"required>
        <label for="funame">Shop Location :</label>
        <input type="text" name="shloc" id="shloc" placeholder="Enter shop's location" required>
        <label for="foname">Phone</label>
        <input type="text" name="phn" id="phn" placeholder="Enter shop's number" required><br>
        <input type="submit" class="submit" name="submit" value="Add">
    </form>
    <script src="../js/alert.js"></script>
</body>
</html>