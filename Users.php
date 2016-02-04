<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
userid VARCHAR(10) NOT NULL,
username VARCHAR(20) NOT NULL,
email VARCHAR(30) NOT NULL,
password VARCHAR(20) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>