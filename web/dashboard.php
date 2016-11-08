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


    <div id=gullcodeTables>
        <H3>GullCode Teams</H3>
<?php
        /* GULLCODE TEAMS */
        $teams = $db->where("team_id")->get("gullcode_teams");
        $team_members = $db->where("team_id")->get("gullcode_users_on_teams");
        $users = $db->get("users");

        foreach ($teams as $team) 
        {
            if($teams) {
                echo '<H4>' . $team['team_name'] . '</H4>';
                echo '<table id="freeAgents" class="tablesorter">';
?>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Major</th>
                        <th>Year</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody>

<?php
                foreach ($team_members as $team_member) {
                    if($team['team_id'] == $team_member['team_id']) {
                        foreach ($users as $user) {
                            if ($team_member['id'] == $user['id']) {
                                echo "<tr><td>" . $user['name'] . "</td><td>" . $user['email'] . "</td><td>" . $user['major'] . "</td><td>" . Utils::year($user['year']) . "</td>";
?>             
                                    <td>
                                    <a class="button" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
                                    </td>
                                    </tr>
<?php
                            }
                        }
                    }
                }
                echo "</tbody>";
                echo "</table> <br>";
            }
        }

        /* GULLCODE FREE AGENTS */
        echo "<H3>Free Agents</H3>";
        $db->join("users u", "g.id=u.id", "LEFT");

        $free_agents = $db->where("team_id", 0)->get("gullcode_users_on_teams g");
        $users = $db->get("users");
        echo '<table id="freeAgents" class="tablesorter">';

?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Major</th>
                <th>Year</th>
                <th>Highest COSC</th>
                <th>Highest Math</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody>

<?php
        foreach ($free_agents as $free_agent) {
            echo "<tr><td>" . $free_agent['name'] . "</td><td>" . $free_agent['email'] . "</td><td>" . $free_agent['major'] . "</td><td>" . Utils::year($free_agent['year']) . "</td><td>" . $free_agent['course_compsci'] . "</td><td>" . $free_agent['course_math'] . "</td>";

 ?>             <td>
                    <a class="button" href="profile?user=<?php echo $free_agent['id']; ?>">Profile</a>
                </td>
                </tr>
<?php
        }

        echo "</tbody>";
        echo "</table>";
?>
    </div>
</div>
</div>

</body>

</html>
