<!DOCTYPE html>
    <html>
        <body>
                <?php 
                echo "hejhejhej";
                ?>
            
                <?php
            
                include 'config.php';
                $sql = "SELECT * FROM dummy WHERE name='Adam'";
                $result = $conn->query($sql);
                echo $result;
                ?>

            

        </body>
</html>