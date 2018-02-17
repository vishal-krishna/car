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
	<link rel="stylesheet" type="text/css" href="table.css">
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
		<div style="padding-top: 80px;">
			<a href="car_details_addd.html"><button class="add">ADD +</button></a>
		</div>
<?php
require 'db_config.php';
$sql = "SELECT * FROM car_details";
$result = mysqli_query($con,$sql);
$status = "SHOW TABLE STATUS LIKE 'brands'";
$status_result = mysqli_query($con,$status);
$status_result_data = mysqli_fetch_assoc($status_result);
$next_increment = $status_result_data['Auto_increment'];
if(mysqli_num_rows($result)>0){
	echo "<div class='table_div' style='ovverflow-x:auto;'><table><tr><th></th><th></th><th>ID</th><th>CAR NAME</th><th>MODEL</th><th>BRAND</th><th>BRAND ID</th><th>YEAR</th><th>COLOR</th><th>CAR IMAGE</th><th>BODY</th><th>KILOMETERS</th><th>TRANSMISSION</th><th>OWNERS</th><th>MILEAGE</th><th>FUEL TYPE</th><th>PRICE</th></tr>";
	while ($row=mysqli_fetch_array($result)) {
		echo "<tr><td><a href='car_details_edit.php?id=".$row['id']."'>Edit</a></td>";
		echo "<td><a href='car_details_delete.php?id=".$row['id']."'>Delete</a></td>";
		echo "<td>".$row['id']."</td><td>".$row['car_name']."</td><td>".$row['model']."</td><td>".$row['brand_name']."</td><td>".$row['brand_id']."</td><td>".$row['year']."</td><td>".$row['color']."</td><td>".$row['car_img']."</td><td>".$row['body_type']."</td><td>".$row['kilometers']."</td><td>".$row['transmission']."</td><td>".$row['owners']."</td><td>".$row['mileage']."</td><td>".$row['fuel_type']."</td><td>".$row['price']."</td></tr>";
	}
	echo "</table></div>";
}
else{
	echo "No results";
}
?>
</body>
</html>