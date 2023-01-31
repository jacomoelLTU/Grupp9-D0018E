<?php 
include '../functions/config';
session_start();
if(isset($_SESSION['loggedin'])){
    echo"<a href='../functions/logout.php'>Logout</a>";
}
elseif(!isset($_SESSION['inloggad'])){
    echo"Click here to <a href='../functions/login.php'>Login</a>";
}
?>