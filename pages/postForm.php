<?php 
include '../functions/config.php';
include '../functions/upload.php';
?>

Click to go to <a href="../index.php">homepage</a>! 
<body>
    <h1>Make a Post</h1>

    <link rel="stylesheet" type="text/css" href="../CSS/posts.css">
    <div class="posts">
        
        <!-- Text Fields -->
        <form action="../functions/posts.php" method="post">
            <p id="title"> Title <input type="text" name="post_title" placeholder="Enter title" required></p> 
            <p id="description"> Description <br><textarea rows = "5" cols = "40" name = "post_description" placeholder="Enter description here..." required></textarea></p>
            <p id="price"> Quantity <input type="text" name="product_quantity" placeholder="Enter quantity" required></p> 
            <p id="price"> Price <input type="text" name="product_price" placeholder="Enter price" required></p> 
            
            <!-- Images -->
            <div id="images"><form action="../functions/upload.php" method="post" enctype="multipart/form-data">
                Select image to upload
                <input type="file" name="post_img" id="post_img">
                <input type="submit" class = "post_button" name = "upload" value="Upload Post"/><br>
            </form>
        </div>
        </form>  
    </div>  
</body>
