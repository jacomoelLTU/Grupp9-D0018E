<!DOCTYPE html>
    <html>
        <body>
                <?php 
                echo "Här under borde det dyka upp ett namn [Adam]\n";
                ?>
            
                <?php
            
                include 'config.php';
                $sql = "SELECT * FROM dummy";
                $result = $mysqli_query->query($conn, $sql);
                $resultControll = mysqli_num_rows($result);
                if($resultControll > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo $row['name'];
                    }
                }
                ?>

            

        </body>
</html>