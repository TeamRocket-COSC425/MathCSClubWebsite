<?php
$title = "SU Math/CS Club Graduation Cords";
require_once("classes/EditableText.php");
include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Graduation Cords</title>
	<link rel="stylesheet" href="css/graduation-cords.css"/>
</head>

<body>
<div id="main">
	<div id="content">
		<header class="banner">
			<h1>Graduation Cords</h1>
		</header>
		<div id="grad-mobile">
			<?php (new EditableText("graduation-cords"))->getContent(); ?>
		</div>
	</div>
</div>
</body>
</html>
