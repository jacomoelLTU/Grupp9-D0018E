<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php'; ?>
        
        <head> 
        <meta charset="UTF-8">
        </head>

        <body>
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
                <ul id="menu">
                <?php include 'JS/loginButton.js'?>
                <div class="wrapper">
                    <button type="button" id="btn-1" class="ripple">button</button>
                    <button type="button" id="btn-2" class="ripple" data-ripple-color="#888">button</button>
                    <div class="ripple" style="width: 300px; height: 100px; background: #ddd;"></div>
                    <div class="ripple" style="width: 100px; height: 300px; background: #ddd;"></div>
                </div>
                </ul>
                <ul id="login">
                    <p><a href="forms/loginForm.php">Log in</a></p>
                    <?php 
                        session_start();
                        if(isset($_SESSION['loggedin'])){
                            echo"Inloggad som:". $_SESSION['username'];
                        } 
                    ?>
                    <p><a href="../forms/signUpForm.html">Sign Up</a></p>
                    <p><a href="../forms/postForm.php">Make a post!</a></p>
                </ul>
            </div>
            <link rel="stylesheet" type="text/css" href="CSS/middle.css">
            <div id="middle">
                <?php include 'functions/posts.php'; ?> <!-- Döljer innehållet, bra för säkerhet -->
            </div>
        </body>
    </html>