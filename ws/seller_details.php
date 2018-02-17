<?php
	require "db_config.php";
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$make = $request->make;
	$model = $request->model;
	$varient = $request->varient;
	$fuelType = $request->fuelType;
	$kilometers = $request->kilometers;
	$color = $request->color;
	$year = $request->year;
	$owner_ship = $request->owner_ship;
	$sellerName = $request->sellerName;
	$sellerEmail = $request->sellerEmail;
	$sellerMobile = $request->sellerMobile;
	// echo $sellerMobile.$fuelType;

	mysqli_select_db($con,"gtreddyc_cars");
	$sql = "INSERT INTO seller_details(make,model,varient,fuelType,kilometers,color,year,owner_ship,sellerName,sellerEmail,sellerMobile)
VALUES ('$make','$model','$varient','$fuelType','$kilometers','$color','$year','$owner_ship','$sellerName','$sellerEmail','$sellerMobile')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>