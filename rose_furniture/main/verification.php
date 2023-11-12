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

        if(!isset($_SESSION['mail'])){
          header("Location: home");
        }
        if(isset($_POST["verify"])){
            $otp = $_SESSION['otp'];
            $_SESSION['mail'];
            $email = $_SESSION['mail'];
            $otp_code = $_POST['otp_code'];
    
            if($otp != $otp_code){
              echo 'Invalid <b>(verification code)</b> please try again!';
            }else{
                ?>
                 <script>
                       window.location.replace("new_password");
                 </script>
                 <?php
            }
        }
      
      ?>
		<div class="input">
     	<input type="text" name="otp_code" autocomplete="off" placeholder="Verification Code"><br>
		</div>
		
		<button class ="btn-log" type="submit" name="verify">Continue</button>

		<!-- <div class="forgot_password">
		<a href="forgot_password">Forgot password?</a>
		</div> -->

		<div class="signup_link">
		Already have an account?
		<a href="login">Login here</a>
		</div>
     </form>

</div>
</body>
</html>