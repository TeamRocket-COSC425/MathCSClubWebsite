<link rel="stylesheet" href="css/topnav.css"/>
<div class="col-6">
<?php
  require_once("classes/Login.php");
  require_once("classes/Utils.php");

  $login = new Login();

  echo '<div id="topnav">';
  if ($login->isUserLoggedIn()) {
    $admin = Utils::currentUserAdmin();
    if ($admin) {
      include("views/Edit.html");
    }
    include("views/Logout.html");
    include("views/Dashboard.html");
    echo '<div id="sessiondata"> <i class="fa fa-user" aria-hidden="true"></i>
 You are logged in as <b><a href="profile">'. $_SESSION['user_email'] . '</a>' . ($admin ? ' (Admin)' : '') . '</b></div>';
  } else {
    include("views/SignUp.html");
    include("views/Login.html");
  }
  echo '</div>';
?>
</div>