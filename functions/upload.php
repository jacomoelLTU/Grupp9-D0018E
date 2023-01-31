<?php
// $target_dir = "uploads/";
$target_file = basename($_FILES["post_img"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    $check = getimagesize($_FILES["post_img"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;

        //
        $image = $_FILES["post_img"]["tmp_name"]; 
        $imgContent = addslashes(file_get_contents($image)); 
         
        // Insert image content into database 
        $insert = $conn->query("INSERT into post (post_img) VALUES ('$imgContent', NOW())");
        //

    } else {
        echo "File is not an image.";
        $uploadOk = 0;
  }
}
?>