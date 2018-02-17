<?php
  require "db_config.php";
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  $brand_name = $request->make;
  $car_name = $request->model;
  $varients = $request->varients;
  $brand_id = $request->brand_id;
  // echo $sellerMobile.$fuelType;

  mysqli_select_db($con,"gtreddyc_cars");
  $sql = "INSERT INTO all_cars(car_name,brand_name,varients,brand_id)
VALUES ('$car_name','$brand_name','$varients','$brand_id')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>