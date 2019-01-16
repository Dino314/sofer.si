<?php
	require "init.php";
	
	$uporabnisko_ime=$_POST["uporabnisko_ime"];
	$geslo=password_hash($_POST["geslo"], PASSWORD_DEFAULT);

	//check if the username already exists in database
	$sql_query="select uporabnisko_ime from MIT_uporabniki where uporabnisko_ime like '$uporabnisko_ime';";
	$result = mysqli_query($con,$sql_query);
	
	if(mysqli_num_rows($result)>0){
		echo "registerError";
	}
	else{
	//insert new user into database
	$sql_query="insert into MIT_uporabniki (uporabnisko_ime, geslo) values('$uporabnisko_ime', '$geslo');";
	mysqli_query($con,$sql_query);
	
	echo "registerSuccess";
	}
?>
