<?php
session_start();

if (!isset($_SESSION['user_login'])) {
	header('Location: index.php');
	exit();
}

// session_decode('session');
// $session = $_SESSION;
//$uname = implode("", $session);
$uname = $_SESSION['user_login'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="https://getbootstrap.com/dist/css/bootstrap.min.css">
	<style type="text/css">
		body {
		  	padding-top: 1rem;
		}
		.starter-template {
			padding: 3rem 1.5rem;
			text-align: center;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-secondary fixed-top">
		<a class="navbar-brand text-dark" href="home.php">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link text-dark" href="vuln/sqli.php">SQLI</a>
				</li>
				<li class="nav-item dropdown">
					<button class="nav-link btn bg-secondary dropdown-toggle text-dark" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuLink">
						XSS
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="vuln/xss_stored.php">Stored</a>
						<a class="dropdown-item" href="vuln/xss_reflected.php">Reflected</a>
						<a class="dropdown-item" href="vuln/xss_dom.php">Dom	</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="vuln/csrf.php">CSRF</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="vuln/ssrf.php">SSRF</a>
				</li>
			</ul>
			<ul class="navbar-nav nav-right">
				<li class="nav-item">
					<a class="nav-link text-dark"><?php echo "Username : " . $uname; ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn btn-outline-dark text-light" href="logout.php"> logout</a>
				</li>
			</ul>
		</div>
    </nav>
    <main role="main" class="container">
		<div class="starter-template">
			<form method="get" action="">
				<b><h1>Welcome <?php echo $uname; ?></h1></b><br>
			</form>
		</div>
    </main>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
	<script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</body>
</html>