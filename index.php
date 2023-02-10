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
                    Click here to <a href="../pages/printimage.php">view image</a>!
                    Click here for <a href="../pages/examplepost.php">post example</a>!
                    </p>

                </div>
                <center>Här är middle!</center>
            </div>

        
        <div  id = "cartIcon">
            <a href = "pages/cartpage.php"><img src = "pictures/cartIcon.png" width="40" height="40"/></a>
                <p> <?php 'cart items var'?> <p>
        </div>
            
        
        </body>
    </html>