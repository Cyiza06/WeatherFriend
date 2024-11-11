<?php
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    include('config/connect.php');

    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $mail = new PHPMailer(true);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location:forget.php?log=Please enter correct email format');
        }else{
            $query = mysqli_query($connect,"SELECT email FROM admin WHERE email='$email'");
            if (mysqli_num_rows($query) > 0) {
                if ($row = mysqli_fetch_assoc($query)) {
                    $email2 = $row["email"];
                    $new_otp1 = rand(100000,999999);
                    try {
                       // $mail->SMTPDebug = 2;                               
                        $mail->isSMTP();                                      
                        $mail->Host       = 'smtp.gmail.com';               
                        $mail->SMTPAuth   = true;                             
                        $mail->Username   = 'habineza1111@gmail.com';               
                        $mail->Password   = 'rvnmanubekpdtcbt';
                        $mail->SMTPSecure = 'tls';                            
                        $mail->Port       = 587;                              
                        $mail->SMTPDebug  = 0;

                        // Recipients
                        $mail->setFrom('weatherFriend@gmail.com', 'WeatherFriend');
                        $mail->addAddress($email2); 
                    
                        // Content
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Your  OTP code has sent';
                        $mail->Body    = "<b>This is your forget password otp code :$new_otp1</b>";
                       // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        if($mail->send()){
                            $_SESSION['sendEmail'] = $email2;
                            $_SESSION['otp'] = $new_otp1;
                            header('location:fotp.php?log=Enter Verification code sent to your email');
                            exit();
                        }
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                }
            }else{
                header("location:email.php?log=No account matches that email");
                exit();
            }
        }
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherFriend | Enter Email</title> 
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
            <h3>Enter your email Here</h3>    
            <hr>
    
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <input type="submit" name="signin" class="submit" value="Send">   
            <span class="span">
                <button type="button" style="height: 30px;width:60px;border:0;border-radius:9px;cursor:pointer" class="form1" onclick="history.back()">Back</button>
            </span>
        </form>    
        <script src="js/alert.js"></script>
</body>
</html>