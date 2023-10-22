<?php
session_start(); 
include "../server/forgot_password.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../../style/javascript/DisplayProfileImage.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../style/css/forgot_password.css">
</head>
<body>


	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST">
					<!--EDIT CONTACT NUMBER SECTION START-->
					<section class="request_password">
						<p>Recover Password</p>
						<div class="form_request_password">
							<p>Please enter your email that already registered in your profile so that we can recover your password.</p>
							<input type="text" name="email" value="" placeholder="Enter your email" autocomplete="off" required="">
						</div>

						<!--SUBMIT SECTION START-->
            <div class="buttons">
  						<button type="submit" name="submit">Submit</button>
              <button type="submit" name="cancel">Cancel</button>
            </div>
						<!--SUBMIT SECTION END-->
					</section>
					<!--EDIT CONTACT NUMBER SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->
<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');

  #Add User Account
    #Success
    if($notification=='ErrorEmail'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      text: "This email does not exist. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }

    elseif($notification=='SendEmail'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "success",
      title: "Successfully Sent Email.",
      text: "Please check your email for the link to recover your password. If you cant find the email, just check your spam.",
      showConfirmButton: false,
      timer: 5000
    })
      </script>';
    }

    elseif($notification=='ErrorSendEmail'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error Send Email.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }
  ?>
</body>
</html>
