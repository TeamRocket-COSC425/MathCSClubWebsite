<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

    require_once("classes/Login.php");
    require_once("classes/Utils.php");
  	$login = new Login();
  	require_once("classes/EditableContent.php");
?>

<head>
	<title>Math CS Club - GullCode</title>
    <link rel="stylesheet" href="css/math-challenge.css"/>
</head>

<body>

<div id="main">

<div id="content">

<!--Top header line -->
<header>
<h1><code><center> MATH   CHALLENGE</center></code></h1>
</header><center style="text-align: center;font-size:14px">
<i>“Without mathematics, there’s nothing you can do. Everything

around you is mathematics. Everything around you is

numbers.”</i> - Shakuntala Devi</center>
<br>
<div class="Overview" style="text-align: justify;">
 	<?php (new EditableContent("math-challenge-overview"))->getContent();?>
<br><br>

<div class="containerz">
<!-- About container  -->
 <div class="column-left" style="text-align:left;">
 	<?php (new EditableContent("math-challenge-rules"))->getContent();?>
 </div>

 <div class="column-right" >
	<?php (new EditableContent("math-challenge-questions"))->getContent();?>
 </div>

 </div>

<!--End Rules container-->
<br>
<?php
	if ($login->isUserLoggedIn()) {
    $admin = Utils::currentUserAdmin();
    if ($admin) {
 		$teams = $db->where("team_id")->get("math_challenge_teams");
 	  	$team_members = $db->where("team_id")->get("math_challenge_users_on_teams");
      	$users = $db->get("users");

     	foreach ($teams as $team) {
     		if($teams) {
     			echo "<table id=teams> <th colspan='5'>" . $team['team_name'] . "</th>";
      			foreach ($team_members as $team_member) {
      				if($team['team_id'] == $team_member['team_id']) {
      					foreach ($users as $user) {
      						if ($team_member['id'] == $user['id']) {
      							echo "<tr><td>" . $user['name'] . "</td><td>" . $user['email'] . "</td><td>" . $user['major'] . "</td><td>" . Utils::year($user['year']) . "</td><td>" . Utils::t_size($user['t_size']) . "</td></tr>";
      						}
      					}
      				}
      			}
      			echo "</table> <br>";
     		}
     	}
  	}
}	
?>
<?php 
	if($login->isUserLoggedIn())
	{
		$free_agents = $db->where("team_id", 0)->get("math_challenge_users_on_teams");
		$users = $db->get("users");
		echo '<table id="teams" class="table table-condensed">';

		if($free_agents) {			
			echo '<th colspan="4">' . 'Free Agents' . "</th>";
		}

		foreach ($free_agents as $free_agent) {  
			foreach($users as $user) {
				if ($free_agent['id'] == $user['id']) {
					echo "<tr><td>" . $user['name'] . "</td><td>" . $user['email'] . "</td><td>" . $user['major'] . "</td><td>" . Utils::year($user['year']) . "</td></tr>";
				}
			}
		}

		echo "</table>"; 
	}
?>
 
<br>

<?php 
	if($login->isUserLoggedIn()) {
		$user = Utils::getCurrentUser();
        $members = $db->get("math_challenge_users_on_teams");
		$check=0;

        foreach ($members as $member) {
            if($member['id'] == $user['id']) {
                $check = 1;
            }

        }
        if($check == 1) {
            echo("<p class ='center' style='color:red;'><u>You have already registered for math challenge. Check your profile for info</u></p>");
        }
        else{
        	include("views/GC-MC-Register.html");
        }	
	} 
	else {
		echo("<br><br><br>");
		include("views/SignUp.html");
	}
?>

</div>
<!--End content container-->
</div>
<!--End main container-->
</body>

</html>
