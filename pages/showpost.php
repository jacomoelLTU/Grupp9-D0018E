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

$query = mysqli_query($conn, "SELECT * FROM post WHERE post_id='$postId'");

// $urlFlag1 ="?postId=27&postTitle=en%20fin%20post&postDescription=En%20fin%20post";
// $urlFlag2 ="?postId=35&postTitle=quantitypost&postDescription=nice";

// comit($conn, urlFlag2);

if($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    session_start();
    if(!isset($_SESSION['cartObjects'])){
      $_SESSION['cartObjects'];
    }
    $url="pages/showpost.php?";
    $object="{postId=".$row['post_id']."&postTitle=".$row['post_title']."}"; 
    $_SESSION['cartObjects'] .=$object; //Adds currentURL + $url

  }
  mysqli_commit($conn, 1 ,$url.$object);

  echo"Click to add to cart and go to cart: <a href ='cartpage.php".$_SESSION['cartObjects']."'>add to cart</a><br>";

  mysqli_autocommit($conn, TRUE);

?>