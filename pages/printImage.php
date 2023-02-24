<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../functions/config.php';
$query = "SELECT post_title, post_img FROM post WHERE post_userid='19'";
$result = mysqli_query($conn, $query);

while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

    //echo $row['post_img'].$row['post_title'];
    $url = "$row[post_img]";
    $image = base64_encode(file_get_contents("$url"));
    echo $row['post_title'];
    echo '<img src="data:image/jpeg;base64,'.$image.'">';
    echo $image;

}

?>

<img src="$result['post_img']">
