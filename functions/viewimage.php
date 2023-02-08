<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
$query = "SELECT post_title, post_img FROM post ORDER BY post_id DESC";
$result = mysqli_query($conn, $query);
?>

<?php
    while($record = mysqli_fetch_assoc($result))
    {
    echo "this is typing";
    echo '<h1>'.$record['post_title'].'</h1>';
    echo '<h2>'.$record['post_img'].'</h2>';
    } 
?>

