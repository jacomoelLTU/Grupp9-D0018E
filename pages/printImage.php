<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../functions/config.php';
$query = "SELECT post_title, post_img FROM post ORDER BY post_id DESC";
$result = mysqli_query($conn, $query);

while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

    echo $row['post_img'].$row['post_title'];
}

?>

<img src="$result['post_img']">
