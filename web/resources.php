<?php
    require_once('classes/EditableContent.php');

    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");

    session_start();

    if (isset($_POST['text_info'])) {
      $myfile = fopen("content/resources.md", "w") or die("Unable to open file!");
      $text = $_POST['text_info'];
      fwrite($myfile, $text);

      $_SESSION['edit'] = false;
    }

    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Extra Resources</title>
	<link rel="stylesheet" href="css/home.css"/>
</head>

<body>

<div id="main">
<div id="content">
   <?php
      $content = new EditableContent('content/resources.md');
      $content->getContent();
    ?>
</div>
</div>

</body>
</html>
