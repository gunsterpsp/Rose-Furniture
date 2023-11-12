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
		<div class="input">
     	Your password has been changed, You can now login your account!
		</div><br>
    

		<a href="login" style="cursor: pointer;">Login here</a>

		<!-- <div class="forgot_password">
		<a href="forgot_password">Forgot password?</a>
		</div> -->

		<!-- <div class="signup_link">
		Already have an account?
		<a href="login">Login here</a>
		</div> -->
     </form>

</div>
</body>
</html>