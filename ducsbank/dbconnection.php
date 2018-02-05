<?php
//setup your credentials
$username = "root";
$password = "";
$servername = "localhost";
$dbname = "ducsbank";

// Create connection
//$conn = mysqli_connect($servername, $username, $password);
// Check connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//}
//else{
//    /* change db to world db */
//   // mysqli_select_db($conn, $dbname);
//
////    echo "::::::::Connected successfully::::::::::::";
//}
?>`
