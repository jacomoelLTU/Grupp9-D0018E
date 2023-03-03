<!-- This function updates the average rating of a product in the product table -->
<?php
function updateAvgProductRating(){
    include 'config.php';

    session_start();
    $userId = $_SESSION['userid'];
    //$productId = $_GET['productid']; //this might be wrong way to get this, temp "solution" to move on
    $productId = '35';

    $query = "SELECT rating FROM rating WHERE rating_productid='$productId'";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)){ //you might wanna use mysqli_fetch_array here or similar function, example: $result = mysqli_fetch_array($query, MYSQLI_ASSOC));
        $iterations .= 1;
        $totalRating .= $row;
        echo $iterations . $totalRating;
        
    }

    //calculate average rating
    $averageRating = $totalRating / $iterations;

    $productRating = "UPDATE product SET product_rating=$averageRating WHERE product_id ='$productId'";
    $insert = mysqli_query($conn, $productRating);
}
?>