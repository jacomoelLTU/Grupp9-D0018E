<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php'; include 'functions/loginCheck.php' ?>
        
     <head> 
        <meta charset="UTF-8">
    </head>    
        <body>

            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
                
                <ul id="menu">
                    
                </ul>
                <ul id="login">
                    <p>
                    Click here to <a href="forms/loginForm.php">Log in</a>!
                    Click here to <a href="../forms/signUpForm.html">Sign Up</a>!
                    </p>
                    <div id=""><a href="../forms/postForm.php">Make a post!</a></center>
                </ul>
            </div>


            <link rel="stylesheet" type="text/css" href="CSS/middle.css">
            <div id="middle">
                <?php include 'functions/posts.php'; ?> <!-- Döljer innehållet, bra för säkerhet -->
            </div>
            
        
        </body>
    </html>