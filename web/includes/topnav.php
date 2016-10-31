<link rel="stylesheet" href="css/topnav.css"/>

<?php
  require_once "classes/Login.php";
  require_once "classes/Utils.php";

  $login = new Login();

  echo '<div id="topnav">';
if ($login->isUserLoggedIn()) {
    $admin = Utils::currentUserAdmin();
    if ($admin) {
        include "views/Edit.html";
    }
    include "views/Logout.html";
    if ($admin) {
        include "views/Dashboard.html";
    }
    include "views/Profile.php";
} else {
    include "views/SignUp.html";
    include "views/Login.html";
}
  echo '</div>';
?>
