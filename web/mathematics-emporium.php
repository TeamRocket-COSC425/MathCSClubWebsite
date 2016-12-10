<?php
    $title = "SU Math/CS Club Mathematics Emporium";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableText.php");
?>

<head>
	<title>Math CS Club - Mathematics Emporium</title>
	<link rel="stylesheet" href="css/math-emporium.css"/>
</head>

<body>

<div id="main">

<div id="content">

<header class="banner">
    <h1>Mathematics Emporium</h1>
</header>


 <div class="mathEmpTxt">

	<div class="center">
	<?php (new EditableText("mathematics-emporium"))->getContent(); ?>
	</div>
</div>

<div class="mathEmpImg">
<img src="images/floor2AC.png" alt="AC Mapp">
</div>


<hr style="background-color: #003366; width: 100%; height: 3px;">
<br>

<center>
<img src="images/Fall2016Tutor.PNG" alt="Tutor Schedule">
</center>

</div>
</div>

</body>

</html>
