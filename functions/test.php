<form method="post">
      <input type="submit" name="addObj" class="button" value="Add Item"/>
    </form>
<?php
    if(array_key_exists('addObj', $_POST)) {
        addObj();
    }
  function addObj() {
   echo"clicked the button!!!!!!!!!!!!!!!!";
    // session_start();
    // if(!isset($objArr)){
    //   $_SESSION['objArr'] = array();
    // }
    // echo "Current object".$GLOBALS['object'];
    // array_push($_SESSION['objArr'], $GLOBALS['object']); //Adds a new object to 'cart'
  }
?>