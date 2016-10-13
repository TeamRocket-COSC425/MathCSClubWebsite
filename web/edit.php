<?php
  include("includes/header.html");
  include("includes/sidenav.html");
  include("includes/topnav.php");
?>

<div id="main">
<div id="content">
  <center>
  <h1>

<?php

  if (!isset($_GET['page']) || empty($_GET['page'])) {
    http_response_code(400);
    echo "Invalid URL";
    die();
  }
  if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    http_response_code(403);
    echo "You are not authorized to be here!";
    die();
  }

?>
  </h1>
  </center>

</div>
</div>

<?php
  $dest = $_GET['page'];
  $_SESSION['edit'] = true;
  header("Location: " . $dest);

 ?>
