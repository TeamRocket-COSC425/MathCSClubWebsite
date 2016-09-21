<html>

<?php
    $title = "SU Math/CS Club Log in";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Dashboard.html");
?>

<div class = "login-background">
<div class ="login-transbox">
<form action="process-login.php" enctype= multipart/form-data> 
    <p>
    	Email  
    	<br>
    	<input style="width:200px;" name="email" type="text" required>
    	<br>
    	Password 
    	<br> 
    	<input style="width:200px;" name = "password" type = "text" required>
    	<br>
    	<a href=""> <!-- link to change password -->forgot password? </a>
        <input style="background-color:#12BFC3;" type="submit" value="login" name ="member-login">  
        </p>                            
</form>
</div> <!-- end login-transbox -->
</div> <!-- end login-background -->

</html>