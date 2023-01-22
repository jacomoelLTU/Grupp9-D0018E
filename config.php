<?php
$host = "130.240.200.101";
$username = "root";
$password = "12345678";
$db = "ecomercesite";
// Create connection
echo"1";
$conn = mysqli_connect($host, $username, $password, $db);

echo "Connected successfully";
?>