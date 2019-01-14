<?php
	require "init.php";
	session_start();
	
	//delete the username of the currently logged in user and redirect to the login page
	unset($_SESSION['id_uporabniki']);
	unset($_SESSION['id_prevozi']);
	unset($_SESSION['uporabnisko_ime']);
	header('Location: index.html');
?>