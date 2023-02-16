<?php
    session_start();
    if(!isset($objArr)){
      $_SESSION['objArr'] = array();
    }
    else{
        array_push($_SESSION['objArr'], $object); //Adds a new object to 'cart'
    }
?>