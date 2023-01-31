<?php 
include '../functions/config';
if(isset($_SESSION['loggedin'])){
    echo"<a href='../functions/logout.php'>Logout</a>";
}
elseif(!isset($_SESSION['loggedin'])){
    echo"Click here to <a href='../forms/loginForm.php'>Login</a>";
}
?>