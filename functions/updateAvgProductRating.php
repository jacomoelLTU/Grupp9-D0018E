<!-- This function updates the average rating of a product in the product table -->
<?php
function updateAvgProductRating($productId){
    include 'config.php';

    session_start();
    //$userId = $_SESSION['userid'];
    //$productId = $_GET['productid']; //this might be wrong way to get this, temp "solution" to move on

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

    $productRating = "UPDATE product SET product_rating='1' WHERE product_id ='35'";
    $insert = mysqli_query($conn, $productRating);
    echo $outputstring;
}
?>