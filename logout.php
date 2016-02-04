<?php
// define variables and set to empty values
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 session_destroy();
 unset($_SESSION['user']);
 header('Location: http://127.0.0.1/write.php');
 exit();
?>