<?php
include 'config.php';
include '../pages/loginCheck.php';

$userId = $_SESSION['userId'];
$productId = $_GET['productId'];

if (isset($_POST["rating"])) {
    
    $productId = $_POST["postId"];
    $rating = $_POST["rating"];
    
    $checkIfExistQuery = "SELECT * FROM rating WHERE userId = '" . $userId . "' AND post_id = '" . $productId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO rating(user_id, post_id, rating) VALUES ('" . $userId . "','" . $productId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        echo "success";
    } else {
        echo "Already Voted!";
    }
}
?>