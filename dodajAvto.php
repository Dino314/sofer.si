<?php
	require "init.php";
	session_start();
	
	if(isset($_SESSION['id_uporabniki'])){
		
		// $uporabnisko_ime = $_SESSION['id_uporabniki'];
		// $sql_query = "select id_uporabniki from MIT_uporabniki where uporabnisko_ime like '$uporabnisko_ime';";
		// $result = mysqli_fetch_row(mysqli_query($con,$sql_query));
		
		$id_uporabniki = $_SESSION['id_uporabniki'];
		$reg_tablica=$_POST["reg_tablica"];
		$opis_avta=$_POST["opis_avta"];
		$st_mest=$_POST["st_mest"];
		$zavarovanje=$_POST["zavarovanje"];
		
		$sql_query = "select id_uporabniki from MIT_avti where id_uporabniki like '$id_uporabniki';";
		$result = mysqli_query($con,$sql_query);
		
		if(mysqli_num_rows($result)>0){
			
			echo "alreadyExists";
		}else{
			
			$sql_query="insert into MIT_avti (id_uporabniki, reg_tablica, opis_avta, st_mest, zavarovanje) values('$id_uporabniki', '$reg_tablica', '$opis_avta', '$st_mest', '$zavarovanje');";
			mysqli_query($con,$sql_query);
			echo "addedSuccess";
		}
		
	}else{
		
		echo "error in session";
	}
	
?>