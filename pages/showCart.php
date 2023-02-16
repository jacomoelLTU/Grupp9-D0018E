<?php
session_start();
echo"Here is you items:";


    foreach($_SESSION['objArr'] as $r){
        $dataArr   = parse_str($r, $output);
        $postId    = $output['postId'];
        $postTitle = $output['postTitle']; 
        
        echo "<div id='cartItem'>".$r." ID of post: ".$postId.
                "<form method='post'>
                    <input type='submit' name='delObj' class='button' value='Del Item'/>
                </form>
              </div><br>";   
    }
    if(array_key_exists('delObj', $_POST)) {
        delObj($r, $postId);
    }

    //Functions ----------
    
    function delObj($r, $p) {
        session_start();
        $i = array_search($r, $_SESSION['objArr']);
        unset($_SESSION['objArr'][$i]);
        header("Location:cartpage.php");
    }   
?>