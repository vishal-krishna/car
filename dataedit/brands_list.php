<!DOCTYPE html>
<html>
<head>
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
 
        <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" /> -->
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
<div style="padding-top: 80px;">
<a href="brands_add.php"><button class="add">ADD +</button></a>
</div>
<?php
require 'db_config.php';
$sql = "SELECT * FROM brands";
$result = mysqli_query($con,$sql);
$status = "SHOW TABLE STATUS LIKE 'brands'";
$status_result = mysqli_query($con,$status);
$status_result_data = mysqli_fetch_assoc($status_result);
$next_increment = $status_result_data['Auto_increment'];
if(mysqli_num_rows($result)>0){
	echo "<div class='table_div' style='ovverflow-x:auto;'><table><tr><th></th><th></th><th>Name</th><th>LOGO</th><th>COUNT</th></tr>";
	while ($row=mysqli_fetch_array($result)) {
		echo "<tr><td><a href='brands_edit.php?id=".$row['id']."'>Edit</a></td>";
		echo "<td><a href='brands_delete.php?id=".$row['id']."'>Delete</a></td>";
		echo "<td>".$row['name']."</td><td>".$row['logo']."</td><td>".$row['count']."</td></tr>";
		
	}
	echo "</table></div>";
}
else{
	echo "No results";
}
?>
</ol>
</table>
</body>
</html>