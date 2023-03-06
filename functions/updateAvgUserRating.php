<!-- This function updates the average rating for a user in the user table -->
<?php
function updateAvgUserRating($postId, $conn){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //$query = "SELECT product_rating, product_postid FROM product WHERE product_userid='$userId'";
    //$result = mysqli_query($conn, $query);
    $outputstring = "";
    $iterations = 0;
    $totalRating = 0;

    $getpostowner = mysqli_query($conn, "SELECT post_userid FROM post WHERE post_id=$postId");
    $postowner = mysqli_fetch_array($getpostowner, MYSQLI_ASSOC);

    $joinquery = mysqli_query($conn, "SELECT post.post_userid, post.post_id, product.product_rating FROM post INNER JOIN product ON post.post_id=product.product_postid;");
    
    while($row = mysqli_fetch_array($joinquery, MYSQLI_ASSOC)){
        if(!empty($postowner['post_userid'])){
            $outputstring .= "postownerid:". $postowner['post_userid'] . "rowpostuserid: $row[post_userid]";
            if($row['post_userid']==$postowner['post_userid'] && !empty($row['product_rating'])){
                $iterations += 1;
                $totalRating += $row['product_rating'];
                $outputstring .= "iterationuser: $iterations " . " totalratinguser: $totalRating";
            }
        }
    }
    //calculate average rating for user
    if($iterations!=0){
    $averageRating = round($totalRating / $iterations);
    $userRating = "UPDATE user SET user_rating=$averageRating WHERE user_id=$postowner[post_userid]";
    mysqli_query($conn, $userRating);
    }

    echo $outputstring;
}
?>