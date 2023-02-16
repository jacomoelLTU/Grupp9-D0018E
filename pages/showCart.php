<?php
session_start();
echo"Here is you items:";


    foreach($_SESSION['objArr'] as $r){
        $dataArr   = parse_str($r, $output);
        $postId    = $output['postId'];
        $postTitle = $output['postTitle']; 
        
        echo "<div id='cartItem'>".$r.
                "<form method='post'>
                    <input type='submit' name='delObj' class='button' value='Del Item'/>
                </form>
              </div><br>";
        
        if(array_key_exists('delObj', $_POST)) {
            delObj($postId);
        }
    }

    //Functions ----------
    
    function delObj($p) {
        session_start();
        echo $p;
        $i = array_search($p, $_SESSION['objArr']);
        echo$i;
        if($_SESSION['objArr']($i) == $p){
            echo "Deleted id: ".$i."where postId: ".$p;
        }
    
    }
?>