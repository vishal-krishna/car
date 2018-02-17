<?php
$servername = "127.0.0.1"; //localhost
$username = "root";//username
$password = "";//password
$dbname = "cars";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE car_details (
id INT(99) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
car_name VARCHAR(250) NOT NULL,
model VARCHAR(250) NOT NULL,
brand_name VARCHAR(250) NOT NULL,
brand_id INT(99) NOT NULL,
year INT(99) NOT NULL,
color VARCHAR(250) NOT NULL,
car_img VARCHAR(250) NOT NULL,
body_type VARCHAR(250) NOT NULL,
kilometers INT(99) NOT NULL,
transmission VARCHAR(250) NOT NULL,
owners INT(99) NOT NULL,
mileage INT(99) NOT NULL,
fuel_type VARCHAR(250) NOT NULL,
price INT(99) NOT NULL,
timestamp TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table car_details created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>