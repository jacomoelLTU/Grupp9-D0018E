<link rel="stylesheet" type="text/css" href="../CSS/userPage.css">
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
<button type="submit" class="btn btn-secondary"><span class="fa fa-search"></span> Search</button>
    Click to go to <a href="../index.php">homepage</a>! 
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