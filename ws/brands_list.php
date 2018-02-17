<?php
	require "db_config.php";
	//mysqli_select_db($con,"gtreddyc_cars");
	$sql = "SELECT * FROM `brands` WHERE ";
	$result = mysqli_query( $con , $sql )or die ( mysqli_error () );
	$data= array();
	while($row = mysqli_fetch_assoc($result)){
		if(!$data){}
	 $data[]= $row;

	}
	$data = array_filter($data);
	$output = array(
		"status" => "true",
		"data" => $data 
		);
	echo Json_encode($output);
?>