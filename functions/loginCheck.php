<?php 
    session_start();
    if(isset($_SESSION['loggedin'])){
        echo"Inloggad som:". $_SESSION['username'];
    } 
?>