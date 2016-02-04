<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";

$conn = new mysqli ($servername,$username,$password,$dbname);
$sql="CREATE TABLE Blobfile(
id INT(10) UNSIGNED PRIMARY KEY,
name VARCHAR(255) NOT NULL,
type VARCHAR(255) NOT NULL,
size INT(255) NOT NULL,
data mediumblob NOT NULL,
reg_date TIMESTAMP
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table MyStudent created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
?>