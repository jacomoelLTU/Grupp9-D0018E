<!-- POST action to mysql -->

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'config.php';

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    //get values from input
    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $product_price = $_POST['product_price'];
    $post_img = $_POST['post_img'];
    $product_quantity = $_POST['product_quantity'];

    //session for current user
    session_start();
    $uid = $_SESSION['userid'];
    $postid = "SELECT post_id FROM post WHERE post_userid='$uid'";

    //query
    $sql_post = "INSERT INTO post (post_userid, post_title, post_description, post_img) VALUES ('$uid', '$post_title', '$post_description', '$post_img')";
    $sql_product = "INSERT INTO product (product_postid, product_price, product_quantity) VALUES ('$postid', '$product_price', '$product_quantity')";
    
    //insert into mysql
    $rs_post = mysqli_query($conn, $sql_post);
    $rs_product = mysqli_query($conn, $sql_product);

?>