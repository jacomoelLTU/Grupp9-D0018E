<?php
include 'config.php';
$userid = $_SESSION['userid'];

$query = mysqli_query($conn, "SELECT * FROM post WHERE post_userid='$userid'");

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    echo"TestLink is:"."?postId=".$row['post_id']."?postTitle".$row['post_title']."\n";
}
?>