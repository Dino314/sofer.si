<?php
	require "init.php";
	session_start();
	
	//echo "reserveSuccess";
	
	$id_prevozi = $_SESSION['id_prevozi'];
	
	$sql_query="select st_prosto from MIT_prevozi where id_prevozi like '$id_prevozi';";
	$result = mysqli_fetch_row(mysqli_query($con,$sql_query));
	$st_prosto = intval($result[0]);
	
	if ($st_prosto > 0){
		--$st_prosto;
		
		$sql_query="update MIT_prevozi set st_prosto = '$st_prosto' where id_prevozi like '$id_prevozi';";
		mysqli_query($con,$sql_query);
		echo "reserveSuccess";
	}else if ($st_prosto == 0){
		echo "zasedeno";
	}else{
		echo "st_prosto napaka";
	}
?>