<!DOCTYPE html>
    <html>
    <?php include 'functions/config.php'; ?>

        <body>
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="header">
                <ul id="menu">
                    <li><a href="#">Alternativ1</a></li> <!-- Fixa sådana att samma sida updaterar sitt content ist för att laddda helt ny fil. -->
                    <li><a href="#">Alternativ2</a></li>
                    <li><a href="#">Alternativ3</a></li>
                    <li><a href="#">Alternativ4</a></li>
                </ul>
                <ul id="login">
                    <p><a href="#">Log in</a></p>
                    <p><a href="/functions/signup.php">Sign Up</a></p>
                </ul>
            </div>
            <div id="middle">
                <link rel="stylesheet" type="text/css" href="CSS/middle.css">
                <?php include 'functions/posts.php'; ?> <!-- Döljer innehållet, bra för säkerhet -->
            </div>
        </body>
    </html>