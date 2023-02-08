<?php
include 'config.php';

$statusmsg = "";
//if upload button is pressed
if (isset($_POST['upload'])) {
    // the path to store the uploaded image
    $target_dir = "../uploads/";
    $filename = basename($_FILES["file"]["name"]);
    $target_path = $target_dir . $filename;
    $filetype = pathinfo($target_path, PATHINFO_EXTENSION);

    $allowtypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    if (in_array($filetype, $allowtypes)) {
        $sql = "INSERT INTO post (post_img) VALUES ('$filename)";
        mysqli_query($conn, $sql);

        //move uploaded image to the folder
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)) {
            $statusmsg = "Image uploaded successfully";
        }
    }
}
?>