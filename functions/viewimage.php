
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';

$result = $conn->query("SELECT post_img FROM post ORDER BY post_userid DESC"); 
?>

<div class="gallery"> 
    <?php while($row = $result->fetch_assoc()){ ?> 
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['post_img']); ?>" /> 
    <?php } ?> 
</div> 
