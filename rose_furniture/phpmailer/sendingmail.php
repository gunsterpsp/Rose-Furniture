<html>
	<head>
		<title>Everfirst Loans Corp.</title>
		 <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 200px) and (max-width:799px)" href="css/branches1_small.css">
	<link rel="icon" type="L-image/png" href="../images/icon.png"/>
	
	<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	
	
	<body>
		<form action="" method="post">

						<div class="message-details">
						<?php

						if(isset($_POST['submit'])){

								$fullname 		='BRIAN MADRAZO';
								$email 			='erwincaloing@gmail.com';
								$contact_num	='09954956590';
								$subject 		='MR Monitoring Test Mail';
								$message 		='This is a Test Message for MR Monitoring';
								
								//echo 'Message Send...';
							require("phpmailer/src/Exception.php");
								require("phpmailer/src/PHPMailer.php");
							    require("phpmailer/src/SMTP.php");

								$mail = new PHPMailer\PHPMailer\PHPMailer();
							    //$mail->IsSMTP(); // enable SMTP

								$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
								$mail->Host = "smtp.gmail.com";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "phpmailer2019@gmail.com";
								$mail->Password = "Jeremi@h29!!";
								$mail->SetFrom("phpmailer2019@gmail.com");
								$mail->Subject = "$subject";
								
								$mail->Body = "<table>
												<tr>
													<td><b>Name</b></td>
													<td><b>:</b></td>
													<td>$fullname</td>
												</tr>
												<tr>
													<td><b>Contact No.</b></td>
													<td><b>:</b></td>
													<td>$contact_num</td>
												</tr>
												<tr>
													<td><b>Email Address</b></td>
													<td><b>:</b></td>
													<td>$email</td>
												</tr>
												<tr>
													<td><b>Subject</b></td>
													<td><b>:</b></td>
													<td>$subject</td>
												</tr>
												<tr>
													<td><b>Message</b></td>
													<td><b>:</b></td>
													<td>$message</td>
												</tr>
											   </table>
											   ";
											   
								$mail->AddAddress("etcaloing@multi-linegroup.com","ML");
								$mail->AddAddress("erwincaloing@gmail.com","EC");
								$mail->addCC("brmadrazo@multi-linegroup.com","CG");
								
							

								 if(!$mail->Send()) {
									echo "Mailer Error: " . $mail->ErrorInfo;
								 } else {
									echo "Message has been sent";
								 }
								
								// echo '<script>
								//   document.getElementById("fullname").value = "";	
								//   document.getElementById("email").value = "";	
								//   document.getElementById("contact_num").value = "";	
								//   document.getElementById("subject").value = "";	
								//   document.getElementById("message").value = "";	
								// </script>';
								//--------
								
							
							
						}
						?>
						</div>
						<br>
						
						<input type="submit" name="submit"  class="submit-btn" value="Send Message">
						<br>
					</form>
				</div>
			
						
			</div>
			
		
		</div>
	
	</body>
</html>
<style>

.bodys_div
{
	box-shadow: 0 0 4px 0 rgba(0,0,0,0.5);
	margin-left:38%;
	width: 335px;
	text-align:center;
	background-image: linear-gradient(yellow,#DAA520);
}
.bodys_div h2
{
	background:#efefef;
	margin-top: 0;
	padding:10px;
}

.bodys_div input[type=text], input[type=email]
{
	display: block;
	width:90%; 
	margin: 10px auto;
	padding:10px;
}

.bodys_div textarea
{
	
	width:90%; 
	margin: 5px auto;
	height:80px;
	resize:none;
	padding:10px;
}

.submit-btn
{
	cursor: pointer;
	width: 150px; !important;
	margin-left:1px !important;
	margin-bottom: 5px;
	
	padding:10px;
}
.g-recaptcha{width:90%; margin: 5px auto; }
.message-details{width:90%; margin: 5px auto; text-align:center; color:green; }

#form-title{color:maroon; font-family:cursive; font-size:3vh;}

</style>

<style>
body{ font-family: sans-serif; margin:auto; padding:0px;}
#main{height:auto; width:100%;  display: grid;
	grid-template-columns: 100%;}

#logo{width:100%; height:auto; background-color:#FFD700; text-align:center; background-image: linear-gradient( #DAA520, yellow);}

	
	.image_logo{width:27%; height:7vw; margin-top:1vw; margin-bottom:1vw;  }

#Menu{width:100%; height:3vw; background-color:#A52A2A;}
		.top_body{height:10vh;}

  
  .body-grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid #FFD700;
  padding: 20px;
  font-size: 1vw;
  width: 80%;
  height:7vw;
  
}
	#Bodys{
		  
		  }	
		
			.body_item_item1{font-weight:700;}
			.body_item_item3{color:maroon;}

#Footer{
	width:100%; 
	height:5vw;  
	background-color:#FFD700;
	display: grid;
	font-size:0.8vw;
	font-color:#696969;
    grid-template-columns: 100%;
	
}
.image_twitter{width:1vw; height:1vw;}
.image_fb{width:1vw; height:1vw;}
</style>