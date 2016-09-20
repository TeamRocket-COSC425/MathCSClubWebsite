<html>
<?php
    $title = "SU Math/CS Club Log in";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Dashboard.html");
?>




<div class = "loginbackground">
<div class ="logintransbox">
<form action="process_login.php" enctype= multipart/form-data>
    <p>
                                   Email  <br> <input style="width:200px;" name="email" type="text" required>
                                   <br>
                                   Password  <br> <input style="width:200px;" name = "password" type = "text" required>
                                   <br>
                                   <a href="index.html">
forgot password?
</a>
                                   <input style="background-color:#12BFC3;" type="submit"style="" value="LOGIN" name = "memberlogin">

                                   
</form>
</div>
</div>


</html>