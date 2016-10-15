<?php
  require "includes/header.html";
  require "includes/sidenav.html";
  require "includes/topnav.php";

  require_once('classes/EditableContent.php');
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
if (isset($_POST['edit_id']) && !isset($_POST['edit_content'])) {
    http_response_code(400);
    echo "Malformed Request";
    die();
}
if (!Utils::currentUserAdmin()) {
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

$dest;
if (isset($_GET['page'])) {
    $dest = $_GET['page'];
}

if (isset($_POST['edit_id'])) {
    $content = new EditableContent($_POST['edit_id']);
    $content->save($_POST['edit_content']);

    $_SESSION['edit'] = false;
} else {
    $_SESSION['edit'] = true;
}

header("Location: " . $dest);

?>
