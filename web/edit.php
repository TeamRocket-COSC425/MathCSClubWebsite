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
if ((isset($_POST['edit_id']) && !isset($_POST['edit_content'])) || (isset($_POST['revert']) && !isset($_POST['revert_to']))) {
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

if (isset($_POST['revert'])) {
    // find version we are reverting to
    $version = $db->where(EditableContent::COLUMN_TIMESTAMP, $_POST['revert_to'])->getOne(EditableContent::TABLE_HISTORY);
    $id = $version[EditableContent::COLUMN_ID];

    // Delete all newer versions from history
    $db->where(EditableContent::COLUMN_TIMESTAMP, $version[EditableContent::COLUMN_TIMESTAMP], ">=")->delete(EditableContent::TABLE_HISTORY);

    // Update the content table
    $db->where(EditableContent::COLUMN_ID, $id)->update(EditableContent::TABLE_CONTENT, $version);

} elseif (isset($_POST['edit_id'])) {
    $content = new EditableContent($_POST['edit_id']);
    $content->save($_POST['edit_content']);

    $_SESSION['edit'] = false;
} else {
    if (!isset($_SESSION['edit'])) {
      $_SESSION['edit'] = true;
    } else {
      $_SESSION['edit'] = !$_SESSION['edit'];
    }
}

header("Location: " . $dest);

?>
