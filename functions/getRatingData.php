<script>
    <?php require_once("../JS/ratingfunctions.js");?>
</script>

<?php
include 'config.php';

session_start();
$userId = $_SESSION['userId'];
$productId = $_GET['productId']; //this might be wrong way to get this, temp "solution" to move on

$query = "SELECT * FROM product ORDER BY product_id DESC";
$result = mysqli_query($conn, $query);

$outputString = '';

foreach ($result as $row) {
    $userRating = "SELECT rating FROM rating WHERE user_id='19'";
    $ratingQuery = mysqli_query($conn, $userRating);

    // $totalRating = totalRating($row['id'], $conn);
    //hardcode to test
    $averageRating = "SELECT product_rating FROM product WHERE product_id='9'";
    $totalReviews = "";

    $outputString .= '
        <div class="row-item">
        <div class="row-title">' . $row['name'] . '</div> <div class="response" id="response-' . $row['id'] . '"></div>
        <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $row['id'] . ',' . $userRating . ');"> ';
    
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $row['id'] . '_' . $count;
        
        if ($count <= $userRating) {
            
            $outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $row['id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row['id'] . ',' . $count . ');">&#9733;</li>';
        }
    } // endFor
    
    $outputString .= '
        </ul>
        
        <p class="review-note">Total Reviews: ' . $totalReviews . '</p>
        <p class="text-address">' . $row["address"] . '</p>
        some text
        </div>
        ';
}

echo $outputString;

?>