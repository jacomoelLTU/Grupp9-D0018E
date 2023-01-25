<?php 
include 'config.php';

// $query = mysqli_query($conn, "SELECT * FROM user");
// while ($row = mysqli_fetch_array($query)) {
//     echo $row['user_name'];
//     }
//This checks that the method we are using realy are POST. Good security thing.
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Use the $_REQUEST to save form data that has been submitet. 
    $usrn = $_REQUEST['username'];
    //For now we use pwd in clear text, need to implement hashed pwd!
    $pwd  = $_REQUEST['password'];
    
    $query = mysqli_prepare($conn, "SELECT user_name, user_pwd FROM user WHERE user_name=:username");
    $query->bind_param($usrn_db, 'user_name', $pwd_db, 'user_pwd');
    if($usrn_db == $usrn && $pwd == $pwd_db){ //For now we use pwd in clear text, need to implement hashed pwd!
        session_start();
        $_SESSION['username'] = $usrn_db;
        $_SESSION['logedin']  = true;
        
    }
    else{
        echo"Username or password is wrong...";
    }
}
else{
    echo"Catched an error...";
}
header('../index.php');
?>
