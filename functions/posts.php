<!-- POST action to mysql -->


<?php 
// include 'forms/postForm.php';
require 'config.php';

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //get values from input

    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $post_price = $_POST['post_price'];
    $post_img = $_POST['post_img'];

    // if(empty($post_title) || (empty($post_description) || (empty($post_price) {
    //     echo "You did not fill out the required fields."
    // }
    
    //get user id from db (to +1 )
    //$post_userid = "SELECT post_userid FROM post";
    //$post_userid_result = $conn->query($post_userid);

    //query
    $sql = "INSERT INTO post (post_title, post_description, post_price, post_img) VALUES ('$post_title', '$post_description', '$post_price', '$post_img')";

    //insert in mysql
    $rs = mysqli_query($conn, $sql);
// }
?>