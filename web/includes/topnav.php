<link rel="stylesheet" href="css/topnav.css"/>

<?php
  require_once("classes/Login.php");
  $login = new Login();

  echo '<div id="topnav">';
  if ($login->isUserLoggedIn()) {
    include("views/Logout.html");
    include("views/Dashboard.html");
    echo '<div id="sessiondata"> <i class="fa fa-user" aria-hidden="true"></i>
 You are logged in as <b>'. $_SESSION['user_email'] .'<b></div>';
  } else {
    include("views/SignUp.html");
    include("views/Login.html");
  }
  echo '</div>';
?>
