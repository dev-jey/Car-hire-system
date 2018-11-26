<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "carhire";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection success
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "";

?>