<link rel="stylesheet" type="text/css" href="../CSS/printImage.css">
<div id="printImage">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include '../functions/config.php';
    $query = "SELECT post_title, post_img FROM post ORDER BY post_id DESC";
    $result = mysqli_query($conn, $query);

    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
        //if post_img has value
        if (isset($row['post_img'])) {

            //get url from post_img
            $url = "$row[post_img]";

            //get content from the url and encode so we can see the image
            $image = base64_encode(file_get_contents($url));

            //print title and image
            echo $row['post_title'];
            echo '<img src="data:image/jpeg;base64,'.$image.'">';
        }
    }
    ?>
</div>
