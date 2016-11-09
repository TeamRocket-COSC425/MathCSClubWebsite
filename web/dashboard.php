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
?>

<head>
	<title>Math CS Club - Dashboard</title>
    <link rel="stylesheet" href="css/forms.css"/>
    <link rel="stylesheet" href="css/dashboard.css"/>
    <link rel="stylesheet" href="css/tablesort/theme/blue/style.css"/>
    <link rel="stylesheet" href="js/tablesort/addons/pager/jquery.tablesorter.pager.css"/>
    <script type="text/javascript" src="js/tablesort/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/tablesort/jquery.tablesorter.widgets.js"></script>
    <script type="text/javascript" src="js/tablesort/addons/pager/jquery.tablesorter.pager.js"></script>
</head>

<body>

<div id="main">
<div id="content">
<?php
    if (Utils::currentUserAdmin() && !isset($_GET['user'])) {
        include("views/dashboard_admin.php");
    } else {
        include("views/dashboard_user.php");
    }
?>
</div>
</div>

</body>

</html>
