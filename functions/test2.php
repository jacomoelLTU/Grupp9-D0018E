

<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include 'config.php';
  
  

  $query = mysqli_query($conn, "SELECT test_id, test_title FROM test");
  while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
  echo "<center>
            <div id='postItem'>"
                .$row['test_title']."
            </div>
      </center>";
  }
  mysqli_begin_transaction($conn);
  mysqli_query($conn,"INSERT INTO test (test_title) VALUES ('cake')");
  mysqli_query($conn,"INSERT INTO test (test_title) VALUES ('cake')");
  mysqli_query($conn,"INSERT INTO test (test_title) VALUES ('cake')");
  
?>
<form method="post">  
    <input type="submit" name="rollback" class="button" value="Rollback!"/>
</form>
<?php

  if(array_key_exists('rollback', $_POST))  {mysqli_rollback($conn);}

?>