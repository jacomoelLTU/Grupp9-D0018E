<?php

    //checking if coming from a successful signup
    if (isset($_GET['msg'])){
        $message = 'You have successfully signed up, use your credentials to log in.';
        echo ($message);
    }

?>
<link rel="stylesheet" type="text/css" href="../CSS/login.css">
<body>
    <div id="login">
        <h2>Login</h2>
    </div>

    <div id="loginForm">
        <form action="../functions/login.php" method="POST">
            <input type="text" id="username" name="username" placeholder="User Name..." required><br>
            <input type="text" id="password" name="password" placeholder= "Password..." required><br>
            <input type="submit" value="Log in">
        </form>
    </div>

    <ul id="createaccount"> 
        <p>
        No account? Click here to <a href="../pages/signUpForm.php" >Sign Up</a>!
        </p>
    </ul>
</body>