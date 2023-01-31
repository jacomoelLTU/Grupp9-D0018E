<?php
require 'config.php';

// $id = $_GET['id'];
$id = 6;

$sql = "SELECT post_img FROM post WHERE id=$id";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
header("Content-type: image/jpeg");
echo $row['post_img'];

?>