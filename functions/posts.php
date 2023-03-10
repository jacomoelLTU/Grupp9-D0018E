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
    $post_img = $_POST['post_img'];
    $post_type = $_POST['post_type'];

    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    try{
        mysqli_begin_transaction($conn);
        //session for current user
        session_start();
        $uid = $_SESSION['userid'];
        $postid = "SELECT post_id FROM post WHERE post_userid='$uid' AND post_title='$post_title'";
        
        //query insert post
        $sql_post = "INSERT INTO post (post_userid, post_title, post_description, post_img, post_type) VALUES ('$uid', '$post_title', '$post_description', '$post_img', '$post_type')";

        //lock tables so posts cant have duplicate product_postid in the product table
        mysqli_query($conn, "LOCK TABLES product WRITE, post WRITE");

        //insert into mysql
        $rs_post = mysqli_query($conn, $sql_post);

        //if product add to product table
        if($post_type=="product"){
            //lägger till insert till product table med det nyss tillagda POST ID vi har
            $query_lastPostid = mysqli_query($conn,"SELECT MAX(post_id) AS maximum FROM post");  //satement gets the just added postID
            $maxID = $query_lastPostid->fetch_array()[0] ?? '';
            $sql_queryProduct = "INSERT INTO product (product_postid, product_title, product_price, product_quantity) VALUES ($maxID, '$post_title', $product_price, $product_quantity)";
            $product_insert = mysqli_query($conn, $sql_queryProduct);
            //wtf
        }
        mysqli_query($conn, "UNLOCK TABLES");
        mysqli_commit($conn);
    }
    catch(mysqli_sql_exception $e){
        mysqli_rollback($conn);
        echo'<script>alert("Rolling back...");</script>';
        header('Location: ../index.php');
        throw $e;
    }
    header('Location: ../index.php');
?>