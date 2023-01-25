<div id="postForm">
    <!-- Form for post -->
    <!-- Text Fields -->
    <form action="../functions/posts.php" method="post">
        Title: <input type="text" name="post_title">
        Description: <input type="text" name="post_description">
        Price: <input type="text" name="post_price">
        <input type="submit" class = "post-button" name = "Submit" value="Post" />
    </form>
    
    <!-- Image -->
    <form action="../functions/upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="post_img" id="post_img">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>