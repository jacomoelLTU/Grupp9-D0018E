<?php 
include '../functions/config.php';
// include '../functions/upload.php';
?>

Click to go to <a href="../index.php">homepage</a>! 
<body>
    <h1>Make a Post</h1>
    <link rel="stylesheet" type="text/css" href="../CSS/makeapost.css">
    <div class="posts">
        
        <!-- Text Fields -->
        <form action="../functions/posts.php" method="post">
            <p id="title"> Title <br><input type="text" name="post_title" placeholder="Enter title" required></p> 
            <p id="description"> Description <br><textarea rows = "5" cols = "40" name = "post_description" placeholder="Enter description here..." required></textarea></p>
            <p id="text"> Quantity <br><input type="text" name="product_quantity" placeholder="Enter quantity" required></p> 
            <p id="text"> Price <br><input type="text" name="product_price" placeholder="Enter price" required></p> 
            <p id="text"> Paste URL to image <br><input type="text" name ="post_img" placeholder="Enter URL"></p>
            <select name="post_type" id="post_type">
                <option value="informative">Informative</option>
                <option value="product">Product</option>
            </select><br><br>
            <input type="submit" class = "post_button" name = "upload" value="Upload Post"/><br> 
           
            
            <!-- Images -->
            <!-- <div id="images"><form action="../functions/upload.php" method="post" enctype="multipart/form-data">
                Select image to upload
                <input type="file" name="post_img" id="post_img">-->
                
            </form>
        </div>
        </form>  
    </div>  
</body>
