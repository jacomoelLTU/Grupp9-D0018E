    <?php
    include 'config.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
        //stripslashes removes backslashes, some protection agains injection i guess
        $userName = $_POST['userName'];
        $passWord = $_POST['passWord'];
        $userEmailAdress = $_POST['userEmailAdress'];
        $userFirstName = $_POST['userFirstname'];
        $userSurName = $_POST['userSurname'];

        // https://onlinephp.io/password-hash/examples , follow for modification documentation of $options
        $options = ['cost' => 12,]; 

        $passWord = password_hash("$passWord", PASSWORD_BCRYPT, $options);

        if(!(isset($userName) || isset($passWord) || isset($userEmailAdress) || isset($userFirstName) || isset($userSurName))){
                echo 'To register you need to provide information for all the fields in the registrationform!';
        }


        //prepare statement for user credential check
        $stmt_check = $conn->prepare("SELECT user_name, user_email from user WHERE user_name = ? OR user_email = ?");
        $stmt_check->bind_param('ss', $userName, $userEmailAdress);
        $stmt_check->execute();
        $check_result = mysqli_stmt_get_result($stmt_check);


        if(mysqli_num_rows($check_result) > 0){
            echo 'Username or Email address is already in use, please try with other credentials!';
        }
        else{

            mysqli_query($conn, "LOCK TABLES product WRITE, user WRITE");
            //insert prepared statement
            $stmt_UserCredinsert = $conn->prepare("INSERT into user (user_name, user_pwd, user_firstname, user_surname, user_email)
                                    VALUES (?, ?, ?, ?, ?)");
            $stmt_UserCredinsert->bind_param('sssss', $userName, $passWord, $userFirstName, $userSurName, $userEmailAdress);
            $stmt_UserCredinsert->execute();
            mysqli_query($conn, "UNLOCK TABLES");


            header('Location:../pages/loginForm.php?msg'); 
        }
    
        ?>