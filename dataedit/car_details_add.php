
<?php

require 'db_config.php';
// $postdata = file_get_contents("php://input");
// $request = json_decode($postdata);
//echo $request;
$car_name = $_POST['model'];
$model = $_POST['varient'];
$brand_name = $_POST['make'];
$brand_id = $_POST['brand_id'];
$year = $_POST['year'];
$color = $_POST['color'];
$car_img = $_POST['make'];
$body_type = $_POST['bodyType'];
$kilometers = $_POST['kilometers'];
$transmission = $_POST['transmission'];
$owners = $_POST['ownership'];
$mileage = $_POST['miles'];
$fuel_type = $_POST['fuelType'];
$price = $_POST['price'];
$carMod_id = $_POST['car_id'];





// $car_name=mysqli_real_escape_string($con,$_POST['name']);
$status = "SHOW TABLE STATUS LIKE 'car_details'";
$status_result = mysqli_query($con,$status);
$status_result_data = mysqli_fetch_assoc($status_result);
$next_increment = $status_result_data['Auto_increment'];
echo $next_increment;
$target_dir = "../public/assets/images/uploads/cardetails";
$images_name="";
$uploadOk=0;

$fileToUpload = $_FILES;
// $fileToUpload = $_FILES['fileToUpload'];
/*$imageFileType=end(explode('.',$fileToUpload));
$target_file = $target_dir.$next_increment. ".".$imageFileType;
$uploadOk = 1;
echo $imageFileType."<br/>".$target_file."<br/>";*/
$extension=array("jpeg","jpg","png","gif","JPG","PNG","JPEG");
// if(is_array($_FILES["fileToUpload"]["tmp_name"]))
// {
if(!empty($fileToUpload)){
    // $img_desc = reArrayFiles($fileToUpload);
    $img_desc = $fileToUpload;
    $total=count($img_desc);
    echo $total."<br />";
    for($key=0;$key<$total;$key++)
    {  
        $ext=end(explode('.',$img_desc[$key]["name"]));
        $targetfile="../public/assets/images/uploads/cardetails/".$next_increment.$car_name.$key.".".$ext;
        echo $targetfile;
        if(in_array($ext,$extension))
        {
            if($img_desc[$key]["size"]<50000000)
            {
             
                if(move_uploaded_file($img_desc[$key]["tmp_name"],$targetfile))
                {
                    if($key == 0){$images_name=$next_increment.$car_name.$key.".".$ext;}
                    if($key > 0){$images_name = $images_name.",".$next_increment.$car_name.$key.".".$ext;}
                    // echo $images_name;
                    $uploadOk=1;

                }
                else{
                    echo "Sorry, there was an error uploading your file.";
                     
                }
             } 
            else
            {
                echo "too large";
            }
        }
        else
        {
            echo "upload img only";
        }
    }
}







/* $brand_name=mysqli_real_escape_string($con,$_POST['brand_name']);
$varient=mysqli_real_escape_string($con,$_POST['varient']);
$brand_id=mysqli_real_escape_string($con,$_POST['brand_id']);
$year=mysqli_real_escape_string($con,$_POST['year']);
$color=mysqli_real_escape_string($con,$_POST['color']); */
$car_img=$images_name;
/* $body_type=mysqli_real_escape_string($con,$_POST['body_type']);
$kilometers=mysqli_real_escape_string($con,$_POST['kilometers']);
$transmission=mysqli_real_escape_string($con,$_POST['transmission']);
$owners=mysqli_real_escape_string($con,$_POST['owners']);
$mileage=mysqli_real_escape_string($con,$_POST['mileage']);
$fuel_type=mysqli_real_escape_string($con,$_POST['fuel_type']);
$price=mysqli_real_escape_string($con,$_POST['price']);
$count=mysqli_real_escape_string($con,$_POST['count']); */

$sql = "INSERT INTO car_details (car_name, model, brand_name, brand_id, year, color, car_img, body_type, kilometers, transmission, owners, mileage, fuel_type, price)
VALUES ('$car_name', '$model', '$brand_name', '$brand_id','$year', '$color', '$car_img','$body_type', '$kilometers', '$transmission', '$owners', '$mileage', '$fuel_type', '$price')";
if ($uploadOk == 1) {
if (mysqli_query($con, $sql)) {
    $count_update_brands = "UPDATE brands SET count = count+1 WHERE id='$brand_id'";
    $count_update_allcars = "UPDATE all_cars SET total = total+1 WHERE car_id='$carMod_id'";
    mysqli_query($con,$count_update_brands);
    mysqli_query($con,$count_update_allcars);
    echo "New record created successfully";
    // header('location:car_details_list.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con); 
}
}


function reArrayFiles($file)
{
    // echo "<pre>";
    // print_r();
    // echo "</pre>";
    echo array_keys($file);
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
$brandlist_sql = "SELECT * FROM brands";
$brandlist_result = mysqli_query($con,$brandlist_sql);
$Colors=["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
    $fueltypes=["Petrol","Diesel","CNG","LPG","Electric"];
    $transmissiontypes=["Manual","Automatic"];
    $bodyOptions = ["Hatchback","SUV","MUV","Sedan","Minivan","Station Wagon","Coupe","Truck","Convertible"];
?>
