<link rel="stylesheet" type="text/css" href="../CSS/userPage.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<body>

    Click to go to <a href="../index.php"><i class="bi bi-house-door"></i></a>! 
    <div id="profileContainer">
        <img class="profilePicture" src="../pictures/profilePictureTemplate.jpg">
        <p>
        This is <?php session_start(); echo$_SESSION['username']." Med id: ".$_SESSION['userid'];?>'s page. 
        </p>
        <center>
            <div id="postContainer">
                <?php include '../functions/userPosts.php'; ?>
            </div>
        </center>
    </div>
</body>