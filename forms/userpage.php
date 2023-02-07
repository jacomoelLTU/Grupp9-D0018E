Click to go to <a href="../index.php">homepage</a>! 
<div id="profileContainer">
    <img style="width:100px; height:100px;" src="../pictures/profilePictureTemplate.jpg">
    <p>
    This is <?php session_start(); echo$_SESSION['username'];?>'s page. 
    </p>
</div>
<?php
if($_POST['submit'] === 'Submit'){
    echo"Print some links:";
    include 'userPosts.php';
    }
?>
<form method="post">
    <input type="submit" name="submit", value="Submit">
</form>