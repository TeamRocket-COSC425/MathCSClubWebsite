<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

    require_once("classes/Login.php");
    require_once("classes/Utils.php");
  	$login = new Login();
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
<h1><code> MATH   &nbsp;   &nbsp; CHALLENGE</code></h1>
</header>
<br>

<div id="cols">
<!-- About container  -->
 <div class="center" style="text-align:justify;">
 	<center><b><h3><u> About</u></h3> </b></center>
 	The Math Challenge is new to Salisbury University! Are you prepared to test yourself against the mightest of mathematicians? Whether you choose to take the individual challenge or fight side by side against other teams competing, we promise you will take from this a great deal of knowledge and fun! Signing up is easy, just follow information below. 
 </div>
<!-- End About container -->
<!--Images container -->
 <div class="center" >
   	<img src = "images/activities/meetingsp2015.jpg" class="gullcodepic">
	<img src ="images/math-challenge/mc-triangles.jpg" class ="gullcodepic">


</div>
<!--End Images container-->
<!--Rules container -->
 <div class="center"style="text-align:justify;">
    <center><b><h3><u>Rules</u></h3></b></center>
	
	<b>Individual</b><br>
		<ul>
			<li>Each individual will recieve a certain number of problems. </li>
			<li>There is a time limit</li>
		</ul>
	<b>Group</b><br>
		<ul>
			<li>Teams of <b>3</b> will recieve a certain number of problems. </li>
			<li>There is a time limite </li>
 </div>

 </div>
  <div class="center">
 	<center><b><h3><u>Prizes</u></h3></b></center>
 	There will be a award for First Place, Second Place, Third Place, and Most Creative Problem Solving Team.
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
		echo '<table id="teams">';

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
	} else {
		include("views/SignUp.html");
	}
?>

</div>
<!--End content container-->
</div>
<!--End main container-->
</body>

</html>
