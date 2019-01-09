<?php
	require "init.php";
	session_start();
	
	//delete the username of the currently logged in user and redirect to the login page
	unset($_SESSION['sessionName']);
	unset($_SESSION['id_prevozi']);
	header('Location: index.html');
?>