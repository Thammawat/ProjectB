<?php
include('databaseConnection.php');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";
$id = $_GET["id"];

$name=$type=$size="";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT name,type,data,size FROM Blobfile WHERE id=$id";
$result = $conn->query($sql);
foreach ($result as $res) {
    
    $name=$res["name"];
       $type=$res["type"];
       $size=$res["size"];
       $data=$res["data"];
}


header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $data;

// echo $size . "". $type . " ". $name;


$conn->close();
?>