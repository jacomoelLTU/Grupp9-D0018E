<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
$query = "SELECT post_title, post_img FROM post ORDER BY post_id DESC";
$result = mysqli_query($conn, $query);
?>

