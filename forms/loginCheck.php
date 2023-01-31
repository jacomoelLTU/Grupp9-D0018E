<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../functions/config';
session_start();
if(isset($_SESSION['loggedin'])){
    echo"Logged in as: ".$_SESSION['username'].", Click here to <a href='../functions/logout.php'>Logout</a>";
}
if(!isset($_SESSION['loggedin'])){
    echo"Click here to <a href='../forms/loginForm.php'>Login</a>";
}
?>