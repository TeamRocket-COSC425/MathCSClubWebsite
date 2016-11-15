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

<table id="gullcodeContent">
  <tr>
    <td><img src="images/gullcode/gullcode_sp2014.jpg" class="gullcodepic"></td>
    <td><?php (new EditableContent("gullcodeTime"))->getContent(); ?>
    <td><img src="images/gullcode/gullcode_fa2015.jpg" class="gullcodepic"></td>
  </tr>
</table>

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
