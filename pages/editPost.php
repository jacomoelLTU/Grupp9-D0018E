<?php
/*   ---------------  Functions  --------------- */
function autorization($conn){
    session_start();
    $validated = false;
    if($usrid = $_SESSION['userid']){
        $row = mysqli_query($conn, "SELECT post_id FROM post WHERE post_userid=$usrid");
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
    echo"Validated!";
}




?>