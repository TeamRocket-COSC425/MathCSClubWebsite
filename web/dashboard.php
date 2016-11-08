<?php
    $title = "SU Math/CS Club Dashboard";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Dashboard</title>
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
    if (Utils::currentUserAdmin()) {
        include("views/dashboard_admin.php");
    } else {
        include("views/dashboard_user.php");
    }
?>
</div>
</div>

</body>

</html>
