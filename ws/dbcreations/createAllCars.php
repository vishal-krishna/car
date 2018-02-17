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
$sql = "CREATE TABLE all_cars (
car_id INT(99) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
car_name VARCHAR(250) NOT NULL,
varients VARCHAR(250) NOT NULL,
total INT(99) NOT NULL,
brand_id INT(99) NOT NULL,
brand_name VARCHAR(250) NOT NULL,
timestamp TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table all_cars created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>