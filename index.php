<!DOCTYPE html>
    <html>
    <?php include 'config.php'; ?>

        <body>
            <link rel="stylesheet" type="text/css" href="header.css">
            <div id="header">
                <ul id="menu">
                    <li><a href="#">Alternativ1</a></li> <!-- Fixa sådana att samma sida updaterar sitt content ist för att laddda helt ny fil. -->
                    <li><a href="#">Alternativ2</a></li>
                    <li><a href="#">Alternativ3</a></li>
                </ul>
            </div>
            <?php include 'posts.php'; ?> <!-- Döljer innehållet, bra för säkerhet -->
        </body>
</html>