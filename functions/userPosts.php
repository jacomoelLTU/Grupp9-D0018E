<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';


function getImage($conn, $postId): string{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $query = "SELECT post_title, post_img FROM post WHERE post_id=$postId ";
    $result = mysqli_query($conn, $query);
  
    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //if post_img has value
        if (!empty($row['post_img'])) {
  
            //get url from post_img
            $url = "$row[post_img]";
  
            //get content from the url and encode so we can see the image
            $image = base64_encode(file_get_contents($url));
  
            //print title and image
            return "style='background-image:url(data:image/jpeg;base64,".$image."');";
        }
    }
}

function insertToBasket($conn, $productId): void {
    try{
      session_start();
      mysqli_begin_transaction($conn);
  
      //Checks if there is a session active, if not set $usrid to null...
      $usrid = $_SESSION['userid'] ?? NULL;
      if($usrid == NULL){echo "You need to be logged in to add items..."; throw new Exception('User needs to be logged in to add item...');}
  
      $query = mysqli_query($conn, "SELECT transaction_id, transaction_userid FROM `transaction` WHERE transaction_userid='$usrid' AND transaction_state='ongoing'");      
      switch(mysqli_num_rows($query)){
      //Code under is run when a transaction with current user does not exist...
      case FALSE:
        mysqli_query($conn, "INSERT INTO `transaction`(transaction_userid) VALUES($usrid)"); 
  
        $query = mysqli_query($conn, "SELECT transaction_id, transaction_userid FROM `transaction` WHERE transaction_userid='$usrid' AND transaction_state='ongoing'");
  
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $ongoing_transaction_id           = $row['transaction_id'];
        $_SESSION['ongoingtransactionid'] = $row['transaction_id'];
        echo'<script>alert("'.$ongoing_transaction_id.' PRODUCTID ='.$productId.'");</script>';
        
        mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
        echo'<script>alert("Transaction started...");</script>';        
        mysqli_commit($conn);
        break;
      case TRUE:
        //Code under is run when a transaction is already existing on currrent user...
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $ongoing_transaction_id           = $row['transaction_id'];
        $_SESSION['ongoingtransactionid'] = $row['transaction_id'];
      
        mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
        echo'<script>alert("Transaction started...");</script>';
        mysqli_commit($conn);
        break;
        }
      }catch(mysqli_sql_exception $e){
        mysqli_rollback($conn);
        echo'<script>alert("Rolling back...");</script>';
        throw $e;
    }
  }
// --- ^^^ FUNCTIONS ^^^ ---


?>
<script>
function myFunction() {
  alert("Added item to cart...");
}
document.getElementById("addItemIcon").onclick=myFunction();
</script>
<?php


$userid = $_SESSION['userid'];

//we have to implement if post_img is not empty below

$query = mysqli_query($conn, "SELECT * FROM post WHERE post_userid='$userid'");
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    echo"
    <div id='postItem' " .getImage($conn, $row['post_id'])."'> 
        <div class='showItemText'></div>
        <div id='addItemIcon'><i class='bi bi-bag-plus'></i></div>
        <a class='editItemIcon' href='../pages/editPost.php?postId=".$row['post_id']."'><i class='bi bi-three-dots-vertical'></i></a>
    </div>";
}

?>