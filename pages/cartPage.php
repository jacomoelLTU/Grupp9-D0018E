
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
    <?php include 'showCart.php'; ?>


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
            if(isset($_SESSION['ongoingtransactionid'])){
                //Places ongoing transaction as aborted and a user can start a new one...
                mysqli_begin_transaction($conn);
                mysqli_query($conn, "UPDATE `transaction` SET transaction_state='aborted'");
                mysqli_commit($conn);
            }
            else{
                echo"<div id='failedPurchase'>No active transaction...</div>";
            }
        }catch(Exception $e){
            mysqli_rollbacK($conn);
            echo'<script>alert("Rolling back...");</script>';
            throw $e;
        }
    }

    function commit_purchase($conn): void{
        try{
            if(isset($_SESSION['ongoingtransactionid'])){
                //Places ongoing transaction as successful and a user can start a new one...
                mysqli_begin_transaction($conn);
                mysqli_query($conn, "UPDATE `transaction` SET transaction_state='successful'");

                //query to get product id to decrease quantity on.
                $ongoing_id = $_SESSION['ongoingtransactionid'];
                $cart_ids = mysqli_query("SELECT transaction_productid FROM transactionitem WHERE transactionitem_transactionid = $ongoing_id");
                
                while($row = mysqli_fetch_array($cart_ids, MYSQLI_ASSOC)){
                    $productid = $row['transaction_productid'];
                    mysqli_query($conn, "UPDATE `product` SET product_quantity = product_quantity - 1 WHERE product_id = $productid");
                }
    
                mysqli_commit($conn);

                echo"<div id='failedPurchase'>Purchase successful! </div>";
            }
            else{
                echo"<div id='failedPurchase'>Purchase failed...</div>";
            }
        }catch(Exception $e){
            mysqli_rollbacK($conn);
            echo'<script>alert("Rolling back...");</script>';
            throw $e;
        }
    }

    
?>