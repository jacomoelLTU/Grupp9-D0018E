<?php
include 'config.php';
include '../pages/loginCheck.php';
include 'updateAvgProductRating.php';

$userId = $_SESSION['userid'];
//$productId = $_GET['productid'];

if (isset($_POST["rating"])) {
    $productId = '35';
    updateAvgProductRating($productId);
    //$productId = $_POST["productId"];
    $rating = $_POST["rating"];
    
    $checkIfExistQuery = "SELECT * FROM rating WHERE user_id = '" . $userId . "' AND rating_productid = '" . $productId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        //query below is wrong cause you cant update a childs row, gonna look into this
        $insertQuery = "INSERT INTO rating(user_id, rating_productid, rating) VALUES ('" . $userId . "','" . $productId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        echo "success";
    } else {
        echo "Already Voted!";
    }
}
?>