<link rel="stylesheet" type="text/css" href="CSS/middle.css">
<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include 'config.php';
  $query = mysqli_query($conn, "SELECT product_id, product_title FROM product");
  while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
  echo "<center>
            <div id='postItem'>"
                .$row['product_id']."
            </div>
      </center>";
  }
?>

<form method="post">
      <input type="submit" name="delItem" class="button" value="Del Item"/>
    </form>
<?php
    if(array_key_exists('delItem', $_POST)) {
        delItem();
    }
  function delItem() {
   echo"clicked the button!!!!!!!!!!!!!!!!";
    // session_start();
    // if(!isset($objArr)){
    //   $_SESSION['objArr'] = array();
    // }
    // echo "Current object".$GLOBALS['object'];
    // array_push($_SESSION['objArr'], $GLOBALS['object']); //Adds a new object to 'cart'
  }
  
?>