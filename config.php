<?php
$servername = "130.240.200.101";
$username = "root";
$password = "12345678";
$db = "ecomercesite";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>