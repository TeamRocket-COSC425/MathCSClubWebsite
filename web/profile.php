<?php
    $title = "User Profile";
    require_once("classes/Utils.php");
    require_once("classes/Login.php");
    $login = new Login;
    if (!$login->isUserLoggedIn()) {
      header("Location: home");
    }

    $user = Utils::getCurrentUser();
    $currentuser = $user;

    $edit = isset($_GET['edit']);
    if (isset($_GET['user'])) {
      $user = $db->where('id', $_GET['user'])->getOne('users') ?: $user;
    }

    // POST handling
    if (isset($_POST['submit'])) {
        $data = array(
            'email' => $_POST['email'],
            'preferred_email' => $_POST['preferred_email'],
            'major' => $_POST['major'],
            'year' => $_POST['year'],
            't_size' => $_POST['t_size'],
            'bio' => $_POST['bio']
        );

        $db->where('id', $user['id'])->update('users', $data);
        $loc = "profile";
        if ($user !== $currentuser) {
            $loc = $loc . '?' . $user['id'];
        }
        header("Location: " . $loc);
    }

    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>User Profile</title>
    <link rel="stylesheet" href="css/forms.css"/>
    <link rel="stylesheet" href="css/profile.css"/>
</head>

<body>

<div id="main">

<div id="content">
<?php
  if ($edit && $user !== $currentuser && !Utils::currentUserAdmin()) {
?>
    <center>
      You cannot edit this page.<br/>
      <a id="to_my_profile" class="button" href="profile?edit">To My Profile</a>
    </center>
<?php
    die();
  }
?>

<div id = "user_info">
<div id="left_column">
  <?php
    $image = $user['image'];
    if (!$image) {
      $image = "images/loginicon.jpg";
    }

    if ($edit) {
?>
        <div class="form">
            <form method="post" action="profile" id="profile">
            </form>

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

            <input form="profile" type="submit" name="submit" value="Save"/>
        </div>
<?php
    } else {
        echo "<img src=\"$image\" /><br>";
        echo '<h3>'. $user['name'] .'</h3>';
        $email = $user['email'];
        echo 'Email: ' . $email;
        if ($email !== $user['preferred_email']) {
            echo '<br>Preferred: ' . $user['preferred_email'];
        }
        echo '<br>Major: ' . $user['major'];
        echo '<br>Year: ' . Utils::year($user['year']);
        echo '<br>T-Shirt Size: ' . Utils::t_size($user['t_size']);

        $url = strtok($_SERVER['REQUEST_URI'], '?') . '?edit';
        if (isset($_GET['user'])) {
            $url = $url . '&user=' . $_GET['user'];
        }
  ?>
        <br>
        <a class="button" href="<?php echo $url; ?>">Edit Profile</a>
  <?php
    }
  ?>
</div>
<div id="right_column">
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
    <div id = "gullcode">
      <h3> Gullcode </h3><hr/>
      <center>
      <?php
        $userteam = $db->where('id', $user['id'])->getOne('gullcode_users_on_teams');
        if ($userteam) {
          $team = $db->where('team_id', $userteam['team_id'])->getOne('gullcode_teams');
          if ($team) {
            echo "You are on team \"$team[team_name]\"";
          } else {
            echo "Error, no team found!";
          }
        } else {
          echo "You are not on a team";
        }
      ?>
      </center>
    </div>
    <div id = "mathchallenge">
      <h3> Math Challenge </h3><hr/>
      <center>
      <?php
        $userteam = $db->where('id', $user['id'])->getOne('math_challenge_users_on_teams');
        if ($userteam) {
          $team = $db->where('team_id', $userteam['team_id'])->getOne('math_challenge_teams');
          if ($team) {
            echo "You are on team \"$team[team_name]\"";
          } else {
            echo "Error, no team found!";
          }
        } else {
          echo "You are not on a team";
        }
      ?>
      </center>
    </div>
</div>

</div>
</div>

</body>

</html>
