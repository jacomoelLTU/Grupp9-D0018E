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
                    <input type='hidden' name='obj' value=".$r.">
                </form>
              </div><br>";   
    }
    if(array_key_exists('delObj', $_POST)) {
        delObj();
    }

    //Functions ----------
    
    function delObj() {
        session_start();
        $i = array_search($_POST['obj'], $_SESSION['objArr']);
        echo "This id where deleted: ". $i;
        if($_SESSION['objArr'][$i] == $_POST['obj']){            
            unset($_SESSION['objArr'][$i]);
        }
    
    }
?>