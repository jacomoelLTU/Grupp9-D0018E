<?php
include '../functions/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
showItems($conn);

//Functions ----------
function showItems($conn): void{
    echo"Here is you items:";
    try{
    $otId = $_SESSION['ongoingtransactionid'] ?? NULL;
    if($otId != NULL){
        $ongoingtransactionid = $_SESSION['ongoingtransactionid'];
        $item = mysqli_query($conn, "SELECT transactionitem_productid FROM transactionitem WHERE transactionitem_transactionid='$ongoingtransactionid'");
        while($row=mysqli_fetch_array($item, MYSQLI_ASSOC)){
            $currentProduct = $row['transactionitem_productid'];
            $product = mysqli_query($conn, "SELECT product_title, product_price FROM product WHERE product_id='$currentProduct'");
            while($productRow=mysqli_fetch_array($product, MYSQLI_ASSOC)){
                echo "<div id='cartItem'>".$productRow['product_title']." Product id:".$currentProduct.
                        "<form method='post'>
                            <input type='hidden' name='item' value=".$currentProduct.">
                            <input type='submit' name='delObj' class='button' value='Del Item'/>
                        </form>
                        </div><br>";                 
            } 
            if(array_key_exists('delObj', $_POST)) {
                $item = $_POST['item'];
                delObj($conn, $item);
            }  
        }
    }
    
    }catch(mysqli_sql_exception $e){
        throw $e;
    }
}

function delObj($conn, $productId): void{
    mysqli_begin_transaction($conn);
    try{
        //This is what deletes the chosen deleted item...
        mysqli_query($conn, "DELETE FROM transactionitem WHERE transactionitem_productid='$productId'");
        //mysqli_query($conn, "UPDATE product SET product_quantity = product_quantity+1 WHERE product_id=$pid");
        mysqli_commit($conn);
    }catch(mysqli_sql_exception $e){
        echo'<script>alert("id='.$productId.'Rolling back...");</script>';
        mysqli_rollback($conn);
        throw $e;

    }
    echo"<script>location.reload();</script>";
}
?>
