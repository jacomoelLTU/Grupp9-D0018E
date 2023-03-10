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
      insertToBasket2($conn, $productId);    
    }
  }

  if(array_key_exists('publishComment', $_POST)) {
      publishComment($conn, $postId);    
  }
  
  //Temporär gå till cart länk
    echo"Click to go to cart: <a href ='cartPage.php'>To Cart</a><br>";
//--------------- functions ------------

// echo "<div id='cartItem'>".$row['product_title'].$row['product_id'].
// "<form method='post'>
//     <input type='submit' name='delObj' class='button' value='Del Item'/>
//     <input type='hidden' name='item' value=".$row['product_id'].">
// </form>
// </div><br>";   

$query = "SELECT product_price FROM product WHERE product_postid=$postId ";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$price = $row['product_price'];

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

      $queryAmount = mysqli_query($conn, "SELECT product_quantity FROM product WHERE product_id=$productId");
      $amount = mysqli_fetch_array($queryAmount, MYSQLI_ASSOC);
      if($amount['product_quantity'] >=1){
        if($amount['product_quantity'] - 1 <= 0){
          mysqli_query($conn, "UPDATE product SET product_state='soldout' WHERE product_id=$productId");
        }
      //Decrements amount of products left in table by 1
        mysqli_query($conn, "UPDATE product SET product_quantity = product_quantity-1 WHERE product_id=$productId");
        mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
        echo'<script>alert("Transaction started...");</script>';        
      }
      else{
        mysqli_rollback($conn);
        echo'<script>alert("Seller lacks product...");</script>'; 
      }
      mysqli_commit($conn);
      break;
    case TRUE:
      //Code under is run when a transaction is already existing on currrent user ...
      $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
      $ongoing_transaction_id           = $row['transaction_id'];
      $_SESSION['ongoingtransactionid'] = $row['transaction_id'];
    
      $queryAmount = mysqli_query($conn, "SELECT product_quantity FROM product WHERE product_id=$productId");
      $amount = mysqli_fetch_array($queryAmount, MYSQLI_ASSOC);
      if($amount['product_quantity'] >=1){
        if($amount['product_quantity'] - 1 <= 0){
          mysqli_query($conn, "UPDATE product SET product_state='soldout' WHERE product_id=$productId");
        }
        //Decrements amount of products left in table by 1
        mysqli_query($conn, "UPDATE product SET product_quantity = product_quantity-1 WHERE product_id=$productId");
        mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
        echo'<script>alert("Transaction started...");</script>';
      }
      else{
        mysqli_rollback($conn);
        echo'<script>alert("Seller lacks product...");</script>'; 
      }
      mysqli_commit($conn);
      break;
      }

    }catch(mysqli_sql_exception $e){
      mysqli_rollback($conn);
      echo'<script>alert("Rolling back...");</script>';
      throw $e;
  }
}
function insertToBasket2($conn, $productId): void{
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

      $queryAmount = mysqli_query($conn, "SELECT product_quantity FROM product WHERE product_id=$productId");
      $amount = mysqli_fetch_array($queryAmount, MYSQLI_ASSOC);

      // join query for transaction_id, user_id, product_id
      $numberOfCurrentProductAdded = 0;
      $joinquery = mysqli_query($conn, "SELECT transaction.transaction_id, transaction.transaction_userid, transactionitem.transactionitem_productid FROM transaction INNER JOIN transactionitem ON transaction.transaction_id=transactionitem.transactionitem_transactionid");
      while($row = mysqli_fetch_array($joinquery, MYSQLI_ASSOC)){
        if($row['transaction_userid']==$usrid && $row['transactionitem_productid']==$productId){
          $numberOfCurrentProductAdded += 1;
        }
      }
      
      // Query to transactionitem table to get how many of current product you have added to your cart
      // $transQuery = mysqli_query($conn, "SELECT * FROM transactionitem WHERE transactionitem_productid=$productId");
      // while($row = mysqli_fetch_array($transQuery, MYSQLI_ASSOC)){
      //   $numberOfCurrentProductAdded += 1;
      // }

      if($amount['product_quantity'] >=1 && $numberOfCurrentProductAdded < $amount['product_quantity']){
        //inserts into transactionitem table here
        mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
        echo'<script>alert("Transaction started...");</script>';  
        mysqli_commit($conn);
        }
      else{
        mysqli_rollback($conn);
        echo'<script>alert("Seller lacks quantity...");</script>'; 
      }
      break;

    case TRUE:
      //Code under is run when a transaction is already existing on currrent user ...
      $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
      $ongoing_transaction_id           = $row['transaction_id'];
      $_SESSION['ongoingtransactionid'] = $row['transaction_id'];

      // join query for transaction_id, user_id, product_id
      // we need this because we want to see how many of this product are in this users cart
      // and then see if there exists that many
      $numberOfCurrentProductAdded = 0;
      $joinquery = mysqli_query($conn, "SELECT transaction.transaction_id, transaction.transaction_userid, transactionitem.transactionitem_productid FROM transaction INNER JOIN transactionitem ON transaction.transaction_id=transactionitem.transactionitem_transactionid");
      while($row = mysqli_fetch_array($joinquery, MYSQLI_ASSOC)){
        if($row['transaction_userid']==$usrid && $row['transactionitem_productid']==$productId){
          $numberOfCurrentProductAdded += 1;
        }
      }

      $queryAmount = mysqli_query($conn, "SELECT product_quantity FROM product WHERE product_id=$productId");
      $amount = mysqli_fetch_array($queryAmount, MYSQLI_ASSOC);

      if($amount['product_quantity'] >=1 && $numberOfCurrentProductAdded < $amount['product_quantity']){
        mysqli_query($conn, "INSERT INTO transactionitem(transactionitem_transactionid, transactionitem_productid) VALUES($ongoing_transaction_id, $productId)");
        echo'<script>alert("Item added to cart...");</script>';
        mysqli_commit($conn);
      }
      else{
        mysqli_rollback($conn);
        echo'<script>alert("Seller lacks product...");</script>'; 
      }
      break;
      }

    }catch(mysqli_sql_exception $e){
      mysqli_rollback($conn);
      echo'<script>alert("Rolling back...");</script>';
      throw $e;
  }
}
function getImage($conn, $postId): void{
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
          echo '<img src="data:image/jpeg;base64,'.$image.'">';
      }
  }
}
function publishComment($conn, $postId){
  session_start();
  $userId = $_SESSION['userid'];
  $comment = $_POST['comment'];
  mysqli_query($conn, "INSERT INTO comment(comment_userid, comment_postid, comment) VALUES ($userId, $postId, '$comment')");
}
function getComments($conn, $postId){
  $result = mysqli_query($conn, "SELECT comment_userid, comment, created_at FROM comment WHERE comment_postid=$postId");
  while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $userQuery = mysqli_query($conn, "SELECT user_name FROM user WHERE user_id=$row[comment_userid]");
    $username = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
    echo
        "<div id='commentsection'>
          User: ".$username['user_name']."<br>
          Comment: ".$row['comment']."<br>
          Published: ".$row['created_at']."
        </div><br>";
  }
}
?>

<link rel="stylesheet" type="text/css" href="../CSS/showPost.css">
<a href="../index.php">To home</a>
<center>
<div id="postContainer">
  <div id="grid-Title">Post Title:       <?php echo $_GET['postTitle'];       ?></div>
  <div id="grid-Desc">Post Description: <?php echo $_GET['postDescription']; ?></div>
  <div id="grid-Image">
      <?php getImage($conn,  $postId);?>
    <!-- För att lägga till alla bilder som är uppladdade på posten kan vi ha som whileloopen i php som printar ut img strängarna med rätt värden. -->
    <!-- <div id="img-container">
      <img src="../pictures/profilePictureTemplate.jpg" class="img1">
      <img src="../pictures/img2.png" class="img2">
    </div> -->
  </div>
  <div id="grid-B">
    <link rel="stylesheet" type="text/css" href="../CSS/ratingForm.css">
    <body onload='getRating("../functions/rating/getRatingData.php?postId=<?php echo "$postId"?>")'>
    <div class="container">
        <h2>Rating</h2>
        <span id="post_list"></span>
    </div>
    </body>
  </div>
  <div id="grid-C">C</div>
  <div id="grid-D"></div>
  <div id="grid-E">E</div>
  <div id="grid-F">
    <div id="price">
      <?php echo $price."kr"; ?>
    </div>
  </div>
  <div id="grid-G">
    <form method="post">
      <input type="submit" name="insertToBasket" class="button buttonAdd" value="Add Item"/>
    </form>
  </div>
</div>
<div id ="commentsection">
  <form method="post">
  <p id="comment"> Comment <br><br><textarea rows = "5" cols = "40" name = "comment" placeholder="Say something nice :)" required></textarea></p>
  <input type="submit" class = "comment_button" name = "publishComment" value="Publish"/><br> 
  </form>
  <p id="comments"> <?php getComments($conn, $postId); ?> </p>
</div>

</center>





<script type="text/javascript">

  function getRating(url) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("post_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
  }

  function mouseOverRating(productId, rating) {

      resetRatingStars(productId)

      for (var i = 1; i <= rating; i++)
      {
          var ratingId = productId + "_" + i;
          document.getElementById(ratingId).style.color = "#ff6e00";

      }
  }

  function resetRatingStars(productId)
      {
      for (var i = 1; i <= 5; i++)
      {
          var ratingId = productId + "_" + i;
          document.getElementById(ratingId).style.color = "#9E9E9E";
      }
  }

  function mouseOutRating(productId, userRating) {
      var ratingId;
      if(userRating !=0) {
              for (var i = 1; i <= userRating; i++) {
                      ratingId = productId + "_" + i;
                  document.getElementById(ratingId).style.color = "#ff6e00";
              }
      }
      if(userRating <= 5) {
              for (var i = (userRating+1); i <= 5; i++) {
                  ratingId = productId + "_" + i;
              document.getElementById(ratingId).style.color = "#9E9E9E";
          }
      }
  }

  function addRating(productId, ratingValue) {
      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

              getRating('../functions/rating/getRatingData.php?postId=<?php echo "$postId"?>');

          }
      };

      xhttp.open("POST", "../functions/rating/insertRating.php?postId=<?php echo "$postId"?>", true);
      xhttp.setRequestHeader("Content-type",
              "application/x-www-form-urlencoded");
      var parameters = "rating=" + ratingValue + "&rating_productid="
              + productId;
      xhttp.send(parameters);
  }
</script>