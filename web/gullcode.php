<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableText.php");
    require_once("classes/Login.php");
    require_once("classes/Utils.php");
    $login = new Login();
?>
<head>
  <title>Math CS Club - GullCode</title>
    <link rel="stylesheet" href="css/gullcode.css"/>
</head>

<body>

<div id="main">

<div id="content" class = "center">

<header class="banner">
    <h1>GullCode</h1>
</header>

<br>

<div class="col3">
  <div>
  <?php (new EditableImage('gullcodepic_1'))->getContent(); ?>
  </div>
  <div class="block">
  <?php (new EditableText("gullcodeTime"))->getContent(); ?>
  </div>
  <div>
  <?php (new EditableImage('gullcodepic_2'))->getContent(); ?>
</div>
</div>

<hr>

<?php (new EditableText("gullCodeDescription"))->getContent(); ?>

<?php
  if($login->isUserLoggedIn()) {

    $control = $db->where("admin_controls", "gullcode_register")->getone("admin_controls");
    if($control["switch"] == 1) {
?>
        <center><a href="gc-mc-registration.php?tab=mathchallenge" class="GCsessionButton">Register</a></center>
<?php
    }
  }
?>


</div>
</div>

</body>

</html>
