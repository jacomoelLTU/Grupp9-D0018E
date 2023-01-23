<?php 
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