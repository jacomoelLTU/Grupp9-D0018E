<!-- DELETE POST action to mysql -->

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'config.php';

$postId = $_POST['post_id'];
$query = mysqli_query($conn,"DELETE FROM post WHERE post_id='$postId'");

?>