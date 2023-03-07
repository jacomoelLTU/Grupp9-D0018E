<?php
require_once "ratingFunctions.php";
require_once "../config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
$userId = $_SESSION['userid'];
$postId = $_GET['postId'];
//$postId = '1244';
//nice
//get product id from product table
if(!empty($postId)){
$productIdquery = mysqli_query($conn, "SELECT product_id FROM product WHERE product_postid=$postId;");
$productrow = mysqli_fetch_assoc($productIdquery);
$productId = $productrow['product_id'];

// product query
$query = "SELECT * FROM product WHERE product_id=$productId";
$result = mysqli_query($conn, $query);

$outputString = '';

foreach ($result as $row) {
    // $userRating = "SELECT rating FROM rating WHERE user_id='19'";
    // $ratingQuery = mysqli_query($conn, $userRating);
    $postId = $row['product_postid'];
    $productRating = productRating($userId, $productId, $conn);
    $totalRating = totalRating($productId, $conn);

    // $totalRating = totalRating($row['id'], $conn);
    //hardcode to test
    // $averageRating = "SELECT product_rating FROM product WHERE product_id='33'";
    // $avgRatingQuery = mysqli_query($conn, $averageRating);
    // $totalReviews = "";

    $outputString .= '
        <div class="row-item">
        <div class="row-title">' . $row['product_title'] . '</div> <div class="response" id="response-' . $productId . '"></div>
        <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $productId . ',' . $productRating . ');"> ';
    
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $productId . '_' . $count;
        
        if ($count <= $productRating) {
            
            $outputString .= '<li value="' . $count . '" product_id="' . $starRatingId . '" class="star selected">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  product_id="' . $starRatingId . '" class="star" onclick="addRating(' . $productId . ',' . $count . ');" onmouseover="mouseOverRating(' . $productId . ',' . $count . ');">&#9733;</li>';
        }
    } // endFor
    
    $outputString .= '
        </ul>
        
        <p class="review-note">Total Reviews: ' . $totalRating . '</p>
        <p class="text-address">' . $row["product_state"] . '</p>
        </div>
        ';
}
}
else{
    $outputString = "test";
}

echo $outputString;

?>