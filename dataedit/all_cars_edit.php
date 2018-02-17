<?php
  require "db_config.php";
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  $brand_name = $request->make;
  $car_name = $request->model;
  $varients = $request->varients;
  $brand_id = $request->brand_id;
  if(isset($_GET['id'])){
    $id=$_GET['id'];
     mysqli_select_db($con,"gtreddyc_cars");
      $sql = "UPDATE all_cars SET car_name='$car_name',brand_id='$brand_id',brand_name='$brand_name',varients='$varients' WHERE car_id='$id'";

    if ($con->query($sql) === TRUE) {
        echo "Update successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
  }
 
?>