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

    <div id="users">
        <h3>Users</h3>
        <table id="usertable" class="tablesorter">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Mentor</th>
                    <th>Admin</th>
                    <th>Profile</th>
                </tr>
            </thead>
            <tbody>
<?php
                $users = $db->get('users');
                for ($i = 0; $i < 5; $i++)
                foreach ($users as $user) {
                    echo '<tr>';
                    echo "<td>$user[name]</td>";
                    echo "<td>$user[id]</td>";
                    echo "<td>$user[email]</td>";
                    echo '<td>' . ($user['mentor'] ? "Yes" : "No") . '</td>';
                    echo '<td>' . ($user['admin'] ? "Yes" : "No") . '</td>';
?>                  <td>
                        <a class="button" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
                    </td>
<?php
                    echo '</tr>';
                }
?>
            </tbody>
        </table>
        <!-- pager -->
        <div id="pager">
          <form>
            <i class="fa fa-step-backward first" aria-hidden="true"></i>
            <i class="fa fa-backward prev" aria-hidden="true"></i>
            <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
            <i class="fa fa-forward next" aria-hidden="true"></i>
            <i class="fa fa-step-forward last" aria-hidden="true"></i>
            <select class="pagesize">
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="40">40</option>
              <option value="all">All Rows</option>
            </select>
          </form>
        </div>

        <script>
        // Apply table sorting
        $(function() {
            $("#usertable")
                .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
                .tablesorterPager({container: $("#pager"), cssPageDisplay: '.pagedisplay', fixedHeight: true});
        });
        </script>
    </div>
</div>
</div>

</body>

</html>
