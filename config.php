<?php
$host = "130.240.200.101";
$username = "root";
$password = "";
$db = "ecomercesite";
// Create connection
echo"1";
$conn = new mysqli($host, $username, $password, $db);
// Check connection
echo"2";
if (!$conn) {
  echo"3";
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>