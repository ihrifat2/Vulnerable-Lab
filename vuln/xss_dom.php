<?php
session_start();

if (!isset($_SESSION['user_login'])) {
	header('Location: ../index.php');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CSRF</title>
	<script src="../js/game-frame.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/dom.js"></script>
    <link rel="stylesheet" href="../css/game-frame-styles.css" />
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
		<div class="starter-template">
			<form method="get" action="">
				<b><h1 class="content head">Cross Site Scripting (Dom)</h1></b>
				<div id="domxss">
					<div id="header">
			            <span>Let me introduce you with some pet animal.</span>
			        </div>
			        <div class="tab" id="tab1" onclick="chooseTab('1')">Image 1</div>
			        <div class="tab" id="tab2" onclick="chooseTab('2')">Image 2</div>
			        <div class="tab" id="tab3" onclick="chooseTab('3')">Image 3</div>
			        <div id="tabContent">&nbsp;</div>
			    </div>
			</form>
		</div>
    </main>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
	<script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</body>
</html>

<!-- 'onerror=prompt(1);' -->