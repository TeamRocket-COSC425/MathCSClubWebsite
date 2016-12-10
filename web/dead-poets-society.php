<?php
    $title = "SU Math/DPS";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableText.php");
?>

<head>
	<title>Dead Poets Society</title>
	<link rel="stylesheet" href="css/dps.css"/>
</head>

<body>

<div id="main">

<div id="content">

<div id="dps">

<header class="banner">
    <h1>Dead Poets Society</h1>
</header>

<div class="center">

<?php (new EditableText("dead-poets-society"))->getContent(); ?>

</div>
</div>
</div>
</div>

</body>

</html>
