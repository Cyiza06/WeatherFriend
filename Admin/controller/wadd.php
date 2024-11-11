<?php
    include("../config/connect.php");

    if (!isset($_SESSION["id"])) {
        header("location:../index.php?log=Login or Signup first");
        exit();
    }

    if (isset($_POST['submit'])) {
        $foname = $_POST['condition'];

        $sele = mysqli_query($connect,"SELECT * FROM weathercondition WHERE weatherCondition='$foname'") or die(mysqli_error($connect));
        $row = mysqli_fetch_assoc($sele);

        if ($row['weatherCondition'] == $foname) {
            header('location:wadd.php?log=Condition already exists');
            exit();
        }else{
            $insert = mysqli_query($connect,"INSERT INTO weathercondition VALUES('','$foname')") or die(mysqli_error($connect));
    
            if ($insert) {
                echo "<script>
                    alert('WeatherCondition Added');window.location.href='../weather.php';
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
    <title>Dashboard | Add Admin</title>
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
        <h3>Add Weather Condition:</h3>
        <label for="funame">Condition :</label><br>
        <input type="text" name="condition" id="funame" placeholder="Enter Weather Condition" required><br><br>
        <input type="submit" class="submit" name="submit" value="Add">
    </form>
    <script src="../js/alert.js"></script>
</body>
</html>