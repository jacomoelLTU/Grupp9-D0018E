<?php
$servername = "130.240.200.101";
$username = "root";
$password = "12345678";
$db = "ecomercesite";
// Create connection
echo"1";
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
echo"2";
if (!$conn) {
  echo"3";
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>