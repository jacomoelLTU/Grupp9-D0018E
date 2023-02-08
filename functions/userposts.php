<?php
include 'config.php';
$userid = $_SESSION['userid'];

$query = mysqli_query($conn, "SELECT * FROM post WHERE post_userid='$userid'");
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    echo"Click to go to ".$row['post_title'].": <a href ='showpost.php?postId=".$row['post_id']."?postTitle=".$row['post_title']."'>Show post</a><br>";
}
?>