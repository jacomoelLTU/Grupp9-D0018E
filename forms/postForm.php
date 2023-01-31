<?php 
include '../functions/config.php';
include '../functions/upload.php'; 
?>

<h1>Make a Post</h1>

<link rel="stylesheet" type="text/css" href="../CSS/posts.css">
<div id="posts">

    <!-- Form for post -->
    <!-- Text Fields -->
    <form action="../functions/posts.php" method="post">
        Title: <input type="text" name="post_title" placeholder="Enter title"><br> 
        Description: <br><textarea rows = "5" cols = "60" name = "post_description" placeholder="Enter description here..."></textarea><br>
        Price: <input type="text" name="post_price" placeholder="Enter price"><br>
        <input type="submit" class = "post_button" name = "Submit" value="Upload Post"/><br>
        <!-- Image -->
        <form action="../functions/upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="post_img" id="post_img">
        </form>

        <!-- Upload Button -->
        
    </form>   
</div>
