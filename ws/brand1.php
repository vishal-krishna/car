
<?php
	// header('Access-Control-Allow-Origin: *');  //for cross domain access
	// $con = mysqli_connect("127.0.0.1","root","","cars");
// Check connection
	// mysqli_select_db($con,"db_name");
	require "db_config.php"; 
	$sql = "SELECT * FROM `brands`";
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