<?php
header('X-Frame-Options: DENY');
session_start();
if (isset($_SESSION['user_login'])) {
	header('Location: home.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/reg.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="css/login.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
</head>
<body>
	<div class="container">
		<div class="row main">
			<div class="panel-heading">
               <div class="panel-title text-center">
               		<a href="index.php"><img id="profile-img" class="profile-img-card" src="pic/avatar.png" /></a>
               		<h1 class="title">Login</h1>
               	</div>
            </div> 
			<div class="main-login main-center">
				<form class="form-horizontal" action="#" method="post">
					
					<div class="form-group">
						<div class="cols-sm-10">
							<div class="input-group">
								<input type="hidden" class="form-control" name="url" value="home.php"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="username" class="cols-sm-2 control-label">Username</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="uname" maxlength="35" id="username" placeholder="Enter your Username"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control" name="passwd" maxlength="35" id="password" placeholder="Enter your Password"/>
							</div>
						</div>
					</div>
					<p id="demoo"></p>
					<div class="form-group ">
						<button type="submit" name="btn_login" class="btn btn-primary btn-md btn-block login-button"><i class="fa fa-user-circle" aria-hidden="true"></i><b> Login</b></button>
					</div>
					<div class="login-register">
			            <a class="btn btn-default" href="signup.php"><i class="fa fa-user-circle" aria-hidden="true"></i><b> Sign up</b></a>
			         </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>


<?php

require 'config.php';
error_reporting(0);

if ($_SESSION['badIP']) {
	echo "<script>document.documentElement.innerHTML = 'Your IP address is blocked.';</script>";
	header("HTTP/1.1 401 Unauthorized");
	die();
}

if (isset($_POST['btn_login'])) {

	/*Secure code*/
	// $conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");
	// $username = mysqli_real_escape_string($conn, $_POST['uname']);
	// $password = mysqli_real_escape_string($conn, $_POST['passwd']);

	/*Vulnerable code*/
	$username = $_POST['uname'];
	$password = $_POST['passwd'];
	$url = $_POST['url'];

	if (empty($username) || empty($password)) {
		echo "<script>document.getElementById('demoo').innerHTML = 'All Field are required.';</script>";
	}else{
		if ($_SESSION['badIP']) {
			echo "<script>document.documentElement.innerHTML = 'Your IP address is blocked.';</script>";
			header("HTTP/1.1 401 Unauthorized");
		}else{
			$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");
			

			/* SECURE FROM ADMIN PANEL BYPASS */

			// $username = mysqli_real_escape_string($conn, $_POST['uname']);
			// $password = mysqli_real_escape_string($conn, $_POST['passwd']);
			// $query = "SELECT * FROM stu_info WHERE username = '$username'";
			// $result= mysqli_query($conn, $query);
			// $rows = mysqli_fetch_assoc($result);
			// $store_password = $rows['password'];
			// $check = password_verify($password, $store_password);



			/* VULNERABLE TO SQLI AND ADMIN PANEL BYPASS */ 
			$query = "SELECT * FROM usr_info WHERE username = '$username' AND password = '$password'";
			$result= mysqli_query($conn, $query);
			$rows = mysqli_fetch_assoc($result);

			// $rows = mysqli_query($conn,  $query ) or die( ((is_object($conn)) ? mysqli_error($conn) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))  );

			if ($rows) {
				$_SESSION['user_login'] = $rows['username'];
				unset($_SESSION['failattempts']);
				unset($_SESSION['badIP']);
				$cookie_name = "token";
				$cookie_value = md5(uniqid());
				setcookie($cookie_name, $cookie_value, time() + (3600), "/");
				header('Location: '.$url.'');
			}else{
				//echo $username . ":" . $password;
				// print mysqli_error($conn);
				
				echo "<script>document.getElementById('demoo').innerHTML = 'Username or Password not match';</script>";
				$ip = get_ip_address();

				// echo "IP : " . $ip . "<br>";
				// echo "failattempts : " . $_SESSION['failattempts'] . "<br>";
				// echo "badIP : " . $_SESSION['badIP'] . "<br>";
				
				/* Prevent brute force */
				/* Secured by cookie */

				// if ($_COOKIE['login_attempt']) {
	   //              $failattempt = $_COOKIE['login_attempt'];
	   //              $failattempt++;
	   //              setcookie("login_attempt", $failattempt, time() + 5);
	   //          }else{
	   //          	setcookie("login_attempt", 1, time() + 5);
	   //          }
				// if ($_COOKIE['login_attempt'] >= 5) {
				// 	echo "<script>document.documentElement.innerHTML = 'Too many request.';</script>";
				// 	header("HTTP/1.1 429 Too Many Requests");
				// }

				/* Secured by Session */

				if ($_SESSION['failattempts']) {
					$failattempt = $_SESSION['failattempts'];
					$failattempt++;
					$_SESSION['failattempts'] = $failattempt;

					if ($_SESSION['failattempts'] >= 6) {
						echo "<script>document.getElementById('demoo').innerHTML = 'Too many request.';</script>";
						header("HTTP/1.1 429 Too Many Requests");
					}

					// Rate limiting user request 

					if ($_SESSION['failattempts'] >= 15) {
						$_SESSION['badIP'] = $ip;
						header("HTTP/1.1 401 Unauthorized");
					}

				}else{
					$failattempt = 1;
					$_SESSION['failattempts'] = $failattempt;
				}

			}
			mysqli_close($conn);
		}
	}	
}else{
	//header('Location: index.php');
}


function get_ip_address() {

    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}

//' OR '1'='1
//' OR SLEEP(5)=0 LIMIT 1-- 
//' OR time_sleep_until(time()+10) LIMIT 1-- 
//' or username like '%admin%

?>


