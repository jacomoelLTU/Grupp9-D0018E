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
        
        $stmt = $conn->prepare("SELECT user_name, user_pwd FROM user WHERE user_name='$usrn' AND user_pwd='$pwd'");
        $stmt->bind_param("ss", $usrn, $pwd); //bind_param("S-tringS-tring, $var1, $var2  ")
        $stmt->execute();
        printf("Error: %s.\n", mysqli_stmt_error($stmt));
        echo $usrn." with pwd:".$pwd;
    }

    header('../index.php');
?>
