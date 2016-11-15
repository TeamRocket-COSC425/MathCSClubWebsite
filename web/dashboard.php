<?php
    $title = "SU Math/CS Club Dashboard";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/Utils.php");
    require_once("classes/AdminFunctions.php");
    if (isset($_POST['openGcRegistration'])){
    	Admins::updateRegistraion("openGc");
    }
    if (isset($_POST['openMcRegistration'])){
    	Admins::updateRegistraion("openMc");
    }
    if (isset($_POST['closeGcRegistration'])){
    	Admins::updateRegistraion("closeGc");
    }
    if (isset($_POST['closeMcRegistration'])){
    	Admins::updateRegistraion("closeMc");
    }
    if (isset($_POST['emptyGcRegistration'])){
        Admins::clearCompetition("GullCode");
    }
    if (isset($_POST['emptyMcRegistration'])){
        Admins::clearCompetition("MathChallenge");
    }
?>

<head>
	<title>Math CS Club - Dashboard</title>
	<link rel="stylesheet" href="css/dashboard.css"/>
</head>

<body>

<div id="main">

<div id="content">

<h1>
Dashboard
</h1>
<div class="registrationcontrolbutton">
<?php
	$gcControl = $db->where("admin_controls", "gullcode_register")->getone("admin_controls");
	if($gcControl["switch"] == 0) {
?>
	<form method="post">
	<input name="openGcRegistration" type="submit" value="Open Gullcode Registration"/>
	</form>
<?php
  	}
    else {
 ?>
 	<form method="post">
	<input name="closeGcRegistration" type="submit" value="Close Gullcode Registration"/>
	</form>
 <?php   	
    }
?>
    <form method="post">
    <input name="emptyGcRegistration" type="submit" value="Delete Gullcode Registration list"/>
    </form>
<?php
    $mcControl = $db->where("admin_controls", "math_challenge_register")->getone("admin_controls");
    if($mcControl["switch"] == 0) {
 ?>
 	<form method="post">
	<input name="openMcRegistration" type="submit" value="Open Math Challenge Registration"/>
	</form>
 <?php   	
    }
    else {
 ?>
 	<form method="post">
	<input name="closeMcRegistration" type="submit" value="Close Math Challenge Registration"/>
	</form>
<?php
    }
?>
    <form method="post">
    <input name="emptyMcRegistration" type="submit" value="Delete Math Challenge Registration list"/>
    </form>
</div>
</div>
</div>

</body>

</html>
