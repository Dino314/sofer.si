<?php
	require "init.php";
	session_start();
	
	if(isset($_SESSION['sessionName'])){
		
		$uporabnisko_ime = $_SESSION['sessionName'];
		$sql_query = "select id_uporabniki from MIT_uporabniki where uporabnisko_ime like '$uporabnisko_ime';";
		$result = mysqli_fetch_row(mysqli_query($con,$sql_query));
		
		$userID = $result[0];
		$od=$_POST["od"];
		$do=$_POST["doo"];
		$cas=$_POST["cas"];
		$casObjave=date("Y-m-d H:i:s");
		$cena=$_POST["cena"];
		$opis=$_POST["opis"];
		//2019-02-13 04:00:00
		
		$sql_query="select od, do, cas, cena from MIT_prevozi where od like '$od' and do like '$do' and cas like '$cas' and cena like '$cena';";
		$result = mysqli_query($con,$sql_query);
		
		if(mysqli_num_rows($result)>0){
			
			echo "alreadyExists";
		}else{
			
			$sql_query="insert into MIT_prevozi (id_uporabniki, od, do, cas, cas_objave, cena, opis) values('$userID', '$od', '$do', '$cas', '$casObjave', '$cena', '$opis');";
			mysqli_query($con,$sql_query);
			echo "addedSuccess";
		}
		
	}else{
		
		echo "error in session";
	}
	
?>