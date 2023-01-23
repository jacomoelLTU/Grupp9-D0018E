<!DOCTYPE html>
    <html>
        <body>
            <link rel="stylesheet" type="text/css" href="header.css">
            <div id="header">
                <ul id="menu">
                    <li><a href="admin.php">Admin page</a></li>
                    <li>Alternativ2</li>
                    <li>Alternativ3</li>
                </ul>
            </div>
            <?php 
            echo "Här under borde det dyka upp ett namn:\n";
        
            include 'config.php';
            $query = 'SELECT * FROM user';
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "\n Printar en row: |".$row['user_id'].
                                            "|".$row['user_name'].
                                            "|".$row['user_firstname'].
                                            "|".$row['user_surname'].
                                            "|".$row['user_email'].
                                            "|";
                }
            }
            else{
                echo "Tablet är tomt.";
            }
            ?>
        </body>
</html>