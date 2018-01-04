<?php
session_start();
require '../config.php';
$uname = $_SESSION['user_login'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>CSRF</title>
	<link rel="stylesheet" type="text/css" href="../css/signup.css">
	<link rel="stylesheet" type="text/css" href="https://getbootstrap.com/dist/css/bootstrap.min.css">
	<style type="text/css">
		body {
		  	padding-top: 1rem;
		}
		.starter-template {
			padding: 3rem 1.5rem;
			text-align: center;
		}
		.xssdrop{
			background-color: #343a40;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
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
					<div class="btn-group xssdrop">
						<button class="nav-link btn bg-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuLink">
							XSS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdown01">
							<a class="dropdown-item" href="xss_stored.php">Stored</a>
							<a class="dropdown-item" href="xss_reflected.php">Reflected</a>
							<a class="dropdown-item" href="xss_dom.php">Dom	</a>
						</div>
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
		<div class="starter-template">
			<form method="post" action="">
				<b><h1 class="content head">Cross Site Scripting (Stored)</h1></b><br>
				<h3 class="content">Add to list :</h3>
				<input type="text" name="userinput">
				<button name="btn" value="submit">Add</button>
			</form>
		</div>
    </main>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
	<script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5 col-md-6 col-lg-4">
					<?php
					$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error While Connecting Database.");

					$data = array();
					$sqlquery = "SELECT * FROM `user_data` WHERE `username` = '$uname'";
					if ($result = $conn->query($sqlquery)) {
						while ($rows = $result->fetch_array(MYSQLI_ASSOC)) {
							$data[] = $rows;
						}
						$result->close();
					}
					?>
				<table class='table'>
					<tr>
						<th>Name</th>
						<th>List Item</th>
					</tr>
					<?php 
						foreach ($data as $row) {
					?>
					<tr>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['userData']; ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
	<?php
	if (isset($_POST['btn'])) {
		$stored = $_POST['userinput'];
		$query = "INSERT INTO `user_data`(`id`, `username`, `userData`) VALUES (NULL,'$uname','$stored')";
		$result = mysqli_query($conn, $query);
		if ($result) {
			header('Location: xss_stored.php');
		}else {
			mysqli_error($conn);
			echo "Error: 403 Forbidden ";
		}
		mysqli_close($conn);
	}
	?>
</body>
</html>