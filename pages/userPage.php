<link rel="stylesheet" type="text/css" href="../CSS/userPage.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<body>
<?php
include '../functions/config.php';
session_start();
$userId = $_SESSION['userid'];
$userRating = mysqli_query($conn, "SELECT user_rating FROM user WHERE user_id=$userId;");
$row = mysqli_fetch_array($userRating, MYSQLI_ASSOC);
?>
    Click to go to <a href="../index.php"><i class="bi bi-house-door"></i></a>! 
    <div id="profileContainer">
        <img class="profilePicture" src="../pictures/profilePictureTemplate.jpg">
        <p>
        Hi <?php echo$_SESSION['username']."! This is your page. Your user id is: ".$_SESSION['userid']." and your average product rating is: ".$row['user_rating'];?>.
        </p>
        <center>
            <div id="postContainer">
                <?php include '../functions/userPosts.php'; ?>
            </div>
        </center>
    </div>
</body>