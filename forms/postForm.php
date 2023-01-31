<?php 
include '../functions/config.php';
include '../functions/upload.php';
include '../functions/viewimage.php';  
?>
<body>
    <h1>Make a Post</h1>

    <link rel="stylesheet" type="text/css" href="../CSS/posts.css">
    <div class="posts">

        <!-- Form for post -->
        <!-- Text Fields -->
        <form action="../functions/posts.php" method="post">
            <p id="title"> Title <input type="text" name="post_title" placeholder="Enter title" required></p> 
            <p id="description"> Description <br><textarea rows = "5" cols = "60" name = "post_description" placeholder="Enter description here..." required></textarea></p>
            <p id="price"> Price <input type="text" name="post_price" placeholder="Enter price" required></p>
            <input type="submit" class = "post_button" name = "Submit" value="Upload Post"/>
            <!-- Images -->
            <div id="images"><form action="../functions/upload.php" method="post" enctype="multipart/form-data">
                Select image to upload
                <input type="file" name="post_img" id="post_img">
            </form>
            <br>Preview of your Post
            <div id="preview">Your images should be here</div>
        </div>
        </form>   
    </div>  
</body>
