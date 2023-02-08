<?php 
session_start();
if(!isset($_SESSION['loggedin'])){
    echo"Click here to <a href='../forms/loginForm.php'>Login</a>";
}
else{
   echo" 
    <div id='userpage'>
    Logged in as: ".$_SESSION['username'].", 
        <div id='clickable'>
            Click for <a href = '../forms/userpage.php' alt=''>Profile</a>
            and here to <a href='../functions/logout.php'>Logout</a>
        </div>
    </div>";
}
?>