<?php
include 'config.php';
include '../pages/loginCheck.php';

$userId = $_SESSION['userid'];
//$productId = $_GET['productid'];

if (isset($_POST["rating"])) {
    
    //$productId = $_POST["productId"];
    $productId = '35';
    $rating = $_POST["rating"];
    
    $checkIfExistQuery = "SELECT * FROM rating WHERE user_id = '" . $userId . "' AND rating_productid = '" . $productId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        //query below is wrong cause you cant update a childs row, gonna look into this
        $insertQuery = "INSERT INTO rating(user_id, rating_productid, rating) VALUES ('" . $userId . "','" . $productId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        updateAvgProductRating();
        echo "success";
    } else {
        echo "Already Voted!";
    }
}

// This function updates the average rating of a product in the product table
function updateAvgProductRating(){
    include 'config.php';

    session_start();
    $userId = $_SESSION['userid'];
    //$productId = $_GET['productid']; //this might be wrong way to get this, temp "solution" to move on
    $productId = '35';

    $query = "SELECT rating FROM rating WHERE rating_productid='$productId'";
    $result = mysqli_query($conn, $query);
    $outputstring = "Outputstring: ";
    while($row = mysqli_fetch_array($result)){ //you might wanna use mysqli_fetch_array here or similar function, example: $result = mysqli_fetch_array($query, MYSQLI_ASSOC));
        $iterations .= 1;
        $totalRating .= $row;
        $outputstring .= $iterations . $totalRating;
    }

    //calculate average rating
    $averageRating = $totalRating / $iterations;

    $productRating = "UPDATE product SET product_rating=$averageRating WHERE product_id ='$productId'";
    mysqli_query($conn, $productRating);
    echo $outputstring;
}
?>