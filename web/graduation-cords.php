<?php
$title = "SU Math/CS Club Graduation Cords";
require_once("classes/EditableContent.php");
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
		<header>
			<h1><code><center> Graduation Cords </center></code></h1>
		</header>
		<div id="grad-mobile">
			<?php (new EditableContent("graduation-cords"))->getContent(); ?>
		</div>
	</div>
</div>
</body>
</html>
