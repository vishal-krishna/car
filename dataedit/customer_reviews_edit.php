<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" />
        <link href="../css/materialize.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/CSstyle.css" />
        <link rel="stylesheet" href="../css/general.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="table.css">
        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans:400,600,700" rel="stylesheet">
        <script src="../js/materialize.min.js"></script>
	</head>
<body>

        <div id="header" class="header">
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo logo">
                        <img src="../images/logo1.png">
                    </a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse">
                        <img src="../images/menu.png">
                        <!-- <i class="material-icons">menu</i> -->
                    </a>
                    <div class="menu">
                        <ul class="right hide-on-med-and-down menu">
                            <a href="brands_list.php">
                                <li class="sliding-middle-out">Brands</li>
                            </a>
                            <a href="all_cars_list.php">
                                <li class="sliding-middle-out">Car Models</li>
                            </a>
                            <a href="car_details_list.php">
                                <li class="sliding-middle-out">Garage</li>
                            </a>
                            <a href="customer_reviews_list.php">
                                <li class="sliding-middle-out">Reviews</li>
                            </a>
                        </ul>
                    </div>
                    <div class="side-menu">
                        <ul class="side-nav" id="mobile-demo">
                            <a href="brands_list.php">
                                <li>Brands</li>
                            </a>
                            <a href="all_cars_list.php">
                                <li>Car Models</li>
                            </a>
                            <a href="car_details_list.php">
                                <li>Garage</li>
                            </a>
                            <a href="customer_reviews_list.php">
                                <li>Reviews</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
<?php
require 'db_config.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$oldsql="SELECT * from customer_reviews where id='$id'";
$oldresult=mysqli_query($con,$oldsql);
$oldrow=mysqli_fetch_array($oldresult);
if(isset($_POST['submit']))
{
$target_dir = "../public/assets/images/uploads/customer_reviews/";
$fileToUpload = $_FILES['fileToUpload']['name'];
$imageFileType=end(explode('.',$fileToUpload));
$target_file = $target_dir.$oldrow['customer_photo'];
$uploadOk = 1;
/*echo isset($_FILES["fileToUpload"]);
echo !empty($_FILES["fileToUpload"]);*/
if($_FILES["fileToUpload"]["size"]!= 0 && $_FILES["fileToUpload"]["error"] == 0){
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png"  && $imageFileType != "jpeg"
	&& $imageFileType != "gif" &&$imageFileType != "JPG" && $imageFileType != "PNG"  && $imageFileType != "JPEG"
	&& $imageFileType != "GIF" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		unlink($target_file);
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "The file has been updated.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}		
}



$customer_name=$_POST['customer_name'];
$customer_photo=$oldrow['customer_photo'];
$customer_phone=$_POST['customer_phone'];
$customer_place=$_POST['customer_place'];
$customer_review=$_POST['customer_review'];
$newsql = "UPDATE customer_reviews SET customer_name='$customer_name', customer_photo='$customer_photo', customer_phone='$customer_phone', customer_place='$customer_place', customer_review='$customer_review' WHERE id='$id'";
//$query3=mysql_query("update addd set name='$name', age='$age' where id='$id'");
if(mysqli_query($con,$newsql))
{
// header('location:customer_reviews_list.php');
	echo $customer_phone;
}
else{
	echo "Upload failed. Try again.";
}
}
?>
<form style="padding-top:150px;" method="post" action="" enctype="multipart/form-data">
Name:<input type="text" name="customer_name" value="<?php echo $oldrow['customer_name']; ?>" /><br />
Phone:<input type="text" name="customer_phone" value="<?php echo $oldrow['customer_phone']; ?>" /><br /><br />
Place:<input type="text" name="customer_place" value="<?php echo $oldrow['customer_place']; ?>" /><br /><br />
Review: <textarea rows="10" cols="60"  name="customer_review"><?php echo $oldrow['customer_review']; ?></textarea><br>
Photo:<input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $oldrow['customer_photo']; ?>" /><br /><br />
<br />
<input type="submit" name="submit" value="update" />
</form>
<?php
}
?>
</body>
</html>