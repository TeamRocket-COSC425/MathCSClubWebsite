<?php
    $title = "User Profile";
    require_once("classes/Utils.php");
    require_once("classes/Login.php");
    $login = new Login;
    if (!$login->isUserLoggedIn()) {
      header("Location: home");
    }
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>User Profile</title>
  <link rel="stylesheet" href="css/profile.css"/>
</head>

<body>

<div id="main">

<div id="content">
<?php
  $user = Utils::getCurrentUser();
  $currentuser = $user;

  $edit = isset($_GET['edit']);
  if (isset($_GET['user'])) {
    $user= $db->where('id', $_GET['user'])->getOne('users') ?: $user;
  }

  if ($user != $currentuser && !Utils::currentUserAdmin()) {
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
  <center>
  <?php
    $image = $user['image'];
    if (!$image) {
      $image = "images/loginicon.jpg";
    }

    //if ($edit) {
      // TODO
    //} else {
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
    //}
  ?>
  <br>
  <?php
    $url = strtok($_SERVER['REQUEST_URI'], '?') . '?edit';
    if (isset($_GET['user'])) {
      $url = $url . '&user=' . $_GET['user'];
    }
  ?>
  <a class="button" href="<?php echo $url; ?>">Edit Profile</a>
  </center>
</div>
<div id="right_column">
  <div id="bio">
    <h3> Bio </h3><hr/>
    <p>
      <?php
        $parser = Parsedown::instance();
        echo $parser->text($user['bio']);
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
