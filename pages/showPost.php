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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    //DUMMY VARIABLE DURING TESTS
    $productId = 1;
    if(isset($productId)){
      insertToBasket($conn, $productId, $postId);    
    }
  }
  
  //Temporär gå till cart länk
    echo"Click to go to cart: <a href ='cartPage.php'>To Cart</a><br>";
//--------------- functions ------------
  
  function insertToBasket($conn, $productId, $postId): void {
    try{
      mysqli_begin_transaction($conn);
        session_start();
        if(isset($_SESSION['userid'])){
          $usrid = $_SESSION['userid'];
        }
        else{
          $usrid = 16;
        }
        //Om inte en transaction existerar som är pågående... skapa en ny. State is set default as ongoing...       
        $query = mysqli_query($conn, "SELECT transaction_id, transaction_userid FROM `transaction` WHERE transaction_userid=$usrid AND NOT transaction_state='ongoing'");
        if(!(mysqli_num_rows($query))){
          echo"NO EXISTING TRANSACTION ROW, ADDING ONE....";
          mysqli_query($conn, "INSERT INTO `transaction`(transaction_userid) VALUES($usrid)"); 
        }
        elseif((mysqli_num_rows($query) > 0) && ((mysqli_fetch_array($query, MYSQLI_ASSOC))['transactionitem_transactionid']) != NULL){
          $query = mysqli_query($conn, "SELECT transaction_id, transaction_userid FROM `transaction` WHERE transaction_userid=$usrid AND transaction_state='ongoing'");
          $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
          $ongoing_transaction_id           = $row['transaction_id'];
          $_SESSION['ongoingtransactionid'] = $row['transaction_id'];
          mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
          echo'<script>alert("Transaction started...");</script>';
        }
      mysqli_commit($conn);
      }catch(mysqli_sql_exception $e){
        mysqli_rollback($conn);
        echo'<script>alert("Rolling back...");</script>';
        throw $e;
    }
  }
?>