<?php
	// $con = mysqli_connect("localhost");
	$con = mysqli_connect("127.0.0.1","root","","cars");
	if(mysqli_connect_errno()){
		echo "Failed to connect to MYSQL".mysqli_connect_error();
	}

?>