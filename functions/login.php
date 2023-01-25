<?php 
include 'config.php';

if (!isset($_POST['username'], $_POST['password']) ) {
	exit('Fill in all the forms...');
}
if ($stmt = $con->prepare('SELECT user_name, user_password FROM user WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result(); //store_result makes it possible to check if account exists in db
   
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usrn_db, $pwd_db);
        $stmt->fetch();
        if (password_verify($_POST['password'], $pwd_db)) {
            $_SESSION['user'] = $_POST['username'];
            $_SESSION['loggedin'] = true;
        } else {
            echo 'Wrong credentials...';
        }
    } else {
        echo 'Wrong credentials...';
    }

}
header('../index.php');
?>
