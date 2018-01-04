<?php
session_start();
unset($_SESSION['badIP']);
unset($_SESSION['failattempts']);
if (isset($_SESSION['user_login'] )) {
	session_destroy();
	setcookie("token", "", time()-1);
	unset($_COOKIE["token"]);
	header('Location: index.php');
}else{
	header('Location: index.php');
}

?>