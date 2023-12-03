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
<?php
    include '../database/connection.php';
    error_reporting(0);

        global $conn;
        if (isset($_POST['login_Submit'])){
            if(isset($_POST['login_userCode']) && isset($_POST['login_userPass'])){
              if(!empty($_POST['login_userCode']) && !empty($_POST['login_userPass'])){
                      $login_userCode =  mysqli_real_escape_string($conn, $_POST['login_userCode']);
                      $login_userPass =  mysqli_real_escape_string($conn, $_POST['login_userPass']);
                        $dispRM_users = $conn->query("SELECT * FROM `tbl_users`
                         where `username` = '$login_userCode' and `password` = '$login_userPass'");			
                           $auth_user = $dispRM_users->fetch_assoc();
                         if (($_POST['login_userCode'] == $auth_user['username']) && $_POST['login_userPass'] == $auth_user['password']) {
                              $_SESSION['user_id'] = $auth_user['user_id'];
                              $_SESSION['username'] = $auth_user['username'];
                              $_SESSION['group_code'] = $auth_user['group_code'];
                              $_SESSION['logistic_id'] = $auth_user['logistic_id'];
                         if (stripos($auth_user['status'], '0') !== FALSE ) {
                      echo '<script type="text/javascript">
                      Swal.fire({
                        position: "center",
                        icon: "warning",
                        text: "Sorry, your account has been deactivate. Please contact the costumer service.",
                        showConfirmButton: false,
                        timer: 2500
                      })
                        </script>';
                    }
                    else if (stripos($auth_user["group_code"], "1") !== FALSE) {
                      header("location: ../ecommerce/dashboard");   
                    }else if(stripos($auth_user["group_code"], "5") !== FALSE){
                      header("location: ../ecommerce/dashboard");   
                    }
                    else if(stripos($auth_user["group_code"], "4") !== FALSE){
                      header("location: ../ecommerce/dashboard");   
                    }
                    else if(stripos($auth_user["group_code"], "3") !== FALSE){
                        header("location: ../ecommerce/receiving"); 
                    }else {
                      header("location: ../ecommerce/home");  
                    }
                  }else {
                    echo '<script type="text/javascript">
                    Swal.fire({
                      position: "center",
                      icon: "warning",
                      text: "Username and Password is Incorrect. Please sign up or try it again.",
                      showConfirmButton: false,
                      timer: 2500
                    })
                      </script>';
                  }
              }
            }    
          }
    ?>
     <form action="login.php" class="log_form" id="loginForm" method="post">
		<img src ="../assets/img/logo.png" class ="image">
		<?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="margin-left: 30px"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		<div class="input">
     	<input type="text" id="username" name="login_userCode" autocomplete="off" placeholder="Username"><br>
     	<input type="password" id="password" name="login_userPass" autocomplete="off" placeholder="Password"><br>
		</div>
		
		<button class ="btn-log" type="submit" name="login_Submit" disabled="disabled" id="loginButton" >Login</button>

		<div class="forgot_password">
		<a href="forgot_password">Forgot password?</a>
		</div>

		<div class="signup_link">
		Not a member?
		<a href="signup.php">Signup here</a>
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