<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php';?>
     <head> 
        <meta charset="UTF-8">
        
    </head>    
        <body>
            <link rel="stylesheet" type="text/css" href="CSS/index.css">
            <div id="header">

            </div><!--header ends-->

                <div id = "parentDiv">
    
                    <!-- the login check emiwik did, left child -->
                    <?php 
                    include 'pages/loginCheck.php';
                    ?>
                    
                    <div id = "midChild">
                        <p> Click here to <a href="../pages/signUpForm.php" >Sign Up!</a></p>
                    </div>

                    <div id = "rightChild">
                        <a id = "cartIconLink" href = "pages/cartpage.php"><img src = "pictures/cartIcon.png" width="40" height="40"/></a>
                        <p> <?php echo 'cart items var'?> <p>
                    </div>

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
                    
        </body>
    </html>