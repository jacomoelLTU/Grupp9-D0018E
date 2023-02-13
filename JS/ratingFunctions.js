function mouseOverRating(postId, rating) {

    resetRatingStars(postId)

    for (var i = 1; i <= rating; i++)
    {
        var ratingId = postId + "_" + i;
        document.getElementById(ratingId).style.color = "#ff6e00";

    }
}

function resetRatingStars(productId)
{
    for (var i = 1; i <= 5; i++)
    {
        var ratingId = postId + "_" + i;
        document.getElementById(ratingId).style.color = "#9E9E9E";
    }
}

function mouseOutRating(productId, userRating) {
    var ratingId;
    if(userRating !=0) {
            for (var i = 1; i <= userRating; i++) {
                    ratingId = restaurantId + "_" + i;
                document.getElementById(ratingId).style.color = "#ff6e00";
            }
    }
    if(userRating <= 5) {
            for (var i = (userRating+1); i <= 5; i++) {
                ratingId = postId + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }
}