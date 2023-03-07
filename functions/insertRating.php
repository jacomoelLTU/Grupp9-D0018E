<?php
include 'config.php';
include '../pages/loginCheck.php';
include 'updateAvgProductRating.php';
include 'updateAvgUserRating.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo "<script> alert{'Hello worldddd!'};</script>";
$outputString = 'hello world';

$userId = $_SESSION['userid'];
$postId = $_GET['postId'];
//$postId = '1244';
if (isset($_POST["rating"])) {
    $productIdquery = mysqli_query($conn, "SELECT product_id FROM product WHERE product_postid=$postId;");
    $productIdrow = mysqli_fetch_assoc($productIdquery);
    $productId = $productIdrow['product_id'];
    $outputString = "inside if isset";

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

echo $outputString;
?>