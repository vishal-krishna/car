<?php
	require "db_config.php";
	// $con = mysqli_connect("127.0.0.1","root","","cars");
	// mysqli_select_db($con,"db_name");
	$sql = "SELECT * FROM `all_cars`";
	$result = mysqli_query( $con , $sql )or die ( mysqli_error () );
	$data= array();
	while($row = mysqli_fetch_assoc($result)){
	 $data[]= $row;

	}
	$data = array_filter($data);
	$output = array(
		"status" => "true",
		"data" => $data 
		);
	echo Json_encode($output);
?>