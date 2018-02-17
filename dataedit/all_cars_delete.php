
<?php
require 'db_config.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$sql = "DELETE FROM all_cars WHERE car_id='$id'";
$result = mysqli_query($con,$sql);
if($result)
{
header('location:all_cars_list.php');
}else{
	echo "Failed. Try again.";
}
}
?>