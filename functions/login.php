<?php 
    include 'config.php';
    //First we need to check that all values of the form is given.
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        echo"Missing credentials...";
    }
    else{
        $usrn = $_POST['username'];
        $pwd  = $_POST['password'];
        
        $query = "SELECT * FROM user WHERE user_name=$usrn and 'user_pwd'=$pwd";
        $stmt = $conn->query($query);
        echo $usrn." with pwd:".$pwd;
    }

    header('../index.php');
?>
