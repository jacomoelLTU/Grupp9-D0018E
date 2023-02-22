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

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  include '../functions/config.php';
  $postId = $_GET['postId'];

  //mysqli_autocommit($conn, FALSE);

  $query = mysqli_query($conn, "SELECT * FROM product WHERE product_postid='$postId'");
  if($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $url="pages/showPost.php?";
    $object="productId=".$row['product_id']."&productPrice=".$row['product_price'].""; 
    $productId = $row['product_id'];
  }

  // mysqli_commit($conn, 1 ,$object);
  if(array_key_exists('insertToBasket', $_POST)) {
    if(isset($productId)){
      insertToBasket($conn, $productId, $postId);    
    }
  }

  ?>
  <form method="post">
      <input type="submit" name="insertToBasket" class="button" value="Add Item"/>
    </form>
  <?php

    //Temporär gå till cart länk
  echo"Click to go to cart: <a href ='cartPage.php'>To Cart</a><br>";
  

//--------------- functions ------------
  
  function insertToBasket($conn, $productId, $postId) {
    session_start();
    try{
      mysqli_begin_transaction($conn);
      echo"Transaction started...";

    }catch(Exception $e){
      mysqli_rollback($conn);
      echo("Rolling back...");
      die($e);
    }
   
  }
?>