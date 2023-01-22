<?php
$host = "localhost";
$username = "root";
$password = "mysql123";
$db = "ecomercesite";
// Create connection
$conn = new mysqli($host, $username, $password, $db);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>