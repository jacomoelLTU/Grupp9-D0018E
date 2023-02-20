function addRating(productId, ratingValue) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            getRating('../functions/getRating.php');

            if (this.responseText != "success") {
                alert(this.responseText);
            }
        }
    };

    xhttp.open("POST", "../functions/insertRating.php", true);
    xhttp.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
    var parameters = "rating=" + ratingValue + "&post_id="
            + productId;
    xhttp.send(parameters);
}