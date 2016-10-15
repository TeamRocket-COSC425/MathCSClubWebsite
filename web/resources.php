<?php
    require_once('classes/EditableContent.php');

    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Extra Resources</title>
</head>

<body>

<div id="main">
<div id="content">
   <?php
      $content = new EditableContent('resources');
      $content->getContent();
    ?>
</div>
</div>

</body>
</html>
