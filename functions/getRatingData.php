<?php
require_once "ratingFunctions.php";
require_once "config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';

echo "Hello world!<br>";

session_start();
$userId = $_SESSION['userid'];
// $productId = $_GET['productId']; //this might be wrong way to get this, temp "solution" to move on
//$userId = '19';
$productId = '33';

//$postId = $_GET['postId'];
$query = "SELECT * FROM product WHERE product_id=$productId";
$result = mysqli_query($conn, $query);

$outputString = '';

foreach ($result as $row) {
    // $userRating = "SELECT rating FROM rating WHERE user_id='19'";
    // $ratingQuery = mysqli_query($conn, $userRating);

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

echo $outputString;

?>