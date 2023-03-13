<!-- DELETE POST action to mysql -->

<?php 
require 'config.php';

$postId = $_POST['post_id'];

//get product id to be able to delete from rating table
$productIdQuery = mysqli_query($conn,"SELECT product_id FROM product WHERE product_postid='$postId'");
$productIdRow = mysqli_fetch_array($productIdQuery, MYSQLI_ASSOC);
$productId = $productIdRow['product_id'];

//delete transactionitem
$ratingQuery = mysqli_query($conn,"DELETE FROM transactionitem WHERE transactionitem_productid='$productId'");

//delete rating
$ratingQuery = mysqli_query($conn,"DELETE FROM rating WHERE rating_productid='$productId'");

//delete product
$productQuery = mysqli_query($conn,"DELETE FROM product WHERE product_postid='$postId'");

//delete post
$postQuery = mysqli_query($conn,"DELETE FROM post WHERE post_id='$postId'");

echo"<script>location.reload();</script>";
?>