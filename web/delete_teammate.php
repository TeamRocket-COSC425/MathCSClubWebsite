<head>
	<title>User Profile</title>
    <link rel="stylesheet" href="css/forms.css"/>
    <link rel="stylesheet" href="css/profile.css"/>
</head>

<?php

    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

 	$title = "Remove Teammate";

 	//Login
    require_once("classes/Utils.php");
    require_once("classes/Login.php");
    require_once("classes/ConfirmBuilder.php");
    $login = new Login;
    if (!$login->isUserLoggedIn()) {
      header("Location: home");
    }

    //Pull database information from our specific user team
    $user = Utils::getCurrentUser();
    $currentuser = $user;
    $userteam = $db->where('id',  $_GET['user'])->getOne('gullcode_users_on_teams');
    $user = $db->where('id', $_GET['user'])->getOne('users') ?: $user;

    //check if remove button was clicked(delete)
    $delete = isset($_GET['delete']);
?>

<body>

<div id="main">

<div id="content">

<script>
	$(document).ready(function(){
		$("#delete_go_back").click(function(){
			window.history.back();
		});
	});
</script>

<center>

<?php

 if ($delete) {
 	if(isset($_SESSION[ConfirmBuilder::KEY_UID]) && $_SESSION[ConfirmBuilder::KEY_UID] == $user['id']) {
		$db->where('id', $user['id'])->delete('gullcode_users_on_teams'); //remove the user from gullcode team
        if (count($db->where('team_id', $userteam['team_id'])->get('gullcode_users_on_teams')) == 0) {
            $db->where('team_id', $userteam['team_id'])->delete('gullcode_teams');
        }
?>
        "<?= $user['name'] ?>" has been removed.
		<a class="button" href="dashboard">To Dashboard</a>
<?php
	}
	die();
  }
?>
</center>
</div>
</div>
</body>
