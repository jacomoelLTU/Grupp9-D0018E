<link rel="stylesheet" type="text/css" href="../CSS/examplepost.css">

Example how a post could look 
<div id="preview">
    <img src = "../pictures/isseymiyakebomber.jpg" width = "400px" height="auto"/>


    <div id = "addToCartParentDiv">
        <button id = "addtoCartButton" value = "Add to cart"></button>
    </div>

    <div id="textdiv">
        Title: Issey Miyake Bomber <br>
        Description: Issey Miyake AW88/89 reversible <br>bomber jacka med print av Tomio Mohri.<br>Köpt på grailed. Skick 9/10. <br>Går för ca 13000kr.<br>
        Quantity: 1<br>
        Price: 12000kr 
    </div>

    <body onload="getRating('../functions./getRating.php')">
        <div class="container">
            <h2>Rating System</h2>
        </div>
    </body>
</div> 

<!-- Har detta script här medans jag testar -->
<script>
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
</script>
