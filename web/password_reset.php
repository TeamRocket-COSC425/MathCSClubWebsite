<?php
  require_once('classes/Login.php');
  $login = new Login();
  if ($login->isUserLoggedIn()) {
    $title = "Change Password";
  } else {
    $title = "Reset Password";
  }
  include("includes/header.html");
  include("includes/sidenav.html");
  include("includes/topnav.php");
?>

<head>
  <title>Math CS Club - <?=$title?></title>
  <link rel="stylesheet" href="css/forms.css"/>
</head>

<body class="login-background">
<div class="container">

</div>
<div class="form">
  <br>
   <div class="loginWords">Math CS Club<br><?= $login->isUserLoggedIn() ? 'Change' : 'Reset'?> Password</div>
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
       if ($login->messages) {
         echo "<br>";
         foreach ($login->messages as $msg) {
           echo $msg . "<br>";
         }
       }
        if ($login->isUserLoggedIn() || (isset($_GET['email']) && isset($_GET['reset_token']))) {
            if (!$login->isUserLoggedIn()) {
                $db->where('reset_token', $_GET['reset_token']);
                $user = $db->getOne('users');
            }

            if ($login->isUserLoggedIn() || ($user && $user['preferred_email'] == $_GET['email'])) {
                echo "Enter new password for account:<br>" . ($login->isUserLoggedIn() ? $_SESSION['user_email'] : $_GET['email']);
       ?>
   <br><br>
   </div>

  <form method="post" action="password_reset" class="reset-form">
<?php
    if ($login->isUserLoggedIn()) {
?>
        <input id="reset_input_password" name="user_password_old" type="password" placeholder="Current Password" required/>
<?php
    }
?>
    <input id="reset_input_new_password" name="user_password_new" type="password" placeholder="New Password" required/>
    <input id="reset_input_new_confirm" name="user_password_repeat" type="password" placeholder="Repeat New Password" required/>
<?php
    if (!$login->isUserLoggedIn()) {
?>
        <input id="reset_input_token" name="user_reset_token" type="hidden" value="<?php echo $_GET['reset_token'] ?>"/>
<?php
    }
?>
	<br><br>

    <input id="login_input_submit" type="submit" name="update_password" value="<?=$login->isUserLoggedIn() ? 'Change' : 'Reset'?> Password" />
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
