<!DOCTYPE html>
<html>
<head>
	<title>Sign up form</title>
	<link rel="stylesheet" type="text/css" href="css/reg.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
<body>
	<div class="container">
		<div class="row">
			<div class="panel-heading">
               <div class="panel-title text-center">
               		<h1 class="title">Registration</h1>
               	</div>
            </div> 
			<div class="main-login main-center">
				<form class="form-horizontal" method="post" action="#">
					
					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Your Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="uname" id="name" maxlength="30" placeholder="Enter your Name"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="cols-sm-2 control-label">Your Address</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-address-book" aria-hidden="true"></i></span>
								<input type="email" class="form-control" name="address" maxlength="25" id="email" placeholder="Enter your Address"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="cols-sm-2 control-label">Your Phone</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
								<input type="email" class="form-control" name="phone" maxlength="20" id="email" placeholder="Enter your Phone"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="cols-sm-2 control-label">Your Email</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
								<input type="email" class="form-control" name="email" maxlength="40" id="email" placeholder="Enter your Email"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="username" class="cols-sm-2 control-label">Username</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="username" maxlength="35" id="username" placeholder="Enter your Username"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control" name="passwd1" maxlength="35" id="password" placeholder="Enter your Password"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control" name="passwd2" maxlength="35" id="confirm" placeholder="Confirm your Password"/>
							</div>
						</div>
					</div>

					<div class="form-group ">
						<button type="button" name="btn_sub" class="btn btn-primary btn-lg btn-block login-button"><i class="fa fa-user-circle" aria-hidden="true"></i> Register</button>
					</div>
					<div class="login-register">
			            <a class="btn btn-default btn-lg" href="index.php"><i class="fa fa-user-circle" aria-hidden="true"></i> Login</a>
			         </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php

error_reporting(0);

require 'config.php';

if (isset($_POST['btn_sub'])) {
	$uname = $_POST['uname'];
	$adres = $_POST['address'];
	$phn = $_POST['phone'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$pass1 = $_POST['passwd1'];
	$pass2 = $_POST['passwd2'];

	if(empty($uname) || empty($adres) || empty($phn) || empty($email) || empty($username) || empty($pass1) || empty($pass2)){
		echo "all fields are required";
	}else {
		if ($pass1 == $pass2) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");
				//$password = password_hash($pass1, PASSWORD_BCRYPT);
				$password = $pass1;
				$query = "INSERT INTO usr_info VALUE(NULL, '$uname', '$adres', '$phn', '$email', '$username', '$password')";
				$result = mysqli_query($conn, $query);
				if ($result) {
					echo "<br><br><br><center><h1>Successfully Registered";
					echo "<br><br><a href='index.php'>Login</a></h1></center>";
				}else{
					echo "Data is not inserted";
				}
			}else{
				echo "you must enter a valid email";
			}
		}else {
			echo "Password not match";
		}
	}
}

?>

