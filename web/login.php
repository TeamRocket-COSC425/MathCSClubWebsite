<html>

<?php
    $title = "SU Math/CS Club Log in";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Dashboard.html");
?>

<div class = "login-background">
<div class ="login-transbox">

<form method="post" action="/" name="loginform">

      <label for="login_input_email">Email</label>
    	<input style="width:200px;" id="login_input_email" class="input-box" name="user_email" type="text" required>

      <p>

      <label for="login_input_password">Password</label>
      <input style="width:200px;" id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

      <p>

    	<a href="#"> <!-- link to change password -->forgot password? </a>

      <input type="submit" value="login" class="loginSubmit" name ="Log in">
</form>

</div> <!-- end login-transbox -->
</div> <!-- end login-background -->

</html>
