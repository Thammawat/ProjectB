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

$sql = "INSERT INTO Users (userid,username,email,password)
VALUES ('Sharke','bee4009','Kumakun@Mogen.com','bee14074009')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>