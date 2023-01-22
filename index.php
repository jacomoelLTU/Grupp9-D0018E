<!DOCTYPE html>
    <html>
        <body>
                <?php 
                echo "Här under borde det dyka upp ett namn [Adam]\n";
                ?>
            
                <?php
            
                include 'config.php';
                $query = $sql->prepare('SELECT * FROM dummy');
                $query->execute();

                $result = $query->fetchAll();
                foreach($result as $r);
                echo $r['name'];
                ?>

            

        </body>
</html>