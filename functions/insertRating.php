<?php
include 'config.php';
include '../pages/loginCheck.php';

$userId = $_SESSION['userId'];
$productId = $_GET['productId'];

if (isset($_POST["rating"])) {
    
    $productId = $_POST["productId"];
    $rating = $_POST["rating"];
    
    $checkIfExistQuery = "SELECT * FROM rating WHERE userId = '" . $userId . "' AND post_id = '" . $productId . "'";
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