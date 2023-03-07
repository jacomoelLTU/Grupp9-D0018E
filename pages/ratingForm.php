<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../CSS/ratingForm.css">
<body onload="getRating('../functions/getRatingData.php?postId=1244')">
    <div class="container">
        <h2>Rating System</h2>
        <span id="post_list"></span>
    </div>
</body>

<!-- Har detta script här medans jag testar -->
<script type="text/javascript">

    function getRating(url) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("post_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }

    function mouseOverRating(productId, rating) {

        resetRatingStars(productId)

        for (var i = 1; i <= rating; i++)
        {
            var ratingId = productId + "_" + i;
            document.getElementById(ratingId).style.color = "#ff6e00";

        }
    }

    function resetRatingStars(productId)
        {
        for (var i = 1; i <= 5; i++)
        {
            var ratingId = productId + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }

    function mouseOutRating(productId, userRating) {
        var ratingId;
        if(userRating !=0) {
                for (var i = 1; i <= userRating; i++) {
                        ratingId = productId + "_" + i;
                    document.getElementById(ratingId).style.color = "#ff6e00";
                }
        }
        if(userRating <= 5) {
                for (var i = (userRating+1); i <= 5; i++) {
                    ratingId = productId + "_" + i;
                document.getElementById(ratingId).style.color = "#9E9E9E";
            }
        }
    }

    function addRating(productId, ratingValue) {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                getRating('../functions/getRatingData.php');

                if (this.responseText != "success") {
                    alert(this.responseText);
                }
            }
        };

        xhttp.open("POST", "../functions/insertRating.php", true);
        xhttp.setRequestHeader("Content-type",
                "application/x-www-form-urlencoded");
        var parameters = "rating=" + ratingValue + "&rating_productid="
                + productId;
        xhttp.send(parameters);
    }
</script>





