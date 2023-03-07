<!-- This function updates the average rating of a product in the product table -->
<?php
function updateAvgProductRating($productId, $conn){
    $outputstring = "";
    $iterations = 0;
    $totalRating = 0;
    $result = mysqli_query($conn, "SELECT rating FROM rating WHERE rating_productid='$productId'");
    
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
        $iterations += 1;
        $totalRating += $row['rating'];
        $outputstring .= "iteration: $iterations " . " totalrating: $totalRating";
    }
    //calculate average rating for product
    $averageRating = round($totalRating / $iterations);

    $productRating = "UPDATE product SET product_rating=$averageRating WHERE product_id =$productId";
    mysqli_query($conn, $productRating);
    echo $outputstring;
}
?>