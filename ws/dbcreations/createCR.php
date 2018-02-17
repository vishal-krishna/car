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
$sql = "CREATE TABLE customer_reviews (
id INT(99) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
customer_name VARCHAR(250) NOT NULL,
customer_photo VARCHAR(250) NOT NULL,
customer_phone INT(99) NOT NULL,
customer_place VARCHAR(250) NOT NULL,
customer_review VARCHAR(250) NOT NULL,
timestamp TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table customer_reviews created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>