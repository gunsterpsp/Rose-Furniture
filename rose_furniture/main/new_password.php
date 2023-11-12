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

        if(!isset($_SESSION['otp'])){
          header("Location: home");
        }
        if(isset($_POST["reset"])){
            $psw = mysqli_real_escape_string($conn, $_POST["password"]);
            $psw_2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);
            // $token = $_SESSION['token'];
            $_SESSION['mail'];
            $email = $_SESSION['mail'];
            $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email ='".$_SESSION['mail']."'");
            $query = mysqli_num_rows($sql);
            $fetch = mysqli_fetch_assoc($sql);
            if($_SESSION['mail']){
                if ($psw != $psw_2) {
                    echo '*Two password does not match please try again!';
                }else{
                $new_pass = $psw;
                mysqli_query($conn, "UPDATE tbl_users SET password ='$new_pass' WHERE email='".$_SESSION['mail']."'");
                header("Location: password_changed");
                session_destroy();
    
                }
            }else{
                ?>
                <script>
                    alert("<?php echo "Please try again"?>");
                </script>
                <?php
            }
        }  
      ?>
		<div class="input">
     	<input type="password" name="password" autocomplete="off" placeholder="New Password">
		</div>
    <div class="input">
     	<input type="password" name="confirm_password" autocomplete="off" placeholder="Confirm Password">
		</div><br>
    
		
		<button class ="btn-log" type="submit" name="reset">Continue</button>

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