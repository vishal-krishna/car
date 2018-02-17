<!DOCTYPE html>
<html>
<body>
<?php
include('db_config.php');
if(isset($_POST['submit']))
{
$name=mysqli_real_escape_string($_POST['name']);
$age=mysqli_real_escape_string($_POST['age']);
$query1=mysqli_query("insert into addd values('','$name','$age')");
echo "insert into addd values('','$name','$age')";
if($query1)
{
header("location:list.php");
}
}
?>
<fieldset style="width:300px;">
<form method="post" action="">
Name: <input type="text" name="name"><br>
Age: <input type="text" name="age"><br>
<br>
<input type="submit" name="submit">
</form>
</fieldset>
</body>
</html>