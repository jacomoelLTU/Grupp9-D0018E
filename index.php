<!DOCTYPE html>
    <html>
        <body>

            <h1>
                <?php
                include 'config.php';
                $namn = 'SELECT * FROM dummy WHERE name="Adam"';
                echo $namn;
                ?>

            </h1>

        </body>
</html>