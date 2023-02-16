<?php
include '../functions/config.php';
session_start();
echo"Here is you items:";


    foreach($_SESSION['objArr'] as $r){
        $dataArr   = parse_str($r, $output);
        $productId     = $output['productId'];
        $productPrice  = $output['productPrice']; 
        
        echo "<div id='cartItem'>".$r.
                "<form method='post'>
                    <input type='submit' name='delObj' class='button' value='Del Item'/>
                    <input type='hidden' name='obj' value=".$r.">
                </form>
              </div><br>";   
    }
    if(array_key_exists('delObj', $_POST)) {
        delObj($conn);
    }

    //Functions ----------
    
    function delObj($conn) {
        
        session_start();
        $i = array_search($_POST['obj'], $_SESSION['objArr']);
        if($_SESSION['objArr'][$i] == $_POST['obj']){            
            unset($_SESSION['objArr'][$i]);
            mysqli_rollback($conn,1,$_POST['obj']);
        }
    
    }
?>