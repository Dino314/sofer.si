<?php
	require "init.php";
	session_start();
	
	$_SESSION['od'] = $_POST["od"];
	$_SESSION['do'] = $_POST["doo"];
	$_SESSION['datum'] = $_POST["datum"];
	$_SESSION['cas'] = $_POST["cas"];
?>
