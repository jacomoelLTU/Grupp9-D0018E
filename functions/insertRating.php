<?php
include 'config.php';
include '../pages/loginCheck.php';
include 'updateAvgProductRating.php';

$userId = $_SESSION['userid'];
//$productId = $_GET['productid'];

if (isset($_POST["rating"])) {
    $productId = '38';

    //$productId = $_POST["productId"];
    $rating = $_POST["rating"];
    
    $checkIfExistQuery = "SELECT * FROM rating WHERE user_id = '" . $userId . "' AND rating_productid = '" . $productId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO rating(user_id, rating_productid, rating) VALUES ('" . $userId . "','" . $productId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        updateAvgProductRating($productId, $conn);
        echo "Success";
    } else {
        updateAvgProductRating($productId, $conn);
        echo "Already Voted!";
    }
}
?>