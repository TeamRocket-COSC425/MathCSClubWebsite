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
 	if(isset($_POST['confirm_delete'])) { //confirms removal if button on this page is clicked
		$db->where('id', $user['id'])->delete('gullcode_users_on_teams'); //remove the user from gullcode team
?>		"<?php echo $user['name']; ?>" has been removed. 

		<a class="button" href="dashboard">To Dashboard</a> 
<?php
	} else {
?>  	<h4>Are you sure you want to remove <?php echo($user['name'])?>	from this team? </h4>
		<p style="color:red;"><img src='images/message-icons/error.png' width='50'> This cannot be undone</p>
		<form method="post" id="delete_profile">
		</form> 
		<!-- confirms removal for isset($_POST['confirm_delete']) -->
		<input form="delete_profile" class="dangerbutton" type="submit" name="confirm_delete" id="delete_profile" value="Yes" /> 
		<a id="delete_go_back" class="button" href="#">Go Back</a>
<?php
	}
	die();
  }
?>
</center>
</div>
</div>
</body>