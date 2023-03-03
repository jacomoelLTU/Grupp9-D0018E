<?php
/*   ---------------  Functions  --------------- */
function autorization($conn){
    session_start();
    $validated = false;
    if($usrid = $_SESSION['userid']){
        $query = mysqli_query($conn, "SELECT post_id FROM post WHERE post_userid=$usrid");
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        //If there is a product id with this user that is logged in then validated is true;
        $postId = $row['post_id'] ?? NULL;
        if($postId != NULL){$validated=true;}
    }
    else{
        $validated = false;
    }
    return $validated;
}

//---------- Button SubmitEdit -------------
if(array_key_exists('submitEdit', $_POST)) {
    if(isset($_GET['postId'])){
        echo"<script>alert('klickade på submit knapp');</script>";
        $uT=$_POST['updateTitle']; 
        $uD=$_POST['updateDescription']; 
        $uP=$_POST['updatePrice'];
        $pI=$_POST['post_id'];
      submitEdit($conn, $uT, $uD, $uP, $pI);    
    }
  }
  
function submitEdit($conn, $newTitle, $newDesc, $newPrice, $postId):void{
   try{
    mysqli_begin_transaction($conn);
   
    mysqli_query($conn, "UPDATE post SET post_title=$newTitle, post_description=$newDesc WHERE post_id=$postId");
    mysqli_query($conn, "UPDATE product SET product_price=$newPrice WHERE product_postid=$postId");
   
    mysqli_commit($conn);
    echo"<script>alert('SKer commit');</script>";

    }catch(mysqli_sql_exception $e){
    mysqli_rollback($conn);
    echo'<script>alert("Rolling back...");</script>';
    throw $e;
    }
}


/*   --------------- ^^^^^ Functions ^^^^ --------------- */



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../functions/config.php';

if(autorization($conn)){
    $usrid = $_SESSION['userid'];
    $query = mysqli_query($conn, "SELECT post_id, post_title, post_description FROM post WHERE post_userid=$usrid");
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $postId = $row['post_id'];
    $query = mysqli_query($conn, "SELECT product_price FROM product WHERE product_postid=$postId");
    $rowPro = mysqli_fetch_array($query, MYSQLI_ASSOC);
    echo"Validated! The post that is beeing edited is: ".$row['post_title']."";
    echo'
    <div id ="editForm">
        <form method="post">
            <input type="text" name="updateTitle" value="newTitle" placeholder="newTitle"/>
            <input type="text" name="updateDscription" value="newDescription" placeholder="newDescription"/>
            <input type="text" name="updatePrice" value="newPrice" placeholder="newPrice"/>
            <input type="submit" name="submitEdit" value="submitEdit"/>   
         </form>
         <br>Current Title: '.$row['post_title'].'<br>Current Description: '.$row['post_description'].'<br>Current Price: '.$rowPro['product_price'].'kr
    </div>
    ';

}
else{
    header('Location: ../index.php');
}




?>