<?php
require_once("classes/EditableText.php");
$title = "SU Math/CS Club Calender";
include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Calendar</title>
	<link rel="stylesheet" href="css/calendar.css"/>
</head>

<body>
	<div id="main">
		<div id="content">
			<header class="banner">
				<h1>Calendar</h1>
			</header>

			<div id="calendar-mobile">
				<?php (new EditableText("calendar"))->getContent(); ?>
			</div>

			<hr style="background-color: #003366; width: 100%; height: 3px;">
			<br>
			<!-- Embeds Salisbury Universities Math and CS Calendar-->
			<iframe src="https://www.google.com/calendar/embed?src=sumathcsclub%40gmail.com&ctz=America/New_York"
			style="border: 0" width="100%" height="550" frameborder="0" scrolling="yes"></iframe>
		</div>
	</div>

</body>

</html>
