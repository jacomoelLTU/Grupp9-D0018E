<!-- This function updates the average rating of a product in the product table -->
<?php
include 'config.php';

session_start();
$userId = $_SESSION['userId'];
$productId = $_GET['productId']; //this might be wrong way to get this, temp "solution" to move on

$query = "SELECT rating FROM rating WHERE rating_productid='$productId'";
$result = mysqli_query($conn, $query);

while($result){ //you might wanna use mysqli_fetch_array here or similar function, example: $result = mysqli_fetch_array($query, MYSQLI_ASSOC));
    $iterations .= 1;
    $totalRating .= $result;
}

//calculate average rating
$averageRating = $totalRating / $iterations;

$productRating = "INSERT INTO product(product_rating) VALUES ($averageRating) WHERE product_id ='$productId'";
$insert = mysqli_query($conn, $productRating);

?>