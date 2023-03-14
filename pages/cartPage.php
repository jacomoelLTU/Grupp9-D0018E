
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
                $ongoing_id = $_SESSION['ongoingtransactionid'];
                mysqli_query($conn, "UPDATE `transaction` SET transaction_state='aborted' WHERE transaction_id='$ongoing_id'");

                //deletes all products from the cart display and the corresponding tables in DB
                
                mysqli_query($conn, "DELETE from transactionitem WHERE transactionitem_transactionid = $ongoing_id");

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
                $ongoing_id = $_SESSION['ongoingtransactionid'];
                $userId = $_SESSION['userid'];

                //update transaction to successful
                mysqli_query($conn, "UPDATE `transaction` SET transaction_state='successful' WHERE transaction_id='$ongoing_id'");
                
                //query to get product id
                $cart_ids = mysqli_query($conn, "SELECT transactionitem_productid FROM transactionitem WHERE transactionitem_transactionid = $ongoing_id");

                while($row = mysqli_fetch_array($cart_ids, MYSQLI_ASSOC)){
                    $productId = $row['transactionitem_productid'];

                    // join query for transaction_id, user_id, product_id
                    // we need this because we want to see how many of this product are in this users cart
                    // and then see if there exists that many
                    $numberOfCurrentProductAdded = 0;
                    $joinquery = mysqli_query($conn, "SELECT transaction.transaction_id, transaction.transaction_userid, transactionitem.transactionitem_productid FROM transaction INNER JOIN transactionitem ON transaction.transaction_id=transactionitem.transactionitem_transactionid");
                    while($row = mysqli_fetch_array($joinquery, MYSQLI_ASSOC)){
                        if($row['transaction_userid']==$userId && $row['transactionitem_productid']==$productId){
                        $numberOfCurrentProductAdded += 1;
                        }
                    }

                    //query to check if product still in stock
                    $productQuantityQuery = mysqli_query($conn, "SELECT product_quantity FROM product WHERE product_id=$productId");
                    $productQuantityRow = mysqli_fetch_array($productQuantityQuery, MYSQLI_ASSOC);
                    if($productQuantityRow['product_quantity'] < 1){ // we wanna compare with numberofcurrentproductadded but if we do it now it will only iterate once, next iteration wont go through cause numberofproductadded will be higher than product_quantity, since we are decreasing product_quantity below 
                        mysqli_rollback($conn);
                        echo'<script>alert("Product out of stock. Rolling back...");</script>';
                        break;
                    }
                    else {
                        //decrease quantity
                        mysqli_query($conn, "UPDATE `product` SET product_quantity = product_quantity - 1 WHERE product_id = $productId");
                        //HERE we would like to delete 1 product of this kind from transactionitem

                        // sold out query to product table
                        $queryAmount = mysqli_query($conn, "SELECT product_quantity FROM product WHERE product_id=$productId");
                        $amount = mysqli_fetch_array($queryAmount, MYSQLI_ASSOC);
                        if($amount['product_quantity'] <= 0){
                            mysqli_query($conn, "UPDATE product SET product_state='soldout' WHERE product_id=$productId");
                        }
                    }                   
                }
                
                //gotta remove everything from transactionitem
                mysqli_query($conn, "DELETE from transactionitem WHERE transactionitem_transactionid = $ongoing_id");
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