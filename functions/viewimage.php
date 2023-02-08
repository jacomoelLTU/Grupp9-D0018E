<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
$query = "SELECT post_img FROM post ORDER BY post_userid DESC";
$titlequery = "SELECT post_title FROM post ORDER BY post_userid DESC";
$titleresult = mysqli_query($conn, $titlequery);
$result = mysqli_query($conn, $query);
?>

<?php
    while($row = mysqli_fetch_assoc($result))
    {
    echo "this is typing";
    echo '<h2>'.$row['post_img'].'</h2>';
    echo '<h3>'.$row['post_title'].'</h3>'; 
    } 
?>

