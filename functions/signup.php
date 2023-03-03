    <?php
    include 'config.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
        //stripslashes removes backslashes, some protection agains injection i guess
        $userName = $_POST['userName'];
        $passWord = bcrypt($_POST['passWord']);
        $userEmailAdress = $_POST['userEmailAdress'];
        $userFirstName = $_POST['userFirstname'];
        $userSurName = $_POST['userSurname'];

        // https://onlinephp.io/password-hash/examples , follow for modification documentation of $options
        $options = ['cost' => 12,]; 

        $password = password_hash("$passWord", PASSWORD_BCRYPT, $options);

        if(!(isset($userName) || isset($passWord) || isset($userEmailAdress) || isset($userFirstName) || isset($userSurName))){
                echo 'To register you need to provide information for all the fields in the registrationform!';
        }

        
            //theese foure lines retrives all userNames and userEmails from the DB, to be used for duplicate check later
            /* $sql_userCheck = "SELECT user_name FROM user WHERE user_name = '$userName'";
                $sql_emailCheck = "SELECT user_email FROM user WHERE user_email = '$userEmailAdress'";
                $res_userCheck = mysqli_query($conn, $sql_userCheck);
                $res_emailCheck = mysqli_query($conn, $sql_emailCheck);
            */
            //commented code above works fine but lack security, below its replaced with prepared statements

        //$conn->autocommit(FALSE);
        $stmt_Ucheck = $conn->prepare("SELECT user_name FROM user WHERE user_name = ?");
        $stmt_Echeck = $conn->prepare("SELECT user_email FROM user WHERE user_email = ?");
        $stmt_Ucheck->bind_param('s', $userName);
        $stmt_Ucheck->bind_param('s', $userEmailAdress);
        $stmt_Ucheck->execute();
        $stmt_Echeck->execute();

        $Ucheck_result = $stmt_Ucheck->get_result();
        $Echeck_result = $stmt_Echeck->get_result();
        //$conn->autocommit(TRUE);

        if($Ucheck_result->mysqli_num_rows() > 0){
            echo 'Unfortunatly the username is already taken.';
        }
        else if ($Echeck_result->mysqli_num_rows() > 0){
            echo 'Emailadress is already beeing used for an existing account.';
        }
        else {


            ///////////// this code works fine but its not secure  ///////////////////////
            // $userName = mysqli_real_escape_string($conn, $userName);
            // $passWord = mysqli_real_escape_string($conn, $passWord);
            // $userEmailAdress = mysqli_real_escape_string($conn, $userEmailAdress);
            //  $userFirstName = mysqli_real_escape_string($conn, $userEmailAdress);
            //  $userSurName = mysqli_real_escape_string($conn, $userSurName);

            // $sql_insertUser = "INSERT into user (user_name, user_pwd, user_firstname, user_surname, user_email)
            //                 VALUES ('$userName', '". md5($passWord)."', '$userFirstName', '$userSurName','$userEmailAdress')";
            // mysqli_query($conn, $sql_insertUser);
            /////////////////                                      //////////////////////

            //$conn->autocommit(FALSE);
            $stmt_UserCredinsert = "INSERT into user (user_name, user_pwd, user_firstname, user_surname, user_email)
                                    VALUES (?, ?, ?, ?, ?)";
            $stmt_UserCredinsert->bind_param('sssss', $userName, $passWord, $userFirstName, $userSurName, $userEmailAdress);
            $stmt_UserCredinsert->execute();
            //$conn->commit();
            //$conn->autocommit(TRUE);

            header('Location:../pages/loginForm.php?msg'); 
        }
        ?>