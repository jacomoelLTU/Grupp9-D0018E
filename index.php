<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php'; include 'functions/loginCheck.php' ?>
        
     <head> 
        <meta charset="UTF-8">
    </head>    
        <body>

            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
                <ul id="login"> 
                    <p>
                    Click here to <a href="forms/loginForm.php">Log in</a>!
                    Click here to <a href="../forms/signUpForm.html">Sign Up</a>!
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
                <?php include 'functions/posts.php'; ?> <!-- Döljer innehållet, bra för säkerhet -->
            </div>
            
        
        </body>
    </html>