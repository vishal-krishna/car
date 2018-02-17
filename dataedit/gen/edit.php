<!DOCTYPE html>
<html>
<body>
<?php
require 'db_config.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$logo=$_POST['logo'];
$count=$_POST['count'];
$newsql = "UPDATE brands SET name='$name', logo='$logo', count='$count' WHERE id='$id'";
//$query3=mysql_query("update addd set name='$name', age='$age' where id='$id'");
if(mysqli_query($con,$newsql))
{
header('location:brands_list.php');
}
}
$oldsql="SELECT * from brands where id='$id'";
$oldresult=mysqli_query($con,$oldsql);
$oldrow=mysqli_fetch_array($oldresult);
?>
<form method="post" action="">
Name:<input type="text" name="name" value="< ?php echo $oldrow['name']; ?>"><br/>
Logo:<input type="text" name="logo" value="<?php echo $oldrow['logo']; ?>"><br/><br />
Count:<input type="text" name="count" value="<?php echo $oldrow['count']; ?>"><br /><br />
<br />
<input type="submit" name="submit" value="update" />
</form>
<?php
}
?>
</body>
</html>