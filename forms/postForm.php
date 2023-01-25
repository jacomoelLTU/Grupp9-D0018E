<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/posts.css">
<?php include 'functions/config.php'; ?>

<h1>Make a Post</h1>

<body>
    <div id="postForm">
        <!-- Form for post -->
        <!-- Text Fields -->
        <form action="../functions/posts.php" method="post">
            Title: <input type="text" name="post_title"><br> 
            Description: <textarea rows = "5" cols = "60" name = "post_description" placeholder="Enter description here..."></textarea><br>
            Price: <input type="text" name="post_price"><br>
            <input type="submit" class = "post-button" name = "Submit" value="Upload Post" /><br>
        </form>

        <!-- Image -->
        <form action="../functions/upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="post_img" id="post_img">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
    </body>
</html>