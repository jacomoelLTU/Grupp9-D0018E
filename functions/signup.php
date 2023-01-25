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

                    <h1 class="SignUpHeader"> Provide user infromation to register </h1>
                    <input type = "text" class = "SignUp-input" name = "Username" placeholder = "userName"/> 
                    <input type = "text" class = "SignUp-input" name = "Password" placeholder = "passWord"/>
                    <input type = "text" class = "SignUp-input"  name = "Email Adress" placeholder = "userEmail"/>
                    <input type = "text" class = "SignUp-input" name = "First name" placeholder = "userFirstname"/>
                    <input type = "text" class = "SinUp-input" name = "Surname" placeholder = "userSurname"/>

                    <input type="submit" class = "login-button" name = "Submit" value="Register" />
                    <p class = "link"><a href="index.php">Click to view login page</a></p>

                </form>
    

            </div>
        </body>
    </html>