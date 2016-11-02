<?php
    $title = "SU Math/DPS";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableContent.php");
?>

<head>
	<title>Dead Poets Society</title>
	<link rel="stylesheet" href="css/dps.css"/>
</head>

<body>

<div id="main">

<div id="content">

<header>
<h1><code> Dead Poets Society</code></h1>
</header>

<div class="center">

<?php (new EditableContent("dead-poets-society"))->getContent(); ?>

</div>
</div>
</div>

</body>

</html>