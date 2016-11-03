<?php
    $title = "SU Math/CS Club Mathematics Emporium";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableContent.php");
?>

<head>
	<title>Math CS Club - Mathematics Emporium</title>
</head>

<body>

<div id="main">

<div id="content">
 
 <div style="-webkit-column-count: 2; -moz-column-count: 2; column-count: 2;">

	<div class="center"> 
	<?php (new EditableContent("mathematics-emporium"))->getContent(); ?>
	</div>

<img src="images/floor2AC.png" alt="AC Mapp" style="width: 100%; height: auto; border-radius: 8px;">
</div>
<br>
<hr style="background-color: #003366; height: 3px;">
<br>
<img src="images/Fall2016Tutor.PNG" alt="Tutor Schedule" style="width: 80%; height: auto; border-radius: 8px; display: block; margin: 0 auto">

</div>
</div>

</body>

</html>