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

                <link rel="stylesheet" type="text/css" href="CSS/middle.css">
                <div id = "cartIcon">
                    <!-- Added php so that it can change the url to current cartURL session -->
                    <?php
                        session_start();
                        echo '<a id = "cartIconLink" href = "pages/cartpage.php'.$_SESSION["cartURL"].'"><img src = "pictures/cartIcon.png" width="40" height="40"/></a>';
                    ?>
                    <p> <?php echo 'cart items var'?> <p>        
                </div>  
                
            </div>
         
            <link rel="stylesheet" type="text/css" href="CSS/middle.css">
            <middle>
                <div id="form-main-content">
                    <p>
                    Click here to <a href="../pages/postForm.php">Make a post</a>!
                    Click here to <a href="../pages/printimage.php">view image</a>!
                    Click here for <a href="../pages/examplepost.php">post example</a>!
                    </p>

                </div>
                <center<h3 style="color:red;">>Här kommer posts som fan:</h3></center>
                <?php include 'funtions/mainPosts.php';?>
             </div>        
        </body>
    </html>