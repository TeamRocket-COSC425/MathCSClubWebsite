<?php
require_once("classes/ConfirmBuilder.php");
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

<?php
    $errorMsg = "";       //holds error messages
    $confirmMsg = "";

    //create a new officer
    if (isset($_POST['add_officer'])) {
        $ID = $_POST['ID'];
        $title = $_POST['officerTitle'];
        $bio = $_POST['officerBio'];

        //get the student from the user table to put into the officers table
        $db->where("id", $ID);
        $student = $db->getOne("users");

        if ($student) {
            $data = Array (
                'name' => $student['name'],
                'image' => $student['image'],
                'bio' => $bio,
                'id' => $ID
            );
            $db->where ('title', $title);
            if ($db->update ('officers', $data))
                $confirmMsg = 'records were updated';
            else
                $errorMsg = "That ID is not in the database";
        }
        else {
            $errorMsg = "That ID is not in the database";
        }
    }
?>

<script type="text/javascript">



function scrollTo(id) {
    $('html, body').animate({ scrollTop: $('#' + id).offset().top - 60 }, 'slow');
}
</script>
<div id="navbuttons">
    <h3>Navigation</h3>
    <a class="button" href="#" onclick="scrollTo('fallactivity')">Fall Activities</a>
    <a class="button" href="#" onclick="scrollTo('springactivity')">Spring Activities</a>
    <a class="button" href="#" onclick="scrollTo('users')">User List</a>
    <a class="button" href="#" onclick="scrollTo('gullcodeTables')">Gullcode</a>
    <a class="button" href="#" onclick="scrollTo('mathChallengeTables')">Math Challenge</a>
    <a class="button" href="#" onclick="scrollTo('EndofYearPicnic')">End of Year Picnic</a>
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
    <textarea form="new_announcement" name="content" id="announcement_editor" placeholder="Content" ></textarea>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script> var mde = new SimpleMDE({ element: $("#announcement_editor")[0]}); </script>
    <p class="message">Announcement Type:</p>
    <select form="new_announcement" name="type">
        <option value="note">Note</option>
        <option value="important">Important</option>
    </select>
    <input form="new_announcement" type="submit" name="add_announcement" />
    <a class="button" href="dashboard?user">View User Dashboard</a>
</div>

<div class="adminpane form" id="fallactivity">
    <h3>Manage Fall Activities</h3>
<?php
    if (isset($_POST['add_fall_activity'])) {
        $data = array(
            'activity' => $_POST['activity']
        );
        $db->insert('fall_activities', $data);
        $data1 = array(
            'id' => "Fall-".$_POST['activity'],
            'content' => $_POST['fallActivityContent']
        );
        $db->insert('page_content', $data1);

    }
    if(isset($_POST["delete_fall_activity"])){
        $act = $_POST['delete_activity'];
        $db->where('activity', $act)->delete('fall_activities');
        $db->where('id', "Fall-".$act)->delete('page_content');
    }
?>

    <form id="new_fall_activity" method="post" action="dashboard">
        <p class="message">Add New Activity:</p>
        <input type="text" id="activity" name="activity" placeholder="Activity" required/>
        <textarea form="new_fall_activity" name="fallActivityContent" id="fall_activity_editor" 
            placeholder="Activity Description" ></textarea>
        <script> var mde = new SimpleMDE({ element: $("#fall_activity_editor")[0]}); </script>
    </form>
    <input  form="new_fall_activity" type="submit" name="add_fall_activity"/>

    <?php
            $fallactivities = $db->get('fall_activities');
            if ($fallactivities){
    ?>
    <table id="falltable" class="sortedtable">
        <thead>
            <tr>
                <th>Activity Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($fallactivities as $fla) {
                echo '<tr>';
                echo '<td>' . $fla["activity"] . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
        </table>

    <script>
    // Apply table sorting
    $(function() {
        $("#falltable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
    });
    </script>

        <form id="delete_fall_activity" method="post" action="dashboard">
            <p class="message">Delete Activity:</p>
            <input type="text" id="delete_activity" name="delete_activity" placeholder="Activity" required/>
        </form>
        <input  class="dangerbutton" form="delete_fall_activity" type="submit" name="delete_fall_activity"/>

        <?php
            }
        ?>
</div>

<div class="adminpane form" id="springactivity">
    <h3>Manage Spring Activities</h3>
<?php
    if (isset($_POST['add_spring_activity'])) {
        $data = array(
            'activity' => $_POST['activity']
        );
        $db->insert('spring_activities', $data);
        $data1 = array(
            'id' => "Spring-".$_POST['activity'],
            'content' => $_POST['springActivityContent']
        );
        $db->insert('page_content', $data1);
    }
    if(isset($_POST["delete_spring_activity"])){
        $act = $_POST['delete_activity'];
        $db->where('activity', $act)->delete('spring_activities');
        $db->where('id', "Spring-".$act)->delete('page_content');
    }
?>

    <form id="new_spring_activity" method="post" action="dashboard">
        <p class="message">Add New Activity:</p>
        <input type="text" id="activity" name="activity" placeholder="Activity" required/>
    </form>
    <textarea form="new_spring_activity" name="springActivityContent" id="spring_activity_editor" 
        placeholder="Activity Description" ></textarea>
    <script> var mde = new SimpleMDE({ element: $("#spring_activity_editor")[0]}); </script>
    <input  form="new_spring_activity" type="submit" name="add_spring_activity"/>

    <?php
            $springactivities = $db->get('spring_activities');
            if ($springactivities){
    ?>
    <table id="springtable" class="sortedtable">
        <thead>
            <tr>
                <th>Activity Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($springactivities as $spa) {

                echo '<tr>';
                echo '<td>' . $spa["activity"] . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
        </table>

    <script>
    // Apply table sorting
    $(function() {
        $("#springtable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
    });
    </script>

        <form id="delete_spring_activity" method="post" action="dashboard">
            <p class="message">Delete Activity:</p>
            <input type="text" id="delete_activity" name="delete_activity" placeholder="Activity" required/>
        </form>
        <input  class="dangerbutton" form="delete_spring_activity" type="submit" name="delete_spring_activity"/>

        <?php
            }
        ?>
</div>

<div class="adminpane" id="users">
    <h3>Users</h3>
    <table id="usertable" class="sortedtable">
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
<?php
                    $confirm = (new ConfirmBuilder($user['id']))
                                ->confirmText("Are you sure you want to delete the profile for $user[email]?")
                                ->targetLoc("profile?user=$user[id]&delete");

                    $confirm->getContent("Delete", ['tablebutton']);
?>
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
    <h3>GullCode</h3>
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
    <input class="dangerbutton" name="emptyGcRegistration" type="submit" value="Delete Gullcode Registration list"/>
    </form>
    </div>
    <br>

<?php
    /* GULLCODE TEAMS */
    $teams = $db->where("team_id")->get("gullcode_teams");
    $team_members = $db->where("team_id")->get("gullcode_users_on_teams");
    $users = $db->get("users");

    if($teams)
    {
        echo '<h4>GullCode Teams</h4>';
    }
    foreach ($teams as $team)
    {
        if($teams) {
            echo '<H4>' . $team['team_name'] . '</H4>';
            echo '<table id="gullcodetable" class="sortedtable">';
?>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Major</th>
                    <th>Year</th>
                    <th>Profile</th>
                    <th>Remove Teammate</th>
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
                                <td>
<?php
                                $confirm = (new ConfirmBuilder($user['id']))
                                            ->confirmText("Are you sure you want to remove user $user[name] from the team $team[team_name]?")
                                            ->targetLoc("delete_teammate?user=$user[id]&delete");

                                $confirm->getContent("Remove from $team[team_name]", ['tablebutton']);
?>
                                </td>
                                </tr>
<?php
                        }
                    }
                }
            }
            echo "</tbody>";
            echo "</table> <br>";

            ?>
    <script>
    // Apply table sorting
    $(function() {
        $("#gullcodetable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
    });
    </script>

    <?php
        }
    }

    /* GULLCODE FREE AGENTS */


    $db->join("users u", "g.id=u.id", "LEFT");

    $free_agents = $db->where("team_id", 0)->get("gullcode_users_on_teams g");
    $users = $db->get("users");
    if($free_agents){
    echo "<h4>Free Agents</h4>";
    echo '<table id="gcfreeAgentstable" class="sortedtable">';
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

    ?>
    <div id="pager4">
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
        $("#gcfreeAgentstable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
            .tablesorterPager({container: $("#pager4"), cssPageDisplay: '.pagedisplay', fixedHeight: true});
    });
    </script>

    <?php
    }
?>

<?php
        /* First 60 signed up */

        $db->join("users u", "g.id=u.id", "LEFT");
        $db->orderBy ("register_time", "asc");
        $users = $db->get("gullcode_users_on_teams g", 60);
        if($users){
        echo "<h4>First 60 To Sign Up</h4>";
        echo '<table id="gc60peopletable" class="sortedtable">';

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
        ?>

        <div id="pager5">
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
        $("#gc60peopletable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
            .tablesorterPager({container: $("#pager5"), cssPageDisplay: '.pagedisplay', fixedHeight: true});
    });
    </script>

    <?php
        }
?>
</div>

<div class="adminpane" id="mathChallengeTables">
    <h3>Math Challenge</h3>

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
    <input class="dangerbutton" name="emptyMcRegistration" type="submit" value="Delete Math Challenge Registration list"/>
    </form>
    </div>
    <br>

<?php
    /* MATH CHALLENGE TEAMS */
    $teams = $db->where("team_id")->get("math_challenge_teams");
    $team_members = $db->where("team_id")->get("math_challenge_users_on_teams");
    $users = $db->get("users");

    if($teams)
    {
        echo '<h4>Math Challenge Teams</h4>';
    }

    foreach ($teams as $team)
    {
        if($teams) {
            echo '<H4>' . $team['team_name'] . '</H4>';
            echo '<table id="mathchallengetable" class="sortedtable">';
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
            ?>

    <script>
    // Apply table sorting
    $(function() {
        $("#mathchallengetable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
    });
    </script>

            <?php
        }
    }

    /* MATH CHALLENGE FREE AGENTS */

    $db->join("users u", "g.id=u.id", "LEFT");

    $free_agents = $db->where("team_id", 0)->get("math_challenge_users_on_teams g");
    $users = $db->get("users");
    if($free_agents){
    echo "<h4>Free Agents</h4>";
    echo '<table id="mcfreeAgentstable" class="sortedtable">';

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
    ?>

    <div id="pager7">
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
        $("#mcfreeAgentstable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
            .tablesorterPager({container: $("#pager7"), cssPageDisplay: '.pagedisplay', fixedHeight: true});
    });
    </script>

    <?php
    }
?>

<?php
        /* First 60 signed up */

        $db->join("users u", "g.id=u.id", "LEFT");
        $db->orderBy ("register_time", "asc");
        $users = $db->get("math_challenge_users_on_teams g", 60);
        if($users){
        echo "<h4>First 60 To Sign Up</h4>";
        echo '<table id="mc60peopletable" class="sortedtable">';

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
        ?>

            <div id="pager8">
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
        $("#mc60peopletable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
            .tablesorterPager({container: $("#pager8"), cssPageDisplay: '.pagedisplay', fixedHeight: true});
    });
    </script>

        <?php
        }
?>
</div>

<div class="adminpane" id="EndofYearPicnic">
    <h3>RSVPs for the End of Year Picnic</h3>

    <?php
            $RSVPs = $db->get('picnic_rsvp');
            if ($RSVPs){
    ?>
    <table id="RSVPs" class="sortedtable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($RSVPs as $RSVP) {
                echo '<tr>';
                echo '<td>' . $RSVP["id"] . '</td>';
                echo '<td>' . $RSVP["name"] . '</td>';
                echo '<td>' . $RSVP["item"] . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
        </table>
        <div id="pager9">
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
        $("#RSVPs")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
            .tablesorterPager({container: $("#pager9"), cssPageDisplay: '.pagedisplay', fixedHeight: true});
    });
    </script>
        <?php
            }
        ?>
</div>

<div class="adminpane" id="officers">
    <h3>Manage Officers</h3>

    <!--Display error messages-->
    <div class="loginErrors" style="color:red;">
        <?php if( isset($errorMsg) && $errorMsg != '' ) { echo $errorMsg; } ?>
        <?php if( isset($confirmMsg) && $confirmMsg != '' ) { echo $confirmMsg; } ?>
    </div>
    <br>

    <form id="new_officer" method="post" action="dashboard">
        <p class="message">Change an officer</p>
        <select id="reg_input_officer" name="officerTitle" class="officerDrop" required/>
          <optgroup label="Officer">
          <?php
          $officers = $db->get('officers');
          foreach($officers as $officer) {
            $name = $officer['title'];
            echo '<option value="'. $name .'">'. $name .'</option>';
          }
          ?>
        </optgroup>
        </select>
        <input type="text" id="ID" name="ID" placeholder="Student ID" required/>
        <textarea form="new_officer" name="officerBio" id="officerBio" 
            placeholder="Officer Bio" required></textarea>
    </form>
    <input  form="new_officer" type="submit" name="add_officer"/>
