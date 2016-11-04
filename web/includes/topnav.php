<link rel="stylesheet" href="css/topnav.css"/>

<?php
  require_once "classes/Login.php";
  require_once "classes/Utils.php";

  $login = new Login();

  echo '<div id="topnav">';
  echo '<div id="topnav-mobile">';
if ($login->isUserLoggedIn()) {
    $admin = Utils::currentUserAdmin();
?>

    <i class="fa fa-caret-down" id="mobile-dropdown" aria-hidden="true"></i>
<script>
  var swapped = false;

  function reverseButtons() {
    $("#mobile-toggle > a").each(function(){
      $(this).prependTo(this.parentNode);
    });
  }

  function checkSize() {
    if (!swapped && $("#mobile-toggle").css("clear") == "both") {
      reverseButtons();  
      swapped = true;
    } else if (swapped && $("#mobile-toggle").css("clear") == "none") {
      reverseButtons();
      swapped = false;
    }
  }
  
  $(document).ready(function(){
    $("#mobile-dropdown").click(function(){
      $("#mobile-toggle").slideToggle();
    });
    checkSize();
    
    $(window).resize(checkSize);
  });
</script>


<?php
echo '<div id="mobile-toggle">';
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
  echo '</div>';
  echo '</div>';
?>
