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
                    <input type = "text" class = "SignUp-input" name = "userFirstnaem" placeholder = "First Name"/>
                    <input type = "text" class = "SinUp-input" name = "userSurname" placeholder = "Surname"/>

                    <input type="submit" class = "login-button" name = "Submit" value="Register" />
                    <p class = "link"><a href="../index.php">Click to view login page</a></p>

                </form>
    

            </div>
        </body>
    </html>