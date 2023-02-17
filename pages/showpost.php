<?php
?>
<link rel="stylesheet" type="text/css" href="../CSS/showpost.css">
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

  mysqli_autocommit($conn, FALSE);

  $query = mysqli_query($conn, "SELECT * FROM product WHERE product_postid='$postId'");
  if($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $url="pages/showpost.php?";
    $object="productId=".$row['product_id']."&productPrice=".$row['product_price'].""; 
    $productId = $row['product_id'];
  }

  mysqli_commit($conn, 1 ,$object);
  echo"PID OCH POSTID:".$productId." o ".$postId;
  if(array_key_exists('addObj', $_POST)) {
    addObj($conn, $productId, $postId);
  }

  ?>
  <form method="post">
      <input type="submit" name="addObj" class="button" value="Add Item"/>
    </form>
  <?php

    //Temporär gå till cart länk
  echo"Click to go to cart: <a href ='cartpage.php'>To Cart</a><br>";
  

//--------------- functions ------------
  
  function addObj($conn, $productId, $postId) {
    session_start();
    if(!isset($_SESSION['objArr'])){
      $_SESSION['objArr'] = array();
    }
    array_push($_SESSION['objArr'], $GLOBALS['object']); //Adds a new object to 'cart'
  //Här tror jag det blir problem för att det get forignkey error när man går för snabbt?
    mysqli_query($conn, "DELETE FROM product WHERE product_id='$productId'");
    mysqli_query($conn, "DELETE FROM post WHERE post_id='$postId'");
    
  }
?>