<!DOCTYPE html>
<html>
<body>
<?php
require 'db_config.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$oldsql="SELECT * from brands where id='$id'";
$oldresult=mysqli_query($con,$oldsql);
$oldrow=mysqli_fetch_array($oldresult);
$target_dir = "uploads/";
$target_file = $target_dir.$oldrow['logo'];
$sql = "DELETE FROM brands WHERE id='$id'";
$result = mysqli_query($con,$sql);
if($result)
{
unlink($target_file);
header('location:brands_list.php');
}else{
	echo "Failed. Try again.";
}
}
?>
</body>
</html>