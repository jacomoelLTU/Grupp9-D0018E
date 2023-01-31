<?php 
include '../functions/config';
session_start();
if(isset($_SESSION['loggedin'])){
    echo"Logged in as: ".$_SESSION['username'].", Click here to <a href='../functions/logout.php'>Logout</a>";
}
if(!isset($_SESSION['loggedin'])){
    echo"Click here to <a href='../forms/loginForm.php'>Login</a>";
}
?>