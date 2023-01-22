<!DOCTYPE html>
    <html>
        <body>
                <?php 
                echo "Här under borde det dyka upp ett namn:\n";
            
                include 'config.php';
                $query = $sql('SELECT * FROM user');
                $result = $query->fetchAll();
                foreach($result as $r){
                    echo $r['user_id']; #Det vill inte printas ut... här de blir fel

                }
                ?>

            

        </body>
</html>