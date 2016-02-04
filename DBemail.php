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
$sql = "CREATE TABLE Email (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
idsent VARCHAR(10) NOT NULL,
idrecive VARCHAR(10) NOT NULL,
subject VARCHAR(100) NOT NULL,
detail VARCHAR(250) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Email created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>