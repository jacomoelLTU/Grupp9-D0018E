<?php
include '../functions/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
echo"Here is you items:";

$ongoingtransactionid = $_SESSION['ongoingtransactionid'];
echo $ongoingtransactionid;
$item = mysqli_query($conn, "SELECT transactionitem_productid FROM transactionitem WHERE transactionitem_transactionid='$ongoingtransactionid'");
while($row=mysqli_fetch_array($item, MYSQLI_ASSOC)){
    $currentProduct = $row['transactionitem_productid'];
    $product = mysqli_query($conn, "SELECT product_id, product_title, product_price FROM product WHERE product_id='$currentProduct'");
    while($row=mysqli_fetch_array($product, MYSQLI_ASSOC)){
        echo "<div id='cartItem'>".$row['product_title'].
                "<form method='post'>
                    <input type='submit' name='delObj' class='button' value='Del Item'/>
                    <input type='hidden' name='item' value=".$row['product_id'].">
                </form>
              </div><br>";   
    }
}
    if(array_key_exists('delObj', $_POST)) {
        delObj($conn);
    }

    //Functions ----------
    
    function delObj($conn) {
        
    
    }
?>
