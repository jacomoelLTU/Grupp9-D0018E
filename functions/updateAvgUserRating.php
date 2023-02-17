<!-- This function updates the average rating for a user in the user table -->
<?php
include 'config.php';

session_start();
$userId = $_SESSION['userId'];
$productId = $_GET['productId']; //this might be wrong way to get this, temp "solution" to move on

//Behöver vi lägga till ett userid för product? 
//Så vi kopplar varje product till varje user och inte bara kopplar varje product till en post.
//Det borde bli lättare att hämta data från product då för varje user
//Det kan man ju bara länka till post_userid isf

$query = "SELECT product_rating FROM product WHERE product_userid='$userId'"; //product_userid finns ej i product ännu
$result = mysqli_query($conn, $query);

while($result){ //you might wanna use mysqli_fetch_array here or similar function, example: $result = mysqli_fetch_array($query, MYSQLI_ASSOC));
    $iterations .= 1;
    $totalRating .= $result;
}

//calculate average rating
$userRating = $totalRating / $iterations;

$userRating = "INSERT INTO user(user_rating) VALUES ($userRating) WHERE user_id ='$userId'"; //average_rating finns ej i user ännu
$insert = mysqli_query($conn, $productRating);

?>