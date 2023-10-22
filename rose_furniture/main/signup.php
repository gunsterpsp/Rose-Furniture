<?php

?>

<!DOCTYPE html>
<html>
<head>
  	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/signup.css">
</head>
<body>
<div class="log">
    <form action="../server/signup.php" class="log_form" id="loginForm" method="post">
		<img src ="../assets/img/logo.png" class ="image">
		<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		<div class="input">
     	<input type="text" name="username" autocomplete="off" placeholder="Enter Username" required=""><br>
     	<input type="password" name="password" id="password" autocomplete="off" placeholder="Enter Password" required=""><i class="fa fa-eye eyebutton" aria-hidden="true" id="toggleType_password"></i><br>
		</div>
		
		<button class ="btn-log" type="submit" name="submit">Submit</button>

		<div class="member">
		Already a member?
		<a href="../forms/login.php">Click here</a>
		</div>
     </form>
</div>
<script type="text/javascript">
  const toggleType_password = document.querySelector('#toggleType_password');
  const password = document.querySelector('#password');
 
  toggleType_password.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
    #Success
    if($notification=='UsernameAlreadyExist'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      text: "Username Already Exist. Please try another one",
      showConfirmButton: false,
      timer: 2500
    })
      </script>';
    }
?>
</body>
</html>