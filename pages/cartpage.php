
<?php
include "../functions/config.php";

?>

<link rel="stylesheet" type="text/css" href="../CSS/cartpage.css">
<div id = "cartHeader">
   <h1 id = "cartWelcome"> Welcome to your shoppingcart!</h1> 
    <p id = "cartBackToHome">Click the link to got to home page, <a href="../index.php">To home</a></p>
</div>

<body>

    <!-- ROOM FO THE LIST OF ALL PRODUCTS IN THE CART -->
    <!-- description with seller user name , a list (1 - n) -->
    <!-- price summary -->
    <?php
        
    ?>

    <!-- this two buttons should display after rows with items in the cart -->
    <div id = "buttons">
        <button type = "button" onclick="alert('Continue to card payment (outside of the course goals)')" id="checkoutButton" >PayNow</button>

        <!-- Cancle button, initiates rollback of tables -->
        <button type="button" id="cancelButton" value="Cancel">Cancel purchase</button>
    </div>

</body>