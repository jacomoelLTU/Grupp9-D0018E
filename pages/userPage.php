<link rel="stylesheet" type="text/css" href="../CSS/userPage.css">
<body>
    Click to go to <a href="../index.php">homepage</a>! 
    <div id="profileContainer">
        <img class="profilePicture" src="../pictures/profilePictureTemplate.jpg">
        <p>
        This is <?php session_start(); echo$_SESSION['username']." Med id: ".$_SESSION['userid'];?>'s page. 
        </p>
        <div id="postContainer">
            <?php include '../functions/userPosts.php'; ?>
        </div>
    </div>
</body>