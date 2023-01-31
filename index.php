<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php';?>
     <head> 
        <meta charset="UTF-8">
    </head>    
        <body>
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
                <?php session_start(); if(isset($_SESSION['loggedin'])){echo'<nav id="userpage">Click for <a href ="forms/userpage.php" alt="">Profile</a>';}?>
                <ul id="login"> 
                    <p>
                    <?php include 'forms/loginCheck.php';?>
                    Click here to <a href="../forms/signUpForm.html" >Sign Up</a>!
                    </p>
                </ul>
                <div id="form-main-content">
                    <p>
                    Click here to <a href="../forms/postForm.php">Make a post</a>!
                    </p>
                </div>
            </div>


            <link rel="stylesheet" type="text/css" href="CSS/middle.css">
            <div id="middle">
                <center>Här är middle!</center>
            </div>
            
        
        </body>
    </html>