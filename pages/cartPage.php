
<?php
include "../functions/config.php";

?>

<link rel="stylesheet" type="text/css" href="../CSS/cartPage.css">
<div id = "cartHeader">
   <h1 id = "cartWelcome"> Welcome to your shoppingcart!</h1> 
    <p id = "cartBackToHome">Click the link to got to home page, <a href="../index.php">To home</a></p>
</div>

<body>

    <!-- ROOM FO THE LIST OF ALL PRODUCTS IN THE CART -->
    <?php include 'showcart.php'; ?>


    <!-- this two buttons should display after rows with items in the cart -->
    <div id = "buttons">
        <button name="cancel" type = "button" onclick="alert('Continue to card payment (outside of the course goals)')" id="checkoutButton" >PayNow</button>

        <!-- Cancle button, initiates rollback of tables -->
        <button name="purchase" type="button" id="cancelButton" value="Cancel">Cancel purchase</button>
    </div>

</body>

<!-- \/ \/ \/ \/ \/  PHP  \/ \/ \/ \/ \/ -->

<?php

//------------ When buttons are clicked -------
if(array_key_exists('cancel', $_POST))   {cancel_purchase($conn);}
if(array_key_exists('purchase', $_POST)) {commit_purchase($conn);}
  
  //Temporär gå till cart länk
    echo"Click to go to cart: <a href ='cartPage.php'>To Cart</a><br>";

    //--------------- functions ------------
    function cancel_purchase($conn){
        try{
            mysqli_rollback($conn);
           echo'alert("Rolling back...");';
        }catch(Exception $e){
        die($e);
        }
    }

    function commit_purchase($conn){
        try{
            mysqli_commit($conn);
            echo'alert("Commiting purchase...");';
        }catch(Exception $e){
        die($e);
        }
    }
?>