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
$sql = "CREATE TABLE brands (
id INT(99) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(250) NOT NULL,
logo VARCHAR(250) NOT NULL,
count INT(99) NOT NULL,
timestamp TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table brands created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>