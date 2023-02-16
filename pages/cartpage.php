
<link rel="stylesheet" type="text/css" href="../CSS/cartpage.css">

<div id = "cartHeader">
   <h1 id = "cartWelcome"> Welcome to your shoppingcart!</h1> 
    <p id = "cartBackToHome">Click the link to got to home page, <a href="../index.php">To home</a></p>
</div>

<body>

    <!-- ROOM FO THE LIST OF ALL PRODUCTS IN THE CART -->
    <?php
        session_start();
        $objectArr=explode("{}",$_SESSION['cartObject']);
        foreach($objectArr as $obj){
            echo $obj."\n";
        }
    ?>


    <!-- this two buttons should display after rows with items in the cart -->
    <div id = "buttons">
        <button type = "button" onclick="alert('Continue to card payment (outside of the course goals)')" id="checkoutButton" >PayNow</button>

        <!-- below should be be the button that sets of rollBack in tables when a purchase gets canled -->
        <button type="button" id="cancelButton" value="Cancel">Cancel purchase</button>
    </div>

</body>