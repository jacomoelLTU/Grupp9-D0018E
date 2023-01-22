<!DOCTYPE html>
    <html>
        <body>
                <?php 
                echo "Här under borde det dyka upp ett namn [Adam]\n";
                ?>
            
                <?php
            
                include 'config.php';
                $sql = "SELECT * FROM dummy WHERE name='Adam'";
                $result = $conn->query($sql);
                echo $result;
                ?>

            

        </body>
</html>