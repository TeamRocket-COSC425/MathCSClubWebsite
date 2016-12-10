<?php
$title = "SU Math/CS Club Pi Mu Epsilon";
include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");

require_once("classes/Login.php");
require_once("classes/Utils.php");
$login = new Login();
require_once("classes/EditableText.php");
?>

<head>
	<title>Math CS Club - Pi Mu Epsilon</title>
  <link rel="stylesheet" href="css/math-challenge.css"/>
</head>

<body>

  <div id="main">

    <div id="content">

      <header class="banner">
        <h1>Pi Mu Epsilon</h1>
      </header>

      <div class="Overview">
        <?php (new EditableText("honor-society"))->getContent();?>
      </div>

    </div>
  </div>

</body>
</html>
