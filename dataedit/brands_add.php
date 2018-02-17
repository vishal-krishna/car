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
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
     <div id="header" class="header">
			  <nav>
			    <div class="nav-wrapper">
			      <a href="#!" class="brand-logo logo"><img src="../images/logo1.png"></a>
			      <a href="#" data-activates="mobile-demo" class="button-collapse"> <img src="../images/menu.png"><!-- <i class="material-icons">menu</i> --></a>
			      <div class="menu">
				      <ul class="right hide-on-med-and-down menu">
				        <a href="brands_list.php"><li class="sliding-middle-out">Brands</li></a>
						<a href="all_cars_list.php"><li class="sliding-middle-out">Car Models</li></a>
						<a href="car_details_list.php"><li class="sliding-middle-out">Garage</li></a>
						<a href="customer_reviews_list.php"><li class="sliding-middle-out">Reviews</li></a>
				      </ul>
			      </div>
			      <div class="side-menu">
				      <ul class="side-nav" id="mobile-demo">
				        <a href="brands_list.php"><li>Brands</li></a>
						<a href="all_cars_list.php"><li>Car Models</li></a>
						<a href="car_details_list.php"><li>Garage</li></a>
						<a href="customer_reviews_list.php"><li>Reviews</li></a>
				      </ul>
			      </div>
			    </div>
			  </nav>
		</div>
<?php
require 'db_config.php';
if(isset($_POST['submit']))
{
$status = "SHOW TABLE STATUS LIKE 'brands'";
$status_result = mysqli_query($con,$status);
$status_result_data = mysqli_fetch_assoc($status_result);
$next_increment = $status_result_data['Auto_increment'];
$target_dir = "../public/assets/images/uploads/";
$fileToUpload = $_FILES['fileToUpload']['name'];
$imageFileType=end(explode('.',$fileToUpload));
$target_file = $target_dir.$next_increment. ".".$imageFileType;
$uploadOk = 1;
echo $imageFileType."<br/>".$target_file."<br/>";
// Check if image file is a actual image or fake image
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
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}		






$name=mysqli_real_escape_string($con,$_POST['name']);

$logo=$next_increment. ".".$imageFileType;
$count=0;
$sql = "INSERT INTO brands (name, logo, count)
VALUES ('$name', '$logo', '$count')";
if ($uploadOk == 1) {
if (mysqli_query($con, $sql)) {
    header('location:brands_list.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
}
}
?>
<fieldset style="width:300px;padding-top: 80px;">
<form method="post" action="" enctype="multipart/form-data">
Name: <input type="text" name="name"><br>
<!-- Logo: <input type="text" name="logo"><br> -->
<!-- Count: <input type="text" name="count"><br> -->
LogoImg:<input type="file" name="fileToUpload" id="fileToUpload" >
<br>
<input type="submit" name="submit">
</form>
</fieldset>
</body>
</html>