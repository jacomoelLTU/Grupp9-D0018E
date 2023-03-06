<?php 
    include 'config.php';
    
    //First we need to check that all values of the form is given.
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        echo"Missing credentials...";
    }
    else{
        $usrn = $_POST['username'];
        $pwd  = $_POST['password'];

        $stmt = $conn->prepare("SELECT user_pwd from user where user_name = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $pwdHash = mysqli_stmt_get_result($stmt);

        $query = mysqli_query($conn,"SELECT user_name, user_pwd, user_id FROM user WHERE user_name='$usrn'");

        while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
            if(password_verify($pwd, $pwdHash)){
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
    header('Location:../index.php');

?>
