<link rel="stylesheet" href="css/topnav.css"/>

<?php
  require_once("classes/Login.php");
  $login = new Login();

  echo '<div id="topnav">';
  if ($login->isUserLoggedIn()) {
    include("views/Logout.html");
    echo '<div id="sessiondata"> You are logged in as <b>'. $_SESSION['user_email'] .'<b></div>';
  } else {
    include("views/SignUp.html");
    include("views/Login.html");
  }
  echo '</div>';
?>
