<!DOCTYPE html>
    <html>

    <head> 
        <title>Sign Up Form</title>
    </head>

    <?php include 'functions/config.php'; ?>

        <body>

        <!-- Create input fields according to DB table user, save in vars and then write it to BD -->
            <link rel="stylesheet" type="text/css" href="CSS/header.css">
            <div id="singUp_header">

            <form class = "SignUpStyle" action ="registerUser.php" method = "post">

                <h1 class="SignUpHeader"> Provide user information to register </h1>
                <input type = "text" class = "SignUp-input" name = "userName" placeholder = "Username"/> 
                <input type = "text" class = "SignUp-input" name = "passWord" placeholder = "Password"/>
                <input type = "text" class = "SignUp-input"  name = "userEmailAdress" placeholder = "Email Adress"/>
                <input type = "text" class = "SignUp-input" name = "userFirstname" placeholder = "First Name"/>
                <input type = "text" class = "SinUp-input" name = "userSurname" placeholder = "Surname"/>

                <input type="submit" class = "login-button" name = "Submit" value="Register" />
                <p class = "link"><a href="loginForm.php">Click to view login page</a></p>

            </form>

                <?php
                    //load in the config file to set up a connection to DB
                    require ("../functions/config.php");

                    //stripslashes removes backslashes, some protection agains injection i guess
                    $userName = stripslashes($_REQUEST['userName']);
                    $passWord = stripslashes($_REQUEST['passWord']);
                    $userEmailAdress = stripslashes($_REQUEST['userEmailAdress']);
                    $userFirstName = stripslashes($_REQUEST['userFirstname']);
                    $userSurName = stripslashes($_REQUEST['userSurname']);


                    if(isset($userName) || isset($passWord) || isset($userEmailAdress) || isset($userFirstName) || isset($userSurName)){
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
                    }
                 ?>

            
    

            </div>
        </body>
    </html>