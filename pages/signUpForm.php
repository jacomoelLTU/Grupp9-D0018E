<a href="../index.php">Home</a>
<?php
    include '../functions/config.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    
    session_start();
    $usr = $_SESSION['username'];
    $role;
    $query = mysqli_query($conn,"SELECT user_role, user_name FROM user WHERE user_name = '$usr'");
    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
        if(($row['user_name'] == $usr)){
            $role = $row['user_role'];
        }
    }
    if($role =='admin'){
    echo'
        <form class = "SignUpStyle" action ="../functions/signup.php" method = "post">

            <h1 class ="SignUpHeader"> Provide user information to register </h1>
            <input type = "text" class = "SignUp-input" name = "userName" placeholder = "Username"/> 
            <input type = "text" class = "SignUp-input" name = "passWord" placeholder = "Password"/>
            <input type = "text" class = "SignUp-input"  name = "userEmailAdress" placeholder = "Email Adress"/>
            <input type = "text" class = "SignUp-input" name = "userFirstname" placeholder = "First Name"/>
            <input type = "text" class = "SinUp-input" name = "userSurname" placeholder = "Surname"/>

            <input type="submit" class = "login-button" name = "Submit" value="Register" />
            
            <p class = "link"><a href="loginForm.php">Click to view login page</a></p>

        </form>
    ';
    }
?>