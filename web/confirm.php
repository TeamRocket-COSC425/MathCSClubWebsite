<?php
include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");
require_once("classes/ConfirmBuilder.php");
?>

<head>
  <title>Math CS Club - Contact Us</title>
  <link rel="stylesheet" href="css/confirm.css"/>
  <script>
  $(document).ready(function(){
      $("#delete_go_back").click(function(){
          window.history.back();
      });
  });
  </script>
</head>

<body>

<div id="main">
    <div id="content" class="center">
<?php
        $confirm = ConfirmBuilder::fromPost();
        $_SESSION[ConfirmBuilder::KEY_UID] = $confirm->uid;
?>
	    <h4><?= $confirm->confirm_text ?></h4>
		<p style="color:red;">This cannot be undone</p>
		<a class="button dangerbutton" id="delete_profile" href="<?= $confirm->target_loc ?>">Yes</a>
		<a id="delete_go_back" class="button" href="#">Go Back</a>
    </div>
</div>
