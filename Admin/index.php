<?php
    include('config/connect.php');

    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (empty($email) || empty($pass)) {
            header('location:index.php?log=Fill all inputs first');
            exit();
        }else{
            
            $insert = mysqli_query($connect, "SELECT * FROM admin WHERE email = '$email' AND password = '$pass' limit 1");
            $row = mysqli_fetch_assoc($insert);
            
            if ($row["email"] != $email && $row["password"] != $pass) {
                header('location:index.php?log=User does not exist');
                exit();
            }else{
                if ($row['status'] == 'deny') {
                    header('location:index.php?log=You dont have permission to access dashboard');
                    exit();
                }else{
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['Names'] = $row['Name'];
                    $_SESSION['id'] = $row['id'];
                
                    setcookie('remember', $row['id'], time() + (86400 * 30),'/');
                
                    echo "<script>alert('You will be logged in for 30 days');location.href='home.php'</script>";
                }
            }
            
        }
    }

    if (isset($_SESSION['id'])) {
        header('location:home.php');
        exit();
    }elseif (isset($_COOKIE['remember'])) {
        $id = $_COOKIE['remember'];

        $insert = mysqli_query($connect, "SELECT * FROM admin WHERE id = '$id'");

        if ($insert) {
            $row = mysqli_fetch_assoc($insert);
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];

            echo "<script>location.href='home.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Log In</title> 
    <style>
        <?php include 'Styles/form.css'?>
        <?php include 'Styles/password.css'?>
    </style>
</head>
<body>
    <?php if (isset($_GET['log'])){ ?>
        <div class="alert"><p><?php echo $_GET['log']; ?></p> <span class="close">&times;</span></div>
    <?php }?>
    <div class="header">
        <h2>WeatherFriend Admin dashboard Login Page</h2>
    </div>
    <form  action="" method="POST">
            <h3>Sign In Here</h3>    
            <hr>
            <?php if (isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php }?>

            <?php if (isset($_SESSION['email'])) {?>
                <label for="email1">E-mail :</label>
                <input type="email" name="email" id="email1" readonly value="<?=$_SESSION['email']?>">
                    
            <?php }elseif (isset($_SESSION['forgetEmail'])) {?>
                <label for="email1">E-mail :</label>
                <input type="email" name="email" id="email1" readonly value="<?=$_SESSION['forgetEmail']?>">
                    
            <?php }else{?>
                <label for="email1">E-mail :</label>
                <input type="email" name="email" id="email1" placeholder="Enter your E-mail">
            <?php }?>
    
            <label for="password1">Password:</label>
            <div class="password">
                <input  type="password" id="psw"   name="password">
                <div class="img222"><img id="eye1" src="./img/icons8_eye.ico" alt=""></div>
            </div>
            <input type="submit" name="signin" class="submit" value="Sign In">

            <span class="span">
                <a href="email.php">forgot password ?</a>
                <a class="form1" href="signup.php">don't have an account ?</a>
            </span>
        </form>    
        <script src="js/password.js"></script>
</body>
</html>