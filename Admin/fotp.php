<?php
    include("./config/connect.php");

   

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $otp = $_POST['code'];
        $email = $_SESSION['sendEmail'];

        if (isset($_SESSION['otp'])&& $otp == $_SESSION['otp']) {
        
            $_SESSION['oemail'] = $email;
            header('location:forget.php?log=Now you can change your password!');
            exit();
            
        } else {
            header('location:otp.php?log=Invalid otp!');
            exit();
        }
    }
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
        <h2>WeatherFriend Admin dashboard verification Page</h2>
    </div>
    <form id="sign"  action="" method="POST">
            <h3>Forget Password Verification</h3>    
            <hr>
    
            <label for="code">Verification Code :</label><br>
            <input  type="password" name="code" placeholder="Enter your verificarion code here" required><br>
            
            <input type="submit" name="signin" class="submit" value="Send">   
            <span class="span">
                <button type="button" style="height: 30px;width:60px;border:0;border-radius:9px;cursor:pointer" class="form1" onclick="history.back()">Back</button>
            </span>
    </form>    
    <script src="js/alert.js"></script>
</body>
</html>