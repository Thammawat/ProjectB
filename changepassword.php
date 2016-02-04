<!DOCTYPE html>
<html>
<head>
  <title>ISAG</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <link type="text/css" rel="stylesheet" href="test3.css"/>
</head>

<body background="letter-from-paris-desktop-background-589051.jpg">
<?php
session_start();
$user = $_SESSION['user'];
$ID=$Name=$Year=$Faculty="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $oldpassword = test_input($_POST["oldpassword"]);
   $newpassword = test_input($_POST["newpassword"]);
   
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
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
$bool=false;
$rank=0;
$sql = "SELECT id,password,userid FROM Users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo $row["userid"];
        $options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$hash = password_hash($row["password"], PASSWORD_BCRYPT, $options);
// echo "\n";
if (password_verify($oldpassword, $hash)) {
   if($user==$row["userid"]){
    $bool =true;
    $rank =$row["id"];
  }
}
    }
} else {
    echo "<script type='text/javascript'>alert('Wrong Password');</script>";
}
if($bool==true)
{
    $sql = "UPDATE Users SET password='$newpassword' WHERE id='$rank'";

if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('Success');</script>";
} else {
    echo "Error updating record: " . $conn->error;
}



  
}


$conn->close();
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ISAG</a>
    </div>
  
      <ul class="nav navbar-nav">
        <li class="active"><a href="write.php">Home</a></li>
        <li><a href="inbox.php">Inbox</a></li>
        <li><a href="#">Change password</a></li>
         <li><a href="lockout.php">Log Out</a></li>
          

      </ul>
    </div>
  </div>
</nav>

<form  action="changepassword.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Old Password</label>
    <input  type="password" class="form-control" id="exampleInputEmail1" placeholder="OLD" name="oldpassword">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="NEW" name="newpassword">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>