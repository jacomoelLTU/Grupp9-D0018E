<?php
include 'config.php';

$statusmsg = "";
//if upload button is pressed
if (isset($_POST['upload'])) {
    // the path to store the uploaded image
    $target_dir = "";
    
    $filename = basename($_FILES["file"]["name"]);
    $target_path = $target_dir . $filename;
    $filetype = pathinfo($target_path, PATHINFO_EXTENSION);

    $allowtypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    if (in_array($filetype, $allowtypes)) {
        //$sql = "INSERT INTO post (post_img) VALUES ('$filename)";
        //mysqli_query($conn, $sql);

        //move uploaded image
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)) {
            $insert = $conn->query("INSERT into post (post_img) VALUES ('".$fileName."')");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }
    }
}
?>