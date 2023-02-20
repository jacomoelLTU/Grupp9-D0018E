<link rel="stylesheet" type="text/css" href="CSS/middle.css">

<form method="post">
  <input type="submit" name="delItems" class="button" value="Del Items"/>
  <input type="submit" name="rollback" class="button" value="Rollback!"/>
  <input type="submit" name="insertItem" class="button" value="Add cake!!"/>
  <input type="submit" name="commit" class="button" value="Commit"/>
</form>

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

   
  if(array_key_exists('delItems', $_POST))  {delItems($conn);}
  if(array_key_exists('rollback', $_POST))  {mysqli_rollback($conn);}
  if(array_key_exists('insertItem', $_POST)){insertItem($conn);} 
  if(array_key_exists('commit', $_POST))    {mysqli_commit($conn);}
 
  function delItems($conn) {
    mysqli_query($conn, "DELETE FROM test ORDER BY test_id DESC LIMIT 1;");
    return;
  }
  function rollback($conn) {
    mysqli_rollback($conn);
    return;
  }
  function insertItem($conn) {
    mysqli_query($conn,"INSERT INTO test (test_title) VALUES ('cake')");
    return;
  }
  function commit($conn) {
    mysqli_commit($conn);
    return;
  }
?>