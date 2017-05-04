<head>
	<title>User Profile</title>
    <link rel="stylesheet" href="css/forms.css"/>
    <link rel="stylesheet" href="css/profile.css"/>
</head>

<?php
$title = "User Profile";

require_once("classes/Utils.php");
require_once("classes/Login.php");
require_once("classes/ConfirmBuilder.php");
$login = new Login;
if (!$login->isUserLoggedIn()) {
  header("Location: home");
}

$user = Utils::getCurrentUser();
$currentuser = $user;


$edit = isset($_GET['edit']);
$delete = isset($_GET['delete']);

if (isset($_GET['user'])) {
  $user = $db->where('id', $_GET['user'])->getOne('users') ?: $user;
}

if ($user == $currentuser && isset($_GET['user'])) {
    header("Location: " . preg_replace("/(\?(?!.+&))?user=[0-9]+&?/", "", $_SERVER['REQUEST_URI']));
}
// function to check profile image upload size
$image_validator = function($image) {
    $default_validator = Utils::getDefaultImageValidator();
    if ($default_validator($image)) {
            // Make sure the image is square
        list($width, $height) = getimagesize($image['tmp_name']);
            // Make sure the image is square
        if ($width != $height) {
           $errors[] = "Image must be square.";
       } else {
        return 1;
    }
}
return 0;
};

    // stores the upload image into
$image_loc = Utils::handleImageUpload('image', $image_validator);
if ($image_loc != 'image') {
    $db->where('id', $user['id'])->update('users', array('image' => $image_loc));
    $user['image'] = $image_loc;
}

    // POST handling
if (isset($_POST['submit'])) {

		// Build array of data to update table width
		// Cannot directly use $_POST array due to injection potential
    $data = array(
        'email' => $_POST['email'],
        'preferred_email' => $_POST['preferred_email'],
        'major' => $_POST['major'],
        'year' => $_POST['year'],
        't_size' => $_POST['t_size'],
        'bio' => $_POST['bio']
        );

    if (Utils::currentUserAdmin()) {
     $admindata = array(
        'mentor' => isset($_POST['mentor']) ? 1 : 0,
        'admin' => isset($_POST['admin']) ? 1 : 0
        );
     $data = array_merge($data, $admindata);
 }

 $db->where('id', $user['id'])->update('users', $data);

		// Redirect
 header("Location: profile?user=$user[id]");
}

require_once("classes/UserFunctions.php");
    // function that will remove gullcode,mathchallenge,picnic from user database
if(isset($_GET["drop"]) && Utils::sessionCheck(ConfirmBuilder::KEY_UID, $user['id'])) {
    switch ($_GET['drop']) {
        case 'gullcode':
        Users::dropCompetition("GullCode", $user);
        break;
        case 'mathchallenge':
        Users::dropCompetition("MathChallenge", $user);
        break;
        case 'rsvp':
        Users::unRSVP($user);
        break;
        case 'mentor':
        if ($user['mentor']) {
            $db->where('id_mentee', $_GET['mentee'])->delete('mentor_mentee');
        } else {
            $db->where('id_mentee', $user['id'])->delete('mentor_mentee');
        }
        break;
    }

    header("Location: profile?user=$user[id]");
}

include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");
?>

<head>
    <link rel="stylesheet" href="css/tablesort/theme/blue/style.css"/>
    <link rel="stylesheet" href="js/tablesort/addons/pager/jquery.tablesorter.pager.css"/>
    <script type="text/javascript" src="js/tablesort/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/tablesort/jquery.tablesorter.widgets.js"></script>
    <script type="text/javascript" src="js/tablesort/addons/pager/jquery.tablesorter.pager.js"></script>
    <script>
        // Apply table sorting
        $(function() {
            $("#menteetable")
            .tablesorter({sortList: [[0,0]], widgets: ["zebra"]})
            .tablesorterPager({container: $("#pager"), cssPageDisplay: '.pagedisplay', fixedHeight: false});
        });
        </script>
    </head>

    <body>

        <div id="main">

            <div id="content">
                <?php
    // check to see if user is an admin for editable content
                if (($edit || $delete) && $user !== $currentuser && !Utils::currentUserAdmin()) {
                    ?>
                    <center>
                      You cannot edit this page.<br/>
                      <a id="to_my_profile" class="button" href="profile?edit">To My Profile</a>
                  </center>
                  <?php
                  die();
              }
              ?>
              <script>
              $(document).ready(function(){
                  $("#delete_go_back").click(function(){
                     window.history.back();
                 });


              });
              </script>
              <center>
                <?php
//Function for deleting the user
                if ($delete) {
                   if ($user === $currentuser) {
                    ?>
                    <h3>You cannot delete your own profile!</h3>
                    <a id="delete_go_back" class="button" href="#">Go Back</a>
                    <?php
                } elseif (Utils::sessionCheck(ConfirmBuilder::KEY_UID, $user['id'])) {
                  $db->where('id', $user['id'])->delete('users');
                  ?>		Profile "<?php echo $user['email']; ?>" has been deleted
                  <a class="button" href="dashboard">To Dashboard</a>
                  <?php
              } else {
                ?>
                <h3>Error, delete not confirmed. Please try again.</h3>
                <a id="delete_go_back" class="button" href="#">Go Back</a>
                <?php
            }
            die();
        }
        ?>
    </center>

    <div id ="user_info">
        <!-- Left side of profile with user information contained -->
        <div id="left_column">
          <?php
          $image = $user['image'];
          if (!$image) {
              $image = "images/loginicon.jpg";
          }

          if ($edit) {
            ?>
            <div class="form">
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="profile" enctype="multipart/form-data">
                </form>
                <div id="image_upload_wrapper">
                    <div id="image_upload_form">
                     <img id="profile_image" src="<?= $user['image'] ?: 'images/loginicon.jpg'; ?>"/><br>
                     <label class="image_upload">
                        <input form="profile" type="file" name="image" value="<?php echo $user['image']; ?>" />
                        <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>

            <p class="message">Email:</p>
            <input form="profile" type="text" name="email" value="<?php echo $user['email']; ?>" required/>

            <p class="message">Preferred Email:</p>
            <input form="profile" type="text" name="preferred_email" value="<?php echo $user['preferred_email']; ?>" />

            <!-- TODO this is copied from sign-up.php -->
            <p class="message">Major:</p>
            <select form="profile" id="reg_input_major" name="major" class="signUpDrop" value="<?php echo $user['major'];?>" required/>
              <optgroup label="Major">
                <?php
                $majors = $db->get('majors');
                foreach($majors as $major) {
                    $name = $major['major'];
                    echo '<option ' . ($user['major'] === $name ? 'selected ' : '') . 'value="'. $name .'">'. $name .'</option>';
                }
                ?>
            </optgroup>
        </select>

        <br>
        <p class="message">Year:</p>
        <select form="profile" id="profile_input_year" name="year" value="<?php echo $user['year'];?>" required>
            <optgroup label="Class">
                <?php
                for ($i = 0; $i <= 4; $i++) {
                    echo '<option ' . ($user['year'] === $i ? 'selected ' : '') . "value=\"$i\">" . Utils::year($i) . '</option>';
                }
                ?>
            </optgroup>
        </select>

        <p class="message">T-Shirt Size:</p>
        <select form="profile" id="profile_input_tsize" name="t_size" selected="<?php echo Utils::t_size($user['t_size']);?>" required>
            <optgroup label="T-Shirt Size">
                <?php
                for ($i = 0; $i <= 4; $i++) {
                    echo '<option ' . ($user['t_size'] === $i ? 'selected ' : '') . "value=\"$i\">" . Utils::t_size($i) . '</option>';
                }
                ?>
            </optgroup>
        </select>
        <?php
        if (Utils::currentUserAdmin())
        {
            ?>
            <input form="profile" type="checkbox" name="mentor" value="" <?php if ($user['mentor']) echo 'checked'; ?>> Mentor<br/>
            <input form="profile" type="checkbox" name="admin"  value="" <?php if ($user['admin'])  echo 'checked'; ?>> Admin<br/>
            <?php
        }
        ?>
        <input class="profile_button" form="profile" type="submit" name="submit" value="Save"/>
    </div>
    <?php
} else {
 echo "<div class='profileWrapper'> <img src=\"$image\" /> <div class='profileDescription'><b>". $user['name'] . ($user['admin'] ? ' (Admin)' : '')."</b></div></div>";
 echo '<center><h3></h3></center>';
 $email = $user['email'];
 echo 'Email: ' . $email;
 if ($email !== $user['preferred_email']) {
    echo '<br>Preferred: ' . $user['preferred_email'];
}
echo '<br>Major: ' . $user['major'];
echo '<br>Year: ' . Utils::year($user['year']);
if ($user['t_size']) {
    echo '<br>T-Shirt Size: ' . Utils::t_size($user['t_size']);
}
$url = strtok($_SERVER['REQUEST_URI'], '?') . '?edit';
if (isset($_GET['user'])) {
    $url = $url . '&user=' . $_GET['user'];
}
?>
<br>
<?php
if ($user === $currentuser || Utils::currentUserAdmin()) {
    ?>
    <div id="profile_buttons">
        <a class="button profile_button" href="<?php echo $url; ?>">Edit Profile</a>
    </div>

    <?php
}
        /*
         * Make sure (A) this is not the current user's profile,
         * (B) this profile is a mentor, (C) the current user is
		 * *not* a mentor, and (C), the current user does not already
		 * have a mentor.
         */
        if ($user != $currentuser && $user['mentor'] && !$currentuser['mentor'] && !$db->where('id_mentee', $currentuser['id'])->getOne('mentor_mentee'))  {
            ?>
            <div id="profile_buttons">
                <a class="button profile_button" href="mentee.php?user=<?= $user['id'] ?>">Select As Mentor</a>
            </div>
            <?php
        }
    }
    ?>
</div>
<!-- end left column -->

<div id="right_column">
    <!-- contains user bio, math challenge and gullcode teams and picnic rsvp -->
    <div id="bio">
        <h3> Bio </h3><hr/>
        <p>
          <?php
          if ($edit) {
            ?>
            <textarea form="profile" id="profile_input_bio" rows="0" cols="0" name="bio"><?php echo $user['bio']; ?></textarea>
            <script src="jquery-3.1.0.min.js"></script>
            <!-- death to package managers -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
            <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
            <script>
            var simplemde = new SimpleMDE();
            </script>
            <?php
        } else {
            $parser = Parsedown::instance();
            echo $parser->text($user['bio']);
        }
        ?>
    </p>
</div>
<?php
$mentor = $db->where('id_mentee', $user['id'])->getOne('mentor_mentee') ?: $db->where('id_mentor', $user['id'])->get('mentor_mentee');
if ($mentor) {
    ?>
    <div id = "mentor_program">
        <h3> Mentor Program </h3><hr/>
        <?php
        if (isset($mentor['id_mentee']) && $mentor['id_mentee'] == $user['id']) {
            $mentor_user = $db->where('id', $mentor['id_mentor'])->getOne('users');
            ?>
            <p>Your selected mentor is <a href="profile?user=<?php echo $mentor_user['id'];?>"><?= $mentor_user['name'] ?></a></p>
            <p>Confirmed: <?= $mentor['confirmed'] ? 'Yes' : 'No' ?></p>
            <?php
            $confirm = (new ConfirmBuilder($user['id']))
            ->confirmText(
                $mentor['confirmed'] ?
                "Are you sure you want to remove yourself as a mentee for $mentor_user[name]?" :
                "Are you sure you want to cancel your mentor request?"
                )
            ->targetLoc("profile?user=$user[id]&drop=mentor");
            $confirm->getContent($mentor['confirmed'] ? "Drop Mentor" : "Cancel Request");
        } else {
            ?>
            <p>You are a mentor!</p>
            <p>Your mentees:</p>
            <table id="menteetable" class="sortedtable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mentor as $entry) {
                        if ($entry['confirmed']) {
                            $mentee = $db->where('id', $entry['id_mentee'])->getOne('users');
                            echo '<tr>';
                            echo "<td>$mentee[name]</td>";
                            echo "<td>$mentee[id]</td>";

                            $confirm = (new ConfirmBuilder($user['id']))
                            ->confirmText("Are you sure you want to drop $mentee[name] as your mentee?")
                            ->targetLoc("profile?user=$user[id]&drop=mentor&mentee=$mentee[id]");

                            echo '<td>';
                            $confirm->getContent('Remove', ['tablebutton']);
                            echo '</td>';
                        }
                    }
                    echo '</tbody>';
                    ?>
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
          <?php
      }
      ?>
  </div>
  <?php
}
?>

<div id = "gullcode">

  <center>
    <?php
    $userteam = $db->where('id', $user['id'])->getOne('gullcode_users_on_teams');
    if ($userteam) {
      $team = $db->where('team_id', $userteam['team_id'])->getOne('gullcode_teams');
      if ($team) {
        ?>
    </center>


    <div class="searchLink">
        <h3> Gullcode </h3>

        <?php
        if($team['team_id']!=0){
          ?>
          <div id="searchPeople"> <a href="directory"><i class="fa fa-search" aria-hidden="true"></i></a>
                <div id="searchText">
                  <form method="get" action="directory">
                    <input type="text" name="q" placeholder="   Search people to add to your team"></input></form>
                </div></div>

          <?php
      }
      echo '</div>'

      ?>
      <hr/>

      <center>
        <?php
        echo "On team \"$team[team_name]\"";
        $gcControl = $db->where("admin_controls", "gullcode_register")->getone("admin_controls");
        if($gcControl["switch"] == 1) {
          $confirm = (new ConfirmBuilder($user['id']))
          ->confirmText("Are you sure you want to leave the team \"$team[team_id]\"?")
          ->targetLoc("profile?user=$user[id]&drop=gullcode");
          $confirm->getContent("Drop from $team[team_name]");
      }
  } else {
    echo "Error, no team found!";
}
} else {
  ?>
</center>

<h3> Gullcode </h3>
<hr/>

<center>
  <?php
  echo "Not on a team";
}
?>
</center>

</div>


<div id = "mathchallenge">
    <center>
      <?php
      $userteam = $db->where('id', $user['id'])->getOne('math_challenge_users_on_teams');
      if ($userteam) {

          $team = $db->where('team_id', $userteam['team_id'])->getOne('math_challenge_teams');
          if ($team) {
            ?>
        </center>
        <div class="searchLink">
            <h3> Math Challenge </h3>


            <?php
            if($team['team_id']!=0){
              ?>
              <form id="searchusers" method="get" action="directory" style="display:none;"></form>
              <div id="searchPeople">
                  <button type="submit" href="directory" form="searchusers"><i class="fa fa-search" aria-hidden="true"></i></button>
                  <div id="searchText">
                      <input type="text" name="q" placeholder="Search people to add to your team" form="searchusers"></input></form>
                  </div>
              </div>

              <?php
          }
          echo'</div>'
          ?>
          <hr/>

          <center>
            <?php

            echo "On team \"$team[team_name]\"";
            $mcControl = $db->where("admin_controls", "math_challenge_register")->getone("admin_controls");
            if($mcControl["switch"] == 1) {
                $confirm = (new ConfirmBuilder($user['id']))
                ->confirmText("Are you sure you want to leave the team \"$team[team_id]\"?")
                ->targetLoc("profile?user=$user[id]&drop=mathchallenge");
                $confirm->getContent("Drop from $team[team_name]");
            }
        } else {
            echo "Error, no team found!";
        }
    } else {
        ?>
    </center>

    <h3> Math Challenge </h3>
    <hr/>

    <center>
        <?php
        echo "Not on a team";
    }
    ?>
</center>
</div>
<!-- function to send information from database about senior picnic -->
<?php
if ($user === $currentuser || Utils::currentUserAdmin()) {
    echo '<div id="EndofYearPicnic">';
    if (isset($_POST['RSVP'])) {
        $data = array(
            'id' => $user['id'],
            'name' => $user['name'],
            'item' => $_POST['item']

            );
        $db->insert('picnic_rsvp', $data);
    }
    $rsvps = $db->get('picnic_rsvp');
    $going = 0;
    foreach ($rsvps as $rsvp)
    {
        if ($rsvp['id'] == $user['id'])
        {
            $going = 1;
        }
    }

    if($going == 0)
    {
        echo '<h2>RSVP for the end of year picnic?</h2>';
        echo '<form id="RSVP" method="post">
        <p class="message">If you want to bring a dish to the picnic, enter it below:</p>
        <input type="text" id="item" class="full" name="item" placeholder="Item"/>
        </form>
        <input  form="RSVP" type="submit" name="RSVP"/>';
    }
    else
    {
        echo '<h2>Thank you for RSVPing for the end of year picnic</h2>';
        $confirm = (new ConfirmBuilder($user['id']))
        ->confirmText("Are you sure you want to undo RSVP?")
        ->targetLoc("profile?user=$user[id]&drop=rsvp");
        $confirm->getContent("Undo RSVP");
    }
    echo '</div>';
}
?>
</div>
</div>
</div>

</body>

</html>
