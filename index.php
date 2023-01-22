<!DOCTYPE html>
    <html>
        <body>
                <?php 
                echo "Här under borde det dyka upp ett namn:\n";
            
                include 'config.php';
                $query = 'SELECT * FROM user';
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "\n". $row['user_name'];
                    }
                }
                else{
                    echo "Tablet är tomt.";
                }
                ?>

            

        </body>
</html>