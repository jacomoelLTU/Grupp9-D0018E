
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
        <form method="post">
            <input name="purchase" type = "submit" onclick="alert('Continue to card payment (outside of the course goals)')" id="checkoutButton" value="PayNow"></input>

            <!-- Cancle button, initiates rollback of tables -->
            <input name="cancel" type="submit" id="cancelButton" value="Cancel Puchase"></input>
        </form>
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
    function cancel_purchase($conn): void{
        try{
            mysqli_rollback($conn);
            echo'<script>alert("Rolling back...");</script>';
        }catch(Exception $e){
        die($e);
        }
    }

    function commit_purchase($conn): void{
        try{
            mysqli_commit($conn);
            echo'<script>alert("Commiting purchase...");</script>';
        }catch(Exception $e){
        die($e);
        }
    }
?>