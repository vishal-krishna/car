<!DOCTYPE html>
<html>
<body>
<?php
require 'db_config.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$oldsql="SELECT * from car_details where id='$id'";
$oldresult=mysqli_query($con,$oldsql);
$oldrow=mysqli_fetch_array($oldresult);
$target_dir = "../public/assets/images/uploads/cardetails/";
$target_files = explode(',', $oldrow['car_img']);
$brand_id =  $oldrow['brand_id'];
// echo $target_files;
// $total_files = count($target_files);
$sql = "DELETE FROM car_details WHERE id='$id'";
$result = mysqli_query($con,$sql);
if($result)
{
	foreach ($target_files as $key => $value) {
		// echo $target_dir.$value."<br/>";
		unlink($target_dir.$value);
	}
	$count_update = "UPDATE brands SET count = count-1 WHERE id='$brand_id'";
if(mysqli_query($con,$count_update)){
	echo "string";
	//header('location:car_details_list.php');
}
}else{
	echo "Failed. Try again.";
}
}
?>
</body>
</html>