<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php';?>
     <head> 
        <meta charset="UTF-8">
        
    </head>    
        <body>
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

            <div id="header">
                <?php 
                include 'pages/loginCheck.php';
                ?>
                <ul id="login"> 
                    Click here to <a href="../pages/signUpForm.php" >Sign Up</a>!
                    
                    <link rel="stylesheet" type="text/css" href="CSS/middle.css">
                    <div id = "cartIcon">
                        <!-- Added php so that it can change the url to current cartURL session -->
                        <?php
                            session_start();
                            echo '<a id = "cartIconLink" href = "pages/cartPage.php'.$_SESSION["cartURL"].'"><img src = "pictures/cartIcon.png" width="40" height="40"/></a>';
                        ?>
                        <?php 
                        $userId = $_SESSION['userid'] ?? NULL;
                        if($userid == NULL){
                            echo "";
                        }else{
                            $cartItemAmount = 0;
                            $joinquery = mysqli_query($conn, "SELECT transaction.transaction_id, transaction.transaction_userid, transactionitem.transactionitem_productid FROM transaction INNER JOIN transactionitem ON transaction.transaction_id=transactionitem.transactionitem_transactionid");
                            while($row = mysqli_fetch_array($joinquery, MYSQLI_ASSOC)){
                                if($row['transaction_userid']==$userId){
                                $cartItemAmount += 1;
                                }
                            }
                            echo 'Cart items: '.$cartItemAmount;
                        }
                        
                        ?>       
                    </div> 
                </ul> 

            </div>
         
            <link rel="stylesheet" type="text/css" href="CSS/middle.css">
            <middle>
                <div id="form-main-content">
                    <p>
                    Click here to <a href="../pages/postForm.php">Make a post</a>!
                    <!-- Click here to <a href="../pages/printImage.php">view image</a>! -->
                    </p>

                </div>
                <center><h2 style="color:lightcoral;">Här kommer posts:</h2></center>
                <?php include 'functions/mainPosts.php';?>
             </div>        
        </body>
    </html>