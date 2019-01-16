<?php
	require "init.php";
	session_start();
	
	//echo "reserveSuccess";
	
	$id_prevozi = $_SESSION['id_prevozi'];
	$id_uporabniki = $_SESSION['id_uporabniki'];
	
	$sql_query="select st_prosto from MIT_prevozi where id_prevozi like '$id_prevozi';";
	$result = mysqli_fetch_row(mysqli_query($con,$sql_query));
	$st_prosto = intval($result[0]);
	
	$sql_query="select * from MIT_rezervirano where id_prevozi like '$id_prevozi' and id_prevozi like '$id_uporabniki';";
	$result = mysqli_query($con,$sql_query);
	

	
		
	
	
	//if free seats are more than 0 AND the ride isn't added yet to your reserved rides
	if ($st_prosto > 0 && !mysqli_num_rows($result)>0){
		--$st_prosto;
		
		//update the amount of of free seats left in the database
		$sql_query="update MIT_prevozi set st_prosto = '$st_prosto' where id_prevozi like '$id_prevozi';";
		mysqli_query($con,$sql_query);
		
		//add this reserved ride to the database of the user that's logged in
		$sql_query="insert into MIT_rezervirano (id_uporabniki, id_prevozi) values('$id_uporabniki', '$id_prevozi');";
		mysqli_query($con,$sql_query);
		
		echo "reserveSuccess";
	}else if ($st_prosto > 0 && mysqli_num_rows($result)>0){
		echo "zeRezervirano";
	}else if ($st_prosto == 0){
		echo "zasedeno";
	}else{
		echo "st_prosto napaka";
	}
?>
