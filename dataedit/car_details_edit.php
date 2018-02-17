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
if(isset($_GET['id'])){
$id=$_GET['id'];
$oldsql="SELECT * from car_details where id='$id'";
$oldresult=mysqli_query($con,$oldsql);
$oldrow=mysqli_fetch_array($oldresult);
$oldname=$oldrow['car_name'];
$oldbrandid=$oldrow['brand_id'];
$target_files = explode(',', $oldrow['car_img']);
if(isset($_POST['submit']))
{
$car_name=mysqli_real_escape_string($con,$_POST['name']);

$target_dir = "../public/assets/images/uploads/cardetails/";
$images_name="";
$uploadOk=0;
$oldfileexist=1;
$fileToUpload = $_FILES['fileToUpload'];
$extension=array("jpeg","jpg","png","gif","JPG","PNG","JPEG");
echo (isset($_FILES['fileToUpload']));
echo (!empty($_FILES['fileToUpload']));
if(isset($fileToUpload) && !empty($fileToUpload)){
    $img_desc = reArrayFiles($fileToUpload);
    $total=count($img_desc);
    // echo $total."<br />";
   
    for($key=0;$key<$total;$key++)
    {  
        $ext=end(explode('.',$img_desc[$key]["name"]));
        $targetfile="../public/assets/images/uploads/cardetails/".$id.$car_name.$key.".".$ext;
        //echo $targetfile;
        if(in_array($ext,$extension))
        {
            if($img_desc[$key]["size"]<50000000 && $img_desc[$key]["size"]!= 0 && $img_desc[$key]["error"] == 0 )
            {
                if($oldfileexist){
                    foreach ($target_files as $key => $value) {
                    // echo $target_dir.$value."<br/>";
                        unlink($target_dir.$value);
                    }
                    $oldfileexist=0;

                }
               
                if(move_uploaded_file($img_desc[$key]["tmp_name"],$targetfile))
                {
                    if($key == 0){$images_name=$id.$car_name.$key.".".$ext;}
                    if($key > 0){$images_name = $images_name.",".$id.$car_name.$key.".".$ext;}
                    // echo $images_name;
                    $uploadOk=1;

                }else{echo "Sorry, there was an error uploading your file."; }
             }else{echo "too large";}
        }else{echo "no img updated";}
    }
}







$model=mysqli_real_escape_string($con,$_POST['model']);
$brand_id=mysqli_real_escape_string($con,$_POST['brand_id']);
$year=mysqli_real_escape_string($con,$_POST['year']);
$color=mysqli_real_escape_string($con,$_POST['color']);
$car_img=$images_name;
$body_type=mysqli_real_escape_string($con,$_POST['body_type']);
$kilometers=mysqli_real_escape_string($con,$_POST['kilometers']);
$transmission=mysqli_real_escape_string($con,$_POST['transmission']);
$owners=mysqli_real_escape_string($con,$_POST['owners']);
$mileage=mysqli_real_escape_string($con,$_POST['mileage']);
$fuel_type=mysqli_real_escape_string($con,$_POST['fuel_type']);
$price=mysqli_real_escape_string($con,$_POST['price']);
//$count=mysqli_real_escape_string($con,$_POST['count']);
$sql = "INSERT INTO car_details (car_name, model, brand_id, year, color, car_img, body_type, kilometers, transmission, owners, mileage, fuel_type, price)
VALUES ('$car_name', '$model', '$brand_id','$year', '$color', '$car_img','$body_type', '$kilometers', '$transmission', '$owners', '$mileage', '$fuel_type', '$price')";
if (mysqli_query($con, $sql)) {
    if($oldbrandid!=$brand_id){
        $count_update_new = "UPDATE brands SET count = count+1 WHERE id='$brand_id'";
        $count_update_old = "UPDATE brands SET count = count-1 WHERE id='$oldbrandid'";
        mysqli_query($con,$count_update_new);
        mysqli_query($con,$count_update_old);
    }
    echo "New record created successfully";
    header('location:car_details_list.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
}
}

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

?>
<fieldset style="width:300px;padding-top:80px">
<form method="post" action="" multipart="" enctype="multipart/form-data">
Car Name: <input type="text" name="name" value="<?php echo $oldrow['car_name']; ?>"><br>
<!-- Logo: <input type="text" name="logo"><br> -->
<!-- Count: <input type="text" name="count" ><br> -->
model: <input type="text" name="model" value="<?php echo $oldrow['model']; ?>"><br>
brand_id: <input type="text" name="brand_id" value="<?php echo $oldrow['brand_id']; ?>"><br>
year: <input type="text" name="year" value="<?php echo $oldrow['year']; ?>"><br>
color: <input type="text" name="color" value="<?php echo $oldrow['color']; ?>"><br>
body_type: <input type="text" name="body_type" value="<?php echo $oldrow['body_type']; ?>"><br>
kilometers: <input type="text" name="kilometers" value="<?php echo $oldrow['kilometers']; ?>"><br>
transmission: <input type="text" name="transmission" value="<?php echo $oldrow['transmission']; ?>"><br>
fuel_type: <input type="text" name="fuel_type" value="<?php echo $oldrow['fuel_type']; ?>"><br>
owners: <input type="text" name="owners" value="<?php echo $oldrow['owners']; ?>"><br>
mileage: <input type="text" name="mileage" value="<?php echo $oldrow['mileage']; ?>"><br>
price: <input type="text" name="price" value="<?php echo $oldrow['price']; ?>"><br>
Image:<input type="file" name="fileToUpload[]" id="fileToUpload" multiple >
<br>
<input type="submit" name="submit">
</form>
</fieldset>
</body>
</html>