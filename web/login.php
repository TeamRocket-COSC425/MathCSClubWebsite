<?php
  require_once("classes/Login.php");
  $login = new Login();
  if ($login->isUserLoggedIn()) {
    header("Location: dashboard");
    die();
  } else {
    $title = "SU Math/CS Club Log in";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
  }
?>

<head>
    <title>Math CS Club - Login</title>
    <link rel="stylesheet" href="css/forms.css"/>
</head>

<body class="login-background">
<div id="main">
<div id="content">
<div class="container">

<div class="form">
  <br>
   <div class="loginWords">
     Math CS Club<br>Login
   </div>
   <div class="loginErrrors" style="color:red;">
     <?php
      if ($login->errors) {
        echo "<br>";
        foreach ($login->errors as $err) {
          echo $err . "<br>";
        }
      }
    ?>
  </div>
  <div class="loginMessages">
      <?php
        if (isset($_GET['reset'])) {
            echo '<br>A reset link has been emailed to you.';
        } elseif(isset($_GET['updated'])) {
            echo '<br>Your password was updated.';
        } elseif ($login->messages) {
            echo '<br>';
            foreach ($login->messages as $msg) {
              echo $msg . "<br>";
            }
        }
      ?>
  </div>
  <form method="post" action="login" name="forgot-form" class="forgot-form">
    <p class="message">
        Forgot your password?<br><br>
        Enter either your SU or Preferred email here. A reset link will be sent to you.
    </p><br>
    <input id="reset_input_email" name="user_email" type="text" placeholder="Email" required/>
    <input id="login_input_submit" type="submit" name="reset" value="Send" />
    <p/>
    <p class="message">Already registered? <a href="#">Sign In</a></p>
    <p class="message">Not registered? <a href="sign-up">Create an account</a></p> <!-- needs link to create account -->
  </form>

  <form method="post" action="login" name="login-form">
    <input id="login_input_email" name="user_email" type="text" placeholder="Email" required>
    <input id="login_input_password" name="user_password" type="password" placeholder="Password" required />
    <input id="login_input_submit" type="submit" name="login" value="Log in" />
    <p/>
    <p class="message">Forgot your password? <a href="#">Reset password</a></p>
    <p class="message">Not registered? <a href="sign-up">Create an account</a></p> <!-- needs link to create account -->
  </form>

  </div>
</div>
</div>

  <script src="js/login.js"></script>

</body>
</html>
