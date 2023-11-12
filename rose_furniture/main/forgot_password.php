<?php
#include "../server/autodeleteuseraccount.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
</head>
<body>
<div class="log">
    <form method="post">
		<img src ="../assets/img/logo.png" class ="image">
          <?php
            include '../database/connection.php';
            use phpmailer\PHPMailer\PHPMailer;
            use phpmailer\PHPMailer\SMTP;
            use phpmailer\PHPMailer\Exception;

            if(isset($_POST['email'])){
              $email = $_POST["email"];
              $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email = '$email'");
              $query = mysqli_num_rows($sql);
                $fetch = mysqli_fetch_assoc($sql);
               @$_SESSION['f_name'] = $fetch['first_name'] . ' ' . $fetch['last_name'] ;
               @$_SESSION['fetchID'] = $fetch['user_id'];
               $my_id = $_SESSION['fetchID'];
              if(mysqli_num_rows($sql) <= 0){
                  echo 'Sorry email does not exist, Please try again!';
              }else{
                  // generate token by binaryhexa 
                  $otp = rand(100000,999999);
                  $_SESSION['otp'] = $otp;
                  $_SESSION['mail'] = $email;
      
                  $_SESSION['email'] = $email;
                  $_SESSION['session_id'] = $my_id;
                  $session_id = $_SESSION['session_id'];
      
                  // PHP MAILER Commands
                  require '../phpmailer/src/Exception.php';
                  require '../phpmailer/src/PHPMailer.php';
                  require '../phpmailer/src/SMTP.php';
                  
                  
                  $mail = new PHPMailer(true);
                  $mail->SMTPDebug = SMTP::DEBUG_OFF;
                  $mail->isSMTP();
                  $mail->Host = 'smtp.gmail.com'; 
                  $mail->SMTPAuth = true;
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                  $mail->Username = "rosefurniture.notifications@gmail.com";
                  $mail->Password = "dgqhrgltkiqekajj";
                  $mail->setfrom("rosefurniture.notifications@gmail.com");
                  $mail->Subject = "Reset Password";
                  $mail->Port = 465; 
                  $mail->IsHTML(true);
                  $mail->Body = 'Reset password';			   
                  $mail->addAddress($email);	
                  $mail->addcc($email);
                  $mail->Body='
                  
                        <!doctype html>
                        <html lang="en">
                          <head>
                            <!-- Required meta tags -->
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <style>
                                  .container {
                                    display: grid;
                                    grid-template-rows: 200px 1fr 1fr;
                                    border: 1px solid black;
                                    width: 700px;
                                  }
                            </style>
                          </head>
                          <body>
                                <div class="container">
                                  <div style="margin-left: 2em;">
                                  <h3 style="color: black;">Hi '.$_SESSION['f_name'].'</h3>
                                  <h4 style="color: black;">This is your verification code to reset your password,</h4>
                                  <center><h1 style="color: black;">'.$otp.'</h1></center>
                                  </div>
                            </div>
                          </body>
                        </html>
                  
                  ';
      
                  $mail->send();
  
                  ?>
                  <script>
                     alert("Please kindly check your email inbox for your verification code to reset your password.")
                      window.location.replace("verification");
                  </script>
                  <?php
              }
          }
            
          ?>
		<div class="input">
     	<input type="text" id="email" name="email" autocomplete="off" placeholder="Email"><br>
		</div>
		
		<button class ="btn-log" type="submit">Reset</button>

		<!-- <div class="forgot_password">
		<a href="forgot_password">Forgot password?</a>
		</div> -->

		<div class="signup_link">
		Already have an account?
		<a href="login">Login here</a>
		</div>
     </form>
	<script type="text/javascript">
		loginForm.addEventListener('input', () =>{
			if (username.value.length > 0 && password.value.length > 0){
				loginButton.removeAttribute('disabled');
			}else{
				loginButton.setAttribute('disabled', 'disabled');
			}
		});
	</script>
</div>
</body>
</html>