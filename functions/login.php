<?php 
include 'config.php';
echo"test";

// //This checks that the method we are using realy are POST. Good security thing.
// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     //Use the $_REQUEST to save form data that has been submitet. 
//     $usrn = $_REQUEST['username'];
//     //For now we use pwd in clear text, need to implement hashed pwd!
//     $pwd  = $_REQUEST['password'];
    
//     $query->prepare("SELECT user_name, user_pwd FROM user WHERE user_name=:username");
//     $query->bindvalue('user_name', $usrn_db);
//     $query->bindvalue('user_pwd', $pwd_db);
//     if($usrn_db == $usrn && $pwd == $pwd_db){ //For now we use pwd in clear text, need to implement hashed pwd!
//         session_start();
//         $_SESSION['username'] = $usrn_db;
//         $_SESSION['logedin']  = true;
        
//     }
//     else{
//         echo"Username or password is wrong...";
//     }
// }
// else{
//     echo"Catched an error...";
// }
?>
