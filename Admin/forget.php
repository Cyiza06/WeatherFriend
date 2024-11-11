<?php
    include('config/connect.php');

    $email = $_SESSION['oemail'];

    if (isset($_POST['signin'])) {
        $pass = $_POST['password'];
        $copass = $_POST['copass'];

        if ($pass !== $copass) {
            header('location:forget.php?log=Please enter correct confirm password');
        }else{
            $query = mysqli_query($connect,"UPDATE admin SET password = '$copass' WHERE email='$email'");
            if ($query) {
                $_SESSION['forgetEmail'] = $email;
                header('location:index.php?log=Password changed Successfully!');
                exit();
                session_unset();
                session_destroy();
            }
        }
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Forget Password</title> 
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
        <h2>WeatherFriend Admin dashboard Forget password Page</h2>
    </div>
    <form id="sign"  action="" method="POST">
            <h3>Sign Up Here</h3>    
            <hr>
    
            <label for="password1">Password:</label>
            <div class="password">
                <input  type="password" id="psw"   name="password" placeholder="Create your new password" required>
                <div class="img222"><img id="eye1" src="./img/icons8_eye.ico" alt="eye"></div>
            </div>
            <label for="password1">Confirm Password:</label>
            <div class="password">
                <input  type="password" class="psw"   name="copass" placeholder="Confirm your password" required>
                <div class="img222"><img class="eye1" onclick="ghe()" src="./img/icons8_eye.ico" alt="eye"></div>
            </div>
            <input type="submit" name="signin" class="submit" value="Update">   
            <span class="span">
                <button type="button" style="height: 30px;width:60px;border:0;border-radius:9px;cursor:pointer" class="form1" onclick="history.back()">Back</button>
            </span>
        </form>    
        <script src="js/password.js"></script>
</body>
</html>