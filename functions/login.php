<?php 
    include 'config.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    //First we need to check that all values of the form is given.
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        echo"Missing credentials...";
    }
    else{
        $usrn = $_POST['username'];
        $pwd  = $_POST['password'];

        $stmt = $conn->prepare("SELECT user_pwd from user where user_name = ?");
        $stmt->bind_param('s', $usrn);
        $stmt->execute();
        $pwdHash = mysqli_stmt_get_result($stmt);
        $r = mysqli_fetch_array($pwdHash, MYSQLI_ASSOC);

        $query = mysqli_query($conn,"SELECT user_name, user_pwd, user_id FROM user WHERE user_name='$usrn'");

        while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
            if(password_verify($pwd, $r['user_pwd'])){
                $usrn_db   = $row['user_name'];
                $pwd_db    = $row['user_pwd'];
                $usrid_db = $row['user_id'];

                session_start();
                $_SESSION['username'] = $usrn_db;
                $_SESSION['userid']   = $usrid_db;
                $_SESSION['loggedin'] = true;

                header('Location:../index.php');
            }
            else{
                  header('Location:../pages/signupForm.php');

            }
        }
    }
?>
