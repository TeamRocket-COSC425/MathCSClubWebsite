<?php
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
<script type="text/javascript">
function scrollTo(id) {
    $('html, body').animate({ scrollTop: $('#' + id).offset().top - 60 }, 'slow');
}
</script>
<div id="navbuttons">
    <h3>Navigation</h3>
    <a class="button" href="#" onclick="scrollTo('users')">User List</a>
    <a class="button" href="#" onclick="scrollTo('gullcodeTables')">Gullcode</a>
</div>
<div class="adminpane form" id="announcements" >
    <h3>Add Announcement</h3>
<?php
    if (isset($_POST['add_announcement'])) {
        $data = array(
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'type' => $_POST['type']
        );
        $db->insert('announcements', $data);
        header("Location: dashboard");
        die();
    }
?>
    <form id="new_announcement" method="post" action="dashboard">
        <input type="text" id="announcement_title" name="title" placeholder="Title" required/>
    </form>
    <textarea form="new_announcement" name="content" placeholder="Content" ></textarea>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script> var mde = new SimpleMDE(); </script>
    <p class="message">Announcement Type:</p>
    <select form="new_announcement" name="type">
        <option value="note">Note</option>
        <option value="important">Important</option>
    </select>
    <input form="new_announcement" type="submit" name="add_announcement" />
    <a class="button" href="dashboard?user">View User Dashboard</a>
</div>
<div class="adminpane" id="users">
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
                <th>Delete</th>
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
                    <a class="button tablebutton" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
                </td>
                <td>
                    <a class="button tablebutton dangerbutton" href="profile?user=<?php echo $user['id']; ?>&delete">Delete</a>
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


<div class="adminpane" id="gullcodeTables">
    <h1>GullCode</h1>  
    <div>
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
    </div>
    <br>
    
<?php
    /* GULLCODE TEAMS */
    $teams = $db->where("team_id")->get("gullcode_teams");
    $team_members = $db->where("team_id")->get("gullcode_users_on_teams");
    $users = $db->get("users");

    foreach ($teams as $team)
    {
        if($teams) {
            echo '<h4>GullCode Teams</h4>';
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
                                <a class="button tablebutton" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
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
    
    $db->join("users u", "g.id=u.id", "LEFT");

    $free_agents = $db->where("team_id", 0)->get("gullcode_users_on_teams g");
    $users = $db->get("users");
    if($free_agents){
    echo "<h4>Free Agents</h4>";
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
                <a class="button tablebutton" href="profile?user=<?php echo $free_agent['id']; ?>">Profile</a>
            </td>
            </tr>
<?php
    }

    echo "</tbody>";
    echo "</table>";
    }   
?>

<?php
        /* First 60 signed up */
        
        $db->join("users u", "g.id=u.id", "LEFT");
        $db->orderBy ("register_time", "asc");
        $users = $db->get("gullcode_users_on_teams g", 60);
        if($users){
        echo "<h4>First 60 To Sign Up</h4>";
        echo '<table id="freeAgents" class="tablesorter">';

?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>T-Shirt Size</th>
                <th>Time signed up</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody>

<?php
        foreach ($users as $user) {
            echo "<tr><td>" . $user['name'] . "</td><td>" . $user['email'] . "</td><td>" . Utils::t_size($user['t_size']) . "</td><td>" . $user['register_time'] . "</td>";

 ?>             <td>
                    <a class="button tablebutton" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
                </td>
                </tr>
<?php
        }

        echo "</tbody>";
        echo "</table>";
        }
?>
</div>

<div class="adminpane" id="mathChallengeTables">
    <h1>Math Challenge</h1>
    
    <div>
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
    <br>
    
<?php
    /* MATH CHALLENGE TEAMS */
    $teams = $db->where("team_id")->get("math_challenge_teams");
    $team_members = $db->where("team_id")->get("math_challenge_users_on_teams");
    $users = $db->get("users");

    foreach ($teams as $team)
    {
        if($teams) {
            echo '<h4>Math Challenge Teams</h4>';
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
                                <a class="button tablebutton" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
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

    /* MATH CHALLENGE FREE AGENTS */
    
    $db->join("users u", "g.id=u.id", "LEFT");

    $free_agents = $db->where("team_id", 0)->get("math_challenge_users_on_teams g");
    $users = $db->get("users");
    if($free_agents){
    echo "<h4>Free Agents</h4>";
    echo '<table id="freeAgents" class="tablesorter">';

?>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Major</th>
            <th>Year</th>
            <th>Highest Math</th>
            <th>Profile</th>
        </tr>
    </thead>
    <tbody>

<?php
    foreach ($free_agents as $free_agent) {
        echo "<tr><td>" . $free_agent['name'] . "</td><td>" . $free_agent['email'] . "</td><td>" . $free_agent['major'] . "</td><td>" . Utils::year($free_agent['year']) . "</td><td>" . $free_agent['course_math'] . "</td>";

?>             <td>
                <a class="button tablebutton" href="profile?user=<?php echo $free_agent['id']; ?>">Profile</a>
            </td>
            </tr>
<?php
    }

    echo "</tbody>";
    echo "</table>";
    }
?>

<?php
        /* First 60 signed up */
        
        $db->join("users u", "g.id=u.id", "LEFT");
        $db->orderBy ("register_time", "asc");
        $users = $db->get("math_challenge_users_on_teams g", 60);
        if($users){
        echo "<h4>First 60 To Sign Up</h4>";
        echo '<table id="freeAgents" class="tablesorter">';

?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>T-Shirt Size</th>
                <th>Time signed up</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody>

<?php
        foreach ($users as $user) {
            echo "<tr><td>" . $user['name'] . "</td><td>" . $user['email'] . "</td><td>" . Utils::t_size($user['t_size']) . "</td><td>" . $user['register_time'] . "</td>";

 ?>             <td>
                    <a class="button tablebutton" href="profile?user=<?php echo $user['id']; ?>">Profile</a>
                </td>
                </tr>
<?php
        }

        echo "</tbody>";
        echo "</table>";
        }
?>
</div>
