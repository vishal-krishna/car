<!DOCTYPE html>
<html>
<body>
<?php
require 'db_config.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$oldsql="SELECT * from customer_reviews where id='$id'";
$oldresult=mysqli_query($con,$oldsql);
$oldrow=mysqli_fetch_array($oldresult);
$target_dir = "../public/assets/images/uploads/customer_reviews/";
$target_file = $target_dir.$oldrow['customer_photo'];
$sql = "DELETE FROM customer_reviews WHERE id='$id'";
$result = mysqli_query($con,$sql);
if($result)
{
unlink($target_file);
header('location:customer_reviews_list.php');
}else{
	echo "Failed. Try again.";
}
}
?>
</body>
</html>