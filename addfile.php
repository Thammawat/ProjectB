<?php
$idrecive=$subject=$detail=$image="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $idrecive= test_input($_POST["idrecive"]);
   $subject = test_input($_POST["subject"]);
   $detail = test_input($_POST["detail"]);
   $image = $_FILES["image"];
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
$numx=" ";

   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   } 

   
   $sql = "INSERT INTO Email (idrecive,subject,detail) VALUES ('$idrecive','$subject','$detail');";
   if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
   if(isset($_POST['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $expensions= array("jpeg","jpg","png","html");
      move_uploaded_file($file_tmp,"images/".$file_name);
      $sql = "INSERT INTO Blobfile (filename,filetype,file,filesize) VALUES ('$file_name','$file_type','$_FILES','$file_size')";
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
   }
   if($file_size > 2097152){
      $errors[]='File size must be excately 2 MB';
   }
      if($conn->multi_query($sql) === TRUE ){
         echo "Success";
      }else{
         print_r($errors);
      }
   }
  $conn->close();
?>