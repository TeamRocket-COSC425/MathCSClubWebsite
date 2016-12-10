<?php
    require_once('classes/EditableText.php');

    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Extra Resources</title>
   <link rel="stylesheet" href="css/resources.css"/>
</head>

<body>

<div id="main">
<div id="content">

      <?php
      $content = new EditableText('resources');
      $content->getContent();
    ?>
  </div>
</div>
</div>

</body>
</html>
