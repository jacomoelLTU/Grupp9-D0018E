<?php 
    ini_set('display_errors', 1); 
    error_reporting(-1);
    include 'config.php';
    //First we need to check that all values of the form is given.
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        echo"Missing credentials...";
    }
    else{
        $usrn = $_POST['username'];
        $pwd  = $_POST['password'];
        
        $query = mysqli_query($conn,"SELECT user_name, user_pwd FROM user WHERE user_name='$usrn' AND user_pwd='$pwd'");
        while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
            if(($row['user_name'] == $usrn) && ($row['user_pwd'] == $pwd)){
                $usrn    = $row['user_name'];
                $pwd_db  = $row['user_pwd'];
                
                session_start();
                $_SESSION['username'] = $usrn_db;
                $_SESSION['username'] = $pwd_db;
            
            }
        }
    }

    header('../index.php');
?>
