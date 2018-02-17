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
$sql = "CREATE TABLE seller_details (
id INT(99) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
make VARCHAR(250) NOT NULL,
model VARCHAR(250) NOT NULL,
varient VARCHAR(250) NOT NULL,
fuelType VARCHAR(250) NOT NULL,
kilometers INT(99) NOT NULL,
color VARCHAR(250) NOT NULL,
year INT(99) NOT NULL,
ownership INT(99) NOT NULL,
sellerName VARCHAR(250) NOT NULL,
sellerEmail VARCHAR(250) NOT NULL,
sellerMobile INT(99) NOT NULL,
timestamp TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table seller_details created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>