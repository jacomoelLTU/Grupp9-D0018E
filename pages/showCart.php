<?php
session_start();
echo"Here is you items:";
$delCount = 0;

    foreach($_SESSION['objArr'] as $r){
        $dataArr   = parse_str($r, $output);
        $postId    = $output['postId'];
        $postTitle = $output['postTitle']; 
        
        echo "<div id='cartItem'>".$r.
                "<form method='post'>
                    <input type='submit' name='delObj' class='button' value='Del Item'/>
                </form>
              </div><br>";   
    }
    if(array_key_exists('delObj', $_POST) && $delCount == 0) {
        $delCount .=1;
        delObj($r, $postId);
    }

    //Functions ----------
    
    function delObj($r, $p) {
        session_start();
        $i = array_search($r, $_SESSION['objArr']);
        echo "This id where deleted: ".$i;
        if($_SESSION['objArr'][$i] == $r){            
            unset($_SESSION['objArr'][$i]);
        }
    
    }
?>