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
$sql = "CREATE TABLE Blobfile (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
filename VARCHAR(100) NOT NULL,
filetype VArcHAR(100) NOT NULL,
file blob NOT NULL,
filesize VARCHAR(250) NOT NULL,
detail VARCHAR(250) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table blob created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>