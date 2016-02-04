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
$sql = "SELECT id,idsent,idrecive,detail,blob_id FROM Email";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["idrecive"];
        $sql="SELECT id FROM Blobfile";
        $result1 = $conn->query($sql);
        if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()){
        		if ($row1["id"]==$row["blob_id"])
        		{

        			echo "i";
        		}
        }
    }
    }
   
} else {
    echo "hi";
}


$conn->close();
?>