<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php'; ?>

        <body>
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
            <?php include 'forms/loginForm.html'?>
                <ul id="menu">
                    <li><a href="#">Alternativ1</a></li> <!-- Fixa sådana att samma sida updaterar sitt content ist för att laddda helt ny fil. -->
                    <li><a href="#">Alternativ2</a></li>
                    <li><a href="#">Alternativ3</a></li>
                    <li><a href="#">Alternativ4</a></li>
                </ul>
                <ul id="login">
<<<<<<< HEAD
                    <p><a href="#">Log in</a></p>
                    <p><a href="/functions/signup.php">Sign Up</a></p>
=======
                    <li><a href="#">Log in</a></li>
                    <li><a href="#">Sign Up</a></li>
>>>>>>> c64f0f783ec6dd064f6b31d4d14a1f66d573db0b
                </ul>
            </div>
            <div id="middle">
                <link rel="stylesheet" type="text/css" href="CSS/middle.css">
                <?php include 'functions/posts.php'; ?> <!-- Döljer innehållet, bra för säkerhet -->
            </div>
            <?php if(isset($_SESSION['logedin'])){echo"Inloggad som:". $_SESSION['username'];} ?>
            
        </body>
    </html>