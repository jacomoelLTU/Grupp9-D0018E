<?php
require_once "ratingFunctions.php";
require_once "config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Hello world!<br>";

session_start();
$userId = $_SESSION['userid'];
$postId = $_GET['postId'];
$productIdquery = mysqli_query($conn, "SELECT product_id FROM product WHERE product_postid=$postId;");
$productId = mysqli_fetch_assoc($productIdquery);

//$postId = $_GET['postId'];
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
        
        //kan vara här felet är, jämför med guiden, där använder dem ratingen current user har lagt istället för average på hela produkten
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