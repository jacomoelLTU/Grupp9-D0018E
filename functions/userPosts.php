<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
//Requier = import library but not include i.e print out. content.
require 'showPost.php';

function getImageItem($conn, $postId): string{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $query = "SELECT post_title, post_img FROM post WHERE post_id=$postId ";
    $result = mysqli_query($conn, $query);
  
    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //if post_img has value
        if (!empty($row['post_img'])) {
  
            //get url from post_img
            $url = "$row[post_img]";
  
            //get content from the url and encode so we can see the image
            $image = base64_encode(file_get_contents($url));
  
            //print title and image
            return "style='background-image:url(data:image/jpeg;base64,".$image."');";
        }
    }
}


// --- ^^^ FUNCTIONS ^^^ ---






$userid = $_SESSION['userid'];

$query = mysqli_query($conn, "SELECT * FROM post WHERE post_userid='$userid'");
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    echo"
    <div id='postItem' " .getImageItem($conn, $row['post_id'])."'> 
        <a class='showItemText'  href ='showPost.php?postId=".$row['post_id']."&postTitle=".$row['post_title']."&postDescription=".$row['post_description']."'></div>
        <a class='addItemIcon' href='".insertToBasket($conn, $postId)."'><i class='bi bi-bag-plus'></i></a>
        <a class='editItemIcon' href='../pages/editPost.php?postId=".$row['post_id']."'><i class='bi bi-three-dots-vertical'></i></a>
    </div>";
}

?>