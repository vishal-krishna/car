<?php
$con = mysqli_connect("127.0.0.1","root","","cars");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else {
	//echo "success";
}
?>