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
                <script src="JS/loginButton.js"></script>
                <div class="wrapper">
                    <button type="button" id="btn-1" class="ripple">button</button>
                    <div class="ripple" style="width: 300px; height: 100px; background: #ddd;"></div>
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