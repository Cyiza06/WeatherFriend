<?php
    include("../config/connect.php");

    if (!isset($_SESSION["id"])) {
        header("location:../index.php?log=Login or Signup first");
        exit();
    }

    $update = $_GET['updateId'];
    $select = mysqli_query($connect,"SELECT * FROM weathercondition WHERE w_id = '$update' LIMIT 1");
    $row = mysqli_fetch_assoc($select);

    if (isset($_POST['submit'])) {
        $foname = $_POST['condition'];

        $insert = mysqli_query($connect,"UPDATE weathercondition SET weatherCondition ='$foname' WHERE w_id = '$update'") or die(mysqli_error($connect));

        if ($insert) {
            echo "<script>
                alert('Condtion Updated!');window.location.href='../weather.php';
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Weather Update</title>
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
        <h3>Update Weather Condition:</h3>
        <label for="funame">Condition :</label><br>
        <input type="text" name="condition" id="funame" value="<?=$row['weatherCondition']?>" required><br><br>
        <input type="submit" class="submit" name="submit" value="Update">
    </form>
    <script src="../js/alert.js"></script>
</body>
</html>