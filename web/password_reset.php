<?php
  require_once('classes/Login.php');
  $login = new Login();
  if ($login->isUserLoggedIn()) {
    header("Location: login");
    die();
  } else {
    $title = "Reset Password";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
  }
?>

<head>
  <title>Math CS Club - Reset Password</title>
</head>

<body class="login-background">
<div class="container">

</div>
<div class="form">
  <br>
   <div class="loginWords">Math CS Club<br>Reset Password</div>
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
   <br>
   <div class="loginMessages">
       <?php
        if (isset($_GET['email']) && isset($_GET['reset_token'])) {
            $db->where('reset_token', $_GET['reset_token']);
            $user = $db->getOne('users');

            if ($user && $user['preferred_email'] == $_GET['email']) {
                echo "Enter new password for account:<br>" . $_GET['email'];
       ?>
   <br><br>
   </div>

  <form method="post" action="password_reset" class="reset-form">
    <input id="reset_input_password" name="user_password_new" type="password" placeholder="Password" required/>
    <input id="reset_input_confirm" name="user_password_repeat" type="password" placeholder="Repeat Password" required/>
    <input id="reset_input_token" name="user_reset_token" type="hidden" value="<?php echo $_GET['reset_token'] ?>"/>

	<br><br>

    <input id="login_input_submit" type="submit" name="update_password" value="Reset Password" />
  </form>

  <?php
            } else {
                echo "Invalid email or reset token.";
            }
        } else {
            echo "Invalid URL.";
        }
  ?>

  </div>

</body>
</html>
