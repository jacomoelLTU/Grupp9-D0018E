<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
$userid = $_SESSION['userid'];

$query = mysqli_query($conn, "SELECT * FROM post WHERE post_userid='$userid'");
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    echo"Click to go to post ".$row['post_title'].": <a href ='showpost.php?postId=".$row['post_id']."&postTitle=".$row['post_title']."'>Show post</a><br>";
}
?>