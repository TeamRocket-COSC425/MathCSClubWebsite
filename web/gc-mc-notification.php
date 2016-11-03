<?php
    $title = "SU Math/CS Club Notification";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - GullCode/Math Challenge Notification</title>
</head>

<body>

<div id="main">

<div id="content">

<div class="center">

<?php (new EditableContent("notification"))->getContent(); ?>

</div>
</div>
</div>
</body>
