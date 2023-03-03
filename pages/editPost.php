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

/*   --------------- ^^^^^ Functions ^^^^ --------------- */



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../functions/config.php';

if(autorization($conn)){
    $usrid = $_SESSION['userid'];
    $query = mysqli_query($conn, "SELECT post_title, post_description FROM post WHERE post_userid=$usrid");
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $postId = $row['post_id'];
    $query = mysqli_query($conn, "SELECT product_price FROM product WHERE product_postid=$postId");
    $rowPro = mysqli_fetch_array($query, MYSQLI_ASSOC);
    echo"Validated! The post that is beeing edited is: ".$row['post_title']."";
    echo'
    <div id ="editForm">
        <form action="post">
            <input type="text" name="updateTitle" value="newTitle" placeholder="newTitle"/>
            <input type="text" name="updateDscription" value="newDescription" placeholder="newDescription"/>
            <input type="text" name="updatePrice" value="newPrice" placeholder="newPrice"/>
            <input type="submit" name="submitEdit" value="submitEdit"/>   
         </form>
         Current Title: '.$row['post_title'].' Current Description: '.$row['post_description'].' Current Price: '.$row['post_price'].'
    </div>
    ';

}
else{
    header('Location: ../index.php');
}




?>