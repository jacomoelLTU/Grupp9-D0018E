<div id="loginForm">
    <form action="../functions/login.php" method="POST">
        <input type="text" id="username" name="username" placeholder="User Name...">
        <input type="text" id="password" name="password" placeholder= "Password...">
        <input type="submit">
    </form>
</div>

<!-- Form for post action -->
<form action="../functions/posts.php" method="POST">
    Title: <input type="text" name="post_title">
    Description: <input type="text" name="post_description">
    Price: <input type="text" name="post_price">
    Image: <input type="image" name="post_img">
  
    <input type="submit">
  </form>