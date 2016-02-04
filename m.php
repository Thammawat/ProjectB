<!DOCTYPE html>
<html>
<body>

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
$sql = "SELECT * FROM Blobfile where id =1";
$result = $conn->query($sql);
foreach ($result as $res) {
    
    $num= $res['id'];
}
// var_dump($result);

$conn->close();
?>
<form  action="dowimage.php" method="get">
	<input type="hidden" name="id" value="<?php echo $num ?>" />
	<input type="submit">
</form>

</body>
</html>