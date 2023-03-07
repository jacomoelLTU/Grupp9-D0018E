<link rel="stylesheet" type="text/css" href="../CSS/userPage.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<body>
<?php
session_start();
$userId = $_SESSION['userid'];
$userRating = mysqli_query($conn, "SELECT user_rating FROM user WHERE user_id=$userId;");
$row = mysqli_fetch_array($userRating, MYSQLI_ASSOC);
?>
    Click to go to <a href="../index.php"><i class="bi bi-house-door"></i></a>! 
    <div id="profileContainer">
        <img class="profilePicture" src="../pictures/profilePictureTemplate.jpg">
        <p>
        This is <?php echo$_SESSION['username']." Med id: ".$_SESSION['userid']." Med rating: ".$row['user_rating'];?>'s page. 
        </p>
        <center>
            <div id="postContainer">
                <?php include '../functions/userPosts.php'; ?>
            </div>
        </center>
    </div>
</body>