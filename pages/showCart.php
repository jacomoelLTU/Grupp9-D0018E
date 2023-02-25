<?php
include '../functions/config.php';
session_start();
echo"Here is you items:";

$ongoingtransactionid = $_SESSION['ongoingtransactionid'];
$query = mysqli_query($conn, "SELECT product_id, product_title, product_price FROM product WHERE product_id='$ongoingtransactionid'");

    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
        echo "<div id='cartItem'>".$row['product_title'].
                "<form method='post'>
                    <input type='submit' name='delObj' class='button' value='Del Item'/>
                    <input type='hidden' name='item' value=".$row['product_id'].">
                </form>
              </div><br>";   
    }
    if(array_key_exists('delObj', $_POST)) {
        delObj($conn);
    }

    //Functions ----------
    
    function delObj($conn) {
        
    
    }
?>
