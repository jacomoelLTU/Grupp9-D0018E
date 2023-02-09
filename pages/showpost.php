<?php
?>
<link rel="stylesheet" type="text/css" href="../CSS/showpost.css">
<a href="../index.php">To home</a>
<center>
<div id="postContainer">
  <div id="grid-item">Post Title:       <?php echo $_GET['postTitle'];       ?></div>
  <div id="grid-item">Post Description: <?php echo $_GET['postDescription']; ?></div>
  <div id="grid-item">Post ...1</div>
  <div id="grid-item">Post ...2</div>
  <div id="grid-item">Post ...3</div>
  <div id="grid-item">Post ...4</div>
  <div id="grid-item">Post ...5</div>
  <div id="grid-item">Post ...6</div>
  <div id="grid-item">Post ...7</div>
</div>
</center>

<?php if (isset($_GET['error'])): ?>
    <p><?php echo $_GET['error']; ?></p>
<?php endif ?>

<form action="../functions/uploadimg.php"
    method="post"
    enctype="multipart/form-data">

    <input type="file" 
            name="my_image">

    <input type="submit" 
            name="submit"
            value="Upload">

</form>
