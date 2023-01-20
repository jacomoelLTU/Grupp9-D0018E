<?php
function OpenCon()
 {
 $dbhost = "130.240.200.101";
 $dbuser = "root";
 $dbpass = "12345678";
 $db = "ecomercesite";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>