<!DOCTYPE html>
<html>
<head>
  <title>ISAG</title>
  
</head>

<body background="letter-from-paris-desktop-background-589051.jpg">
<?php
// define variables and set to empty values
$idrecive = $subject = $detail ="";
$num="";
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $idrecive = test_input($_POST["idrecive"]);
   $subject = test_input($_POST["subject"]);
   $detail = test_input($_POST["detail"]);
}

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
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Inbox</a></li>
        <li><a href="#">Outbox</a></li>
        <li><a href="#">new++</a></li>
         <li><a href="#">Log Out</a></li>
          

      </ul>
    </div>
  </div>
</nav>
<form action="write.php" method="POST" enctype="multipart/form-data">
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">To</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Who do you want to send the email?" name="idrecive">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Topic</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="focusInput" placeholder="What is your topic?"  name="subject">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Upload</label>
    <div class="col-sm-10">
       <input type="file" name="image" />
    </div>
  </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Information</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="focusInput" style="height:300px;"  name="detail">
    </div>
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      
       <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<?php

if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_data=addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png","html");

      $sql = "INSERT INTO Blobfile (name,type,size,data)VALUES ('$file_name','$file_type','$file_size','$file_data')";
      $conn->query($sql);
   
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         

         echo "Success";

      }else{
         print_r($errors);
      }
   }

  if(isset($_FILES['image'])){
      $sql = "SELECT id FROM Blobfile";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

    // output data of each row
        while($row = $result->fetch_assoc()) {
          $num=$row["id"];
        }
      }
    }

$sql = "INSERT INTO Email (idrecive,subject,detail,blob_id)VALUES ('$idrecive','$subject','$detail','$num')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
</body>
</html>