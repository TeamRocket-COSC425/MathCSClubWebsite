<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableContent.php");
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
<header>
<h1><code><center> GullCode </center></code></h1>
</header>

<div class="col3">
  <div>
  <img src="images/gullcode/gullcode_sp2014.jpg" class="gullcodepic">
  </div>
  <div class="block">
  <?php (new EditableContent("gullcodeTime"))->getContent(); ?>
  </div>
  <div>
  <img src="images/gullcode/gullcode_fa2015.jpg" class="gullcodepic">
</div>
</div>

<hr>

<?php (new EditableContent("gullCodeDescription"))->getContent(); ?>

<?php
  if($login->isUserLoggedIn()) {

    $control = $db->where("admin_controls", "gullcode_register")->getone("admin_controls");
    if($control["switch"] == 1) {
      include("views/GC-MC-Register.html");
    }
  }
?>


</div>
</div>

</body>

</html>
