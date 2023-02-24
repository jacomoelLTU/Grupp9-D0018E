<?php
?>
<link rel="stylesheet" type="text/css" href="../CSS/showPost.css">
<a href="../index.php">To home</a>
<center>
<div id="postContainer">
  <div id="grid-Title">Post Title:       <?php echo $_GET['postTitle'];       ?></div>
  <div id="grid-Desc">Post Description: <?php echo $_GET['postDescription']; ?></div>
  <div id="grid-Image">
    <!-- För att lägga till alla bilder som är uppladdade på posten kan vi ha som whileloopen i php som printar ut img strängarna med rätt värden. -->
    <!-- <div id="img-container">
      <img src="../pictures/profilePictureTemplate.jpg" class="img1">
      <img src="../pictures/img2.png" class="img2">
    </div> -->
  </div>
  <div id="grid-B">B</div>
  <div id="grid-C">C</div>
  <div id="grid-D">D</div>
  <div id="grid-E">E</div>
  <div id="grid-F">F</div>
  <div id="grid-G">G</div>
</div>
</center>

<form method="post">
  <input type="submit" name="insertToBasket" class="button" value="Add Item"/>
</form>

<?php
//Add to isplay all errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  include '../functions/config.php';

  $postId = $_GET['postId'];
  $query = mysqli_query($conn, "SELECT * FROM product WHERE product_postid='$postId'");
  if($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $url="pages/showPost.php?";
    $object="productId=".$row['product_id']."&productPrice=".$row['product_price'].""; 
    $productId = $row['product_id'];
  }

//---------- Button Add Item -------------
  if(array_key_exists('insertToBasket', $_POST)) {
    if(isset($productId)){
      insertToBasket($conn, $productId);    
    }
  }
  
  //Temporär gå till cart länk
    echo"Click to go to cart: <a href ='cartPage.php'>To Cart</a><br>";
//--------------- functions ------------
  
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
?>