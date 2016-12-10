<?php
require_once('classes/Utils.php');
require_once('classes/EditableContent.php');

@session_start();

$error = null;

if (!isset($_GET['page']) || empty($_GET['page'])) {
    http_response_code(400);
    $error = "Invalid URL";
}
if ((isset($_POST['edit_id']) && !isset($_POST['edit_content'])) || (isset($_POST['revert']) && !isset($_POST['revert_to']))) {
    http_response_code(400);
    $error = "Malformed Request";
}
if (!Utils::currentUserAdmin()) {
    http_response_code(403);
    $error = "You are not authorized to be here!";
}

if (!$error) {
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
        $content = EditableContent::create($_POST['edit_id']);
        if (!$content->save($_POST['edit_content'])) {
            foreach ($content->errors as $error) {
                echo $erorr . '<br>';
            }
            die();
        }
    } else {
        if (!isset($_SESSION['edit'])) {
          $_SESSION['edit'] = true;
        } else {
          $_SESSION['edit'] = !$_SESSION['edit'];
        }
    }

    header("Location: " . $dest);
} else {
    require "includes/header.html";
    require "includes/sidenav.html";
    require "includes/topnav.php";
?>

    <div id="main">
    <div id="content">
      <center>
      <h1>
          <?= $error ?>
      </h1>
      </center>
    </div>
    </div>
<?php
}
?>
