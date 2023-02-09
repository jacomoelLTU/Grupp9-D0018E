<?php

    //checking if coming from a successful signup
    if (isset($_GET['msg'])){
        $message = 'You have successfully signed up, use your credentials to log in.';
        echo ($message);
    }

?>

<div id="loginForm">
    <form action="../functions/login.php" method="POST">
        <input type="text" id="username" name="username" placeholder="User Name...">
        <input type="text" id="password" name="password" placeholder= "Password...">
        <input type="submit">
    </form>
</div>

<ul id="login"> 
    <p>
    No account? Click here to <a href="../pages/signUpForm.php" >Sign Up</a>!
    </p>
</ul>