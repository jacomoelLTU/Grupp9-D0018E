<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php';?>
     <head> 
        <meta charset="UTF-8">
    </head>    
        <body>
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
                <?php 
                include 'pages/loginCheck.php';
                ?>
                <ul id="login"> 
                    <p>
                    Click here to <a href="../pages/signUpForm.php" >Sign Up</a>!
                    </p>
                </ul>
            </div>


            <link rel="stylesheet" type="text/css" href="CSS/middle.css">
            <div id="middle">
                <div id="form-main-content">
                    <p>
                    Click here to <a href="../pages/postForm.php">Make a post</a>!
                    </p>
                </div>
                <center>Här är middle!</center>
            </div>
            
        
        </body>
    </html>