<!DOCTYPE html>
<html lang="en">
<head>
  <title>INBOX</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <link type="text/css" rel="stylesheet" href="test3.css"/>
<style>
      table {
    width: 100%;    
     position: relative;
    left: 160px;
    top:   100px;
    
}

    button{
       position: relative;
    left: 100px;
    top:   100px;
 }
</style>
</head>
<body background="letter-from-paris-desktop-background-589051.jpg">
	<?php
// define variables and set to empty values
session_start();
$num="";
$email = $_SESSION['email'];
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ISAG</a>
    </div>
  
      <ul class="nav navbar-nav">
        <li class="write.php"><a href="#">Home</a></li>
        <li><a href="#">Inbox</a></li>
        <li><a href="changepassword.php">Change password</a></li>
         <li><a href="logout.php">Log Out</a></li>
          

      </ul>
    </div>
  </div>
</nav>


<?php


$sql = "SELECT idsent,subject,detail,idrecive,blob_id FROM Email ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table><tr><th>From</th><th>subject</th><th>information</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         if($row["idrecive"]==$email)
         {
          echo "<tr><td>" . $row["idsent"]. "</td><td>" . $row["subject"]. "</td><td>" . $row["detail"]. "</td></tr>";
          if($row["blob_id"]!=0)
          { $num=$row["blob_id"];
            ?>
            <form  action="dowimage.php" method="get">
        <input type="hidden" name="id" value="<?php echo $num ?>" />
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
            }
         }
       }
     echo "</table>";
} else {
     echo "0 results";
}

$conn->close();
?>  




	</body>
</html>