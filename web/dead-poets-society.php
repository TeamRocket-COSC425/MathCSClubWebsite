<?php
    $title = "SU Math/DPS";

    require_once("classes/EditableContent.php");

    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Dead Poets Society</title>
</head>

<body>

<div id="main">

<div id="content">
<?php
  (new EditableContent("dps"))->getContent();
?>

</div>
</div>

</body>

</html>
