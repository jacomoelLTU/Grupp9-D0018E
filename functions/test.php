<link rel="stylesheet" type="text/css" href="CSS/middle.css">

<form method="post">
  <input type="submit" name="delItems" class="button" value="Del Items"/>
  <input type="submit" name="rollback" class="button" value="RollbacK!"/>
</form>

<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include 'config.php';
  mysqli_autocommit($conn, FALSE);

  $query = mysqli_query($conn, "SELECT product_id, product_title FROM product");
  while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
  echo "<center>
            <div id='postItem'>"
                .$row['product_id']."
            </div>
      </center>";
  }
  mysqli_commit($conn);

   if(array_key_exists('delItems', $_POST)) {
        delItems($conn);
    }
    if(array_key_exists('rollback', $_POST)) {
      rollback($conn);
  }
  function delItems($conn) {
    mysqli_query($conn, "DELETE FROM product WHERE product_id='10'");
  }
  function rollback($conn) {
    mysqli_rollback($conn);
  }
?>