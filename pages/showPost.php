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
function getPostId():int{
  global $postId;
  return $postId;
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

$query = "SELECT product_price FROM product WHERE product_postid=$postId ";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$price = $row['product_price'];
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
    <!-- <?php //echo "<body onload='getRating('../functions/getRatingData.php?postId=1244')'>"?> -->
    <body onload='getRating("../functions/getRatingData.php?postId=<?php echo "$postId"?>")'>
    <div class="container">
        <h2>Rating</h2>
        <span id="post_list"></span>
    </div>
    </body>
  </div>
  <div id="grid-C">C</div>
  <div id="grid-D">D</div>
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

                getRating('../functions/getRatingData.php');

                if (this.responseText != "success") {
                    alert(this.responseText);
                }
            }
        };

        xhttp.open("POST", "../functions/insertRating.php?postId=<?php echo "$postId"?>", true);
        xhttp.setRequestHeader("Content-type",
                "application/x-www-form-urlencoded");
        var parameters = "rating=" + ratingValue + "&rating_productid="
                + productId;
        xhttp.send(parameters);
    }
</script>

<?php 
function getRatingData(){
  require_once "ratingFunctions.php";
  require_once "config.php";
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  
  echo "Hello world!<br>";
  
  session_start();
  $userId = $_SESSION['userid'];
  $postId = $_GET['postId'];
  //$postId = '1244';
  
  
  //get product id from product table
  $productIdquery = mysqli_query($conn, "SELECT product_id FROM product WHERE product_postid=$postId;");
  $productrow = mysqli_fetch_assoc($productIdquery);
  $productId = $productrow['product_id'];
  
  // product query
  $query = "SELECT * FROM product WHERE product_id=$productId";
  $result = mysqli_query($conn, $query);
  
  $outputString = '';
  
  foreach ($result as $row) {
      // $userRating = "SELECT rating FROM rating WHERE user_id='19'";
      // $ratingQuery = mysqli_query($conn, $userRating);
      $postId = $row['product_postid'];
      $productRating = productRating($userId, $productId, $conn);
      $totalRating = totalRating($productId, $conn);
  
      // $totalRating = totalRating($row['id'], $conn);
      //hardcode to test
      // $averageRating = "SELECT product_rating FROM product WHERE product_id='33'";
      // $avgRatingQuery = mysqli_query($conn, $averageRating);
      // $totalReviews = "";
  
      $outputString .= '
          <div class="row-item">
          <div class="row-title">' . $row['product_title'] . '</div> <div class="response" id="response-' . $productId . '"></div>
          <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $productId . ',' . $productRating . ');"> ';
      
      for ($count = 1; $count <= 5; $count ++) {
          $starRatingId = $productId . '_' . $count;
          
          //kan vara här felet är, jämför med guiden, där använder dem ratingen current user har lagt istället för average på hela produkten
          if ($count <= $productRating) {
              
              $outputString .= '<li value="' . $count . '" product_id="' . $starRatingId . '" class="star selected">&#9733;</li>';
          } else {
              $outputString .= '<li value="' . $count . '"  product_id="' . $starRatingId . '" class="star" onclick="addRating(' . $productId . ',' . $count . ');" onmouseover="mouseOverRating(' . $productId . ',' . $count . ');">&#9733;</li>';
          }
      } // endFor
      
      $outputString .= '
          </ul>
          
          <p class="review-note">Total Reviews: ' . $totalRating . '</p>
          <p class="text-address">' . $row["product_state"] . '</p>
          </div>
          ';
  }
  echo $outputString;
}
?>