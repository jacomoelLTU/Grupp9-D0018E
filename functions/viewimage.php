
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';

$result = $conn->query("SELECT post_image FROM post ORDER BY id DESC"); 
?>

<div class="gallery"> 
    <?php while($row = $result->fetch_assoc()){ ?> 
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['post_image']); ?>" /> 
    <?php } ?> 
</div> 
