    <?php 
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'config.php';



                    //stripslashes removes backslashes, some protection agains injection i guess
                    $userName = stripslashes($_POST['userName']);
                    $passWord = stripslashes($_POST['passWord']);
                    $userEmailAdress = stripslashes($_POST['userEmailAdress']);
                    $userFirstName = stripslashes($_POST['userFirstname']);
                    $userSurName = stripslashes($_POST['userSurname']);


                    if(!(isset($userName) || isset($passWord) || isset($userEmailAdress) || isset($userFirstName) || isset($userSurName))){
                            echo 'To register you need to provide information for all the fields in the registrationform!';
                    }

                    //theese two lines retrives all userNames and userEmails from the DB, to be used for duplicate check later
                    $sql_userCheck = "SELECT * FROM user WHERE user_name = '$userName'";
                    $sql_emailCheck = "SELECT * FROM user WHERE user_email = '$userEmailAdress'";
                    $res_userCheck = mysqli_query($conn, $sql_userCheck);
                    $res_emailCheck = mysqli_query($conn, $sql_emailCheck);

                    if(mysqli_num_rows($res_userCheck) > 0){
                        echo 'Unfortunatly the username is already taken.';
                    }
                    else if (mysqli_num_rows($res_emailCheck) > 0){
                        echo 'Emailadress is already beeing used for an existing account.';
                    }
                    else {
                        $userName = mysqli_real_escape_string($conn, $userName);
                        $passWord = mysqli_real_escape_string($conn, $passWord);
                        $userEmailAdress = mysqli_real_escape_string($conn, $userEmailAdress);
                        $userFirstName = mysqli_real_escape_string($conn, $userEmailAdress);
                        $userSurName = mysqli_real_escape_string($conn, $userSurName);

                        $sql_insertUser = "INSERT into user (user_name, user_pwd, user_firstname, user_surname, user_email)
                                        VALUES ('$userName', '". md5($passWord)."', '$userFirstName', '$userSurName','$userEmailAdress')";
                        
                        mysqli_query($conn, $sql_insertUser);

                        echo 'you have now signed up';

                    }
                 ?>