Click to go to <a href="../index.php">homepage</a>! 
<div id="profileContainer">
    <img style="width:100px; height:100px;" src="../pictures/profilePictureTemplate.jpg">
    <p>
    This is <?php session_start(); echo$_SESSION['username'];?>'s page. 
    </p>
</div>
<?php
$months= array(
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December" );
if($_POST['submit'] === 'Show Posts'){
    foreach ($months as $month) {
        echo $month . "<br>"; 
     }
    }
?>
<input type="submit" name="showposts", value="Show Posts">
