<?php

    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // require 'vendor/autoload.php';

    include('config/connect.php');

    if (isset($_POST['signin'])) {
        $names = $_POST['names'];

        $mail = new PHPMailer(true);

        $in_email = $_POST['email'];
        $pass = $_POST['password'];

        // ibjk qwql bgyj uiyt

        $otp = rand(100000, 999999);

         $_SESSION['otp'] = $otp;
         $_SESSION['up_email'] = $in_email;
         $_SESSION['up_names'] = $names;
         $_SESSION['up_pass'] = $pass;

        $insert1 = mysqli_query($connect, "SELECT * FROM admin WHERE email = '$email'");
        $row = mysqli_fetch_assoc($insert1);
        if (mysqli_num_rows($insert1) == 0) {
            try {
            // $mail->SMTPDebug = 2;                                 
                $mail->isSMTP();                                     
                $mail->Host       = 'smtp.gmail.com';               
                $mail->SMTPAuth   = true;                             
                $mail->Username   = 'ishimwemustapha2006@gmail.com';         
                $mail->Password   = 'ibjkqwqlbgyjuiyt'; 
                $mail->SMTPSecure = 'tls';                          
                $mail->Port       = 587;                             
                $mail->SMTPDebug  = 0;

                // Sender

                $mail->setFrom('WeatherFriend@gmail.com', 'WeatherFriend');
                $mail->addAddress($in_email); 
            
                // Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Your weatherfriend OTP code for sign up';
                $mail->Body    = "<b>Your weatherfriend OTP code for sign up is :$otp</b>";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                if($mail->send()){
                    header('location:otp.php?log=Enter your verification code that is sent to your email ');
                    exit();
                }
            } 
            catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else{
            header('location:signup.php?log=User Already exist!');
            exit();
        }
    }
    // making cookies
    
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
    // closing cookies\

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Sign up</title> 
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
        <h2>WeatherFriend Admin dashboard signup Page</h2>
    </div>
    <form id="sign"  action="" method="POST">
            <h3>Sign Up Here</h3>    
            <hr>

            <label for="email1">User name :</label>
            <input type="text" name="names" id="email1" placeholder="Create Your user name" required>

            <label for="email1">E-mail :</label>
            <input type="email" name="email" id="email1" placeholder="Enter your E-mail" required>
    
            <label for="password1">Password:</label>
            <div class="password">
                <input  type="password" id="psw"   name="password" required>
                <div class="img222"><img id="eye1" src="./img/icons8_eye.ico" alt=""></div>
            </div><br>
            <input type="submit" name="signin" class="submit" value="Sign Up">   
            <span class="span">
                <a class="form1" href="index.php">Already have an account ?</a>
            </span>
        </form>    
        <script src="js/password.js"></script>
</body>
</html>