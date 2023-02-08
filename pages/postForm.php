<?php 
include '../functions/config.php';
include '../functions/upload.php';
//include '../functions/viewimage.php';
 
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//include 'config.php';
$query = "SELECT post_title, post_img FROM post ORDER BY post_id DESC";
$result = mysqli_query($conn, $query);
?>

<?php
    while($record = mysqli_fetch_assoc($result))
    {
    echo "this is typing";
    echo '<h2>'.$record['post_title'].'</h1>';
    echo '<img src="post/>'.$record['post_img'].'"</img>';
    } 
?>



Click to go to <a href="../index.php">homepage</a>! 
<body>
    <h1>Make a Post</h1>

    <link rel="stylesheet" type="text/css" href="../CSS/posts.css">
    <div class="posts">
        
        </form>
        
        <!-- Text Fields -->
        <form action="../functions/posts.php" method="post">
            <p id="title"> Title <input type="text" name="post_title" placeholder="Enter title" required></p> 
            <p id="description"> Description <br><textarea rows = "5" cols = "40" name = "post_description" placeholder="Enter description here..." required></textarea></p>
            <p id="price"> Quantity <input type="text" name="product_quantity" placeholder="Enter quantity" required></p> 
            <p id="price"> Price <input type="text" name="product_price" placeholder="Enter price" required></p> 
            <input type="submit" class = "post_button" name = "Submit" value="Upload Post"/><br>
            
            <!-- Images -->
            <div id="images"><form action="../functions/upload.php" method="post" enctype="multipart/form-data">
                Select image to upload
                <input type="file" name="post_img" id="post_img">
            </form>
            Preview of your post <br>
            <div id="preview">Your images should be here</div>
        </div>
        </form>   
    </div>  
</body>
