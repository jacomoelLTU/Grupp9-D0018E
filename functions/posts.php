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

<!-- POST action to mysql -->
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //get values from input
    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $post_price = $_POST['post_price'];
    $post_img = $_POST['post_img']; 

    //get user id from db (to +1 )
    $post_userid = "SELECT post_userid FROM post";
    $post_userid_result = $conn->query($post_userid);

    //query
    $sql = "INSERT INTO `post` (`post_userid`, `post_title`, `post_description`, `post_price`, `post_img`) VALUES ('$post_userid_result+1', '$post_title', '$post_description', '$post_price', '$post_img')";

    //insert in mysql
    $rs = mysqli_query($conn, $sql);
}
?>