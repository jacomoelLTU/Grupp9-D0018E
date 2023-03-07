<?php
include 'config.php';
include '../pages/loginCheck.php';
include 'updateAvgProductRating.php';
include 'updateAvgUserRating.php';

$userId = $_SESSION['userid'];
$postId = $_GET['postId'];
//$postId = '1244';
if (isset($_POST["rating"])) {
    $productIdquery = mysqli_query($conn, "SELECT product_id FROM product WHERE product_postid=$postId;");
    $productId = mysqli_fetch_assoc($productIdquery);

    $rating = $_POST["rating"];
    
    $checkIfExistQuery = "SELECT * FROM rating WHERE user_id = '" . $userId . "' AND rating_productid = '" . $productId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO rating(user_id, rating_productid, rating) VALUES ('" . $userId . "','" . $productId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        updateAvgProductRating($productId, $conn);
        updateAvgUserRating($postId, $conn);
        echo "Success";
    } else {
        updateAvgProductRating($productId, $conn);
        updateAvgUserRating($postId, $conn);
        echo "Already Voted!";
    }
}
?>