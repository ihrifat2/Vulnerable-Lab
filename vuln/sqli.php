<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_login'])) {
	header('Location: ../index.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SQLI</title>
	<link rel="stylesheet" type="text/css" href="../css/signup.css">
	<link rel="stylesheet" type="text/css" href="https://getbootstrap.com/dist/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="../home.php">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="sqli.php">SQLI</a>
				</li>
				<li class="nav-item dropdown">
					<button class="nav-link btn bg-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuLink">
						XSS
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="xss_stored.php">Stored</a>
						<a class="dropdown-item" href="xss_reflected.php">Reflected</a>
						<a class="dropdown-item" href="xss_dom.php">Dom	</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="csrf.php">CSRF</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ssrf.php">SSRF</a>
				</li>
			</ul>
			<ul class="navbar-nav nav-right">
				<li class="nav-item">
					<a class="nav-link btn btn-outline-light text-danger" href="../home.php">Back</a>
				</li>
			</ul>
		</div>
    </nav>
    <main role="main" class="container">
		<div class="row">
			<form method="get" action="">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="content head">SQL Injection</h1>
	               	</div>
	            </div>
	            <div class="form-group">
					<label for="txt" class="cols-sm-2 control-label content">Search your friend by id :</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<button name="sqlibtn" class="form-group btn btn-outline-dark" value="submit">Submit</button>
							<input type="text" name="searchid" class="form-group" autofocus>
						</div>
					</div>
				</div>
			</form>
		</div>
    </main>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
	<script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<center>
</body>
</html>
<?php 
//error_reporting(0);
if (isset($_GET['sqlibtn'])) {
	$id = $_GET['searchid'];
	//echo $id;
	$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");
	
	
	//$id = mysqli_real_escape_string($conn, $id);				// Prevent Sqli
	

	$query = "SELECT * FROM `usr_info` WHERE `id` = '$id'";
	$result= mysqli_query($conn, $query);
	
	//$rows = mysqli_fetch_assoc($result);

	$rows = mysqli_query($conn,  $query ) or die(  ((is_object($conn)) ? mysqli_error($conn) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))  );

	if ($rows) {
		$data = mysqli_fetch_assoc($result);
		echo "<font class='content' color='red' size='5px'>" . ucfirst($data['name']) . "</font>";
	}else{
		echo "<h3>" . 'No user found.' . "</h3>";

	}
	mysqli_close($conn);
}

?>