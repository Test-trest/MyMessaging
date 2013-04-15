<?php 
	session_start();
	if(isset($_GET['action'])){
		unset($_SESSION['user_id']);
	}
	if(isset($_COOKIE["login"])){
		setcookie("login", "", time()-86400);
	}
	if(!isset($_SESSION['user_id'])||!isset($_COOKIE["login"])){
		header('Location:index.php');
	}
?>