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
$sql = "CREATE TABLE BlobX (
	image_id        tinyint(3)  not null default '0',
    image_type      varchar(25) not null default '',
    image           blob        not null,
    image_size      varchar(25) not null default '',
    image_ctgy      varchar(25) not null default '',
    image_name      varchar(50) not null default ''
)";

if ($conn->query($sql) === TRUE) {
    echo "Table blob created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>