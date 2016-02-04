<?php
// Check if a file has been uploaded
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ISAG";
$file="";

   $conn = new mysqli($servername, $username, $password, $dbname);


if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $name = real_escape_string($_FILES['uploaded_file']['name']);
        $mime = real_escape_string($_FILES['uploaded_file']['type']);
        $data = real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO File(
                `name`, `mime`, `size`, `data`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}'
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="index.html">here</a> to go back</p>';
?>
 