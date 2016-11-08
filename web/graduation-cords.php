<?php
$title = "SU Math/CS Club Graduation Cords";
require_once("classes/EditableContent.php");
include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Graduation Cords</title>
</head>

<body>

	<div id="main">

		<div id="content">
			<div id="grad-mobile">
				<?php
				(new EditableContent("graduation-cords"))->getContent();
				?>
			</div>

		</body>

		</html>
