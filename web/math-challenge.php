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
<h1><code><center> MATH   CHALLENGE</center></code></h1>
</header><center style="text-align: center;font-size:14px">
<i>“Without mathematics, there’s nothing you can do. Everything

around you is mathematics. Everything around you is

numbers.”</i> - Shakuntala Devi</center>
<br>
<div class="Overview" style="text-align: justify;">
 	<center><b><h3>Overview</h3></b></center>
	
The Salisbury University Math and Computer Science Club wants to give

undergraduates an exciting opportunity to show off their mathematics skills.

Every fall semester the Club hosts a computer programming challenge called GullCode. Last year, over

100 participants endeavored in a four-hour coding competition! 1st, 2nd, and 3rd place teams won

prizes, and everyone received free t-shirts- there was lots of FREE food. Overall it was a truly a

fantastic time!

During the process of promoting GullCode many science majors asked if there were any “math

challenges” for the people who don’t know how to code. The Club can now confidently say YES!

 </div>
<br><br>

<div class="containerz">
<!-- About container  -->
 <div class="column-left">
 	<center><b><h3><u>Rules</u></h3></b></center>
	<center>There will be two portions to the Math Challenge:
	<br>
	|Individual|&nbsp; &nbsp; &nbsp; &nbsp;|Group| </center>
	<br>
	<b>Individual</b><br>
		<ul>
			<li>Each individual will recieve the same sequence problems in a packet. </li>
			<li>Time limit to complete packet is ~60 minutes.</li>
			<li>Once time is up, the test will be collected and taken to the judges room.</li>
			<li>1st place winner will be designated for Freshman and Sophomores </li>
			<li>1st place winner designated for Juniors and Seniors.</li>
			<li>After the individual portion is complete, the room will be prepared for the group portion.</li>
		</ul>
	<b>Group</b><br>
		<ul>
			<li>Teams of <b>3</b> will be given a set of group problems. </li>
			<li>Group progress will be indicated in real time on a visible score board.</li>
			<li>Time limit to complete set of problems is ~120 minutes. </li>
			<li> Once time is up, there will be a brief intermission before the closing ceremony.</li>
			</ul>

 </div>

 <div class="column-right" >
<center><b><h3><u>Questions</u></h3></b></center>
<center>Salisbury professors will generate problems from the very classes that they teach and will ne the judges for the Math Challenge. From the list of courses below, at least one question will be given:</center>

 	<ul>
			<li> Math 155 (Modern Statistics with Computer Analysis)</li>
			<li> Math 160 (Intro to Applied Calculus)</li>
			<li> Math 201 (Calculus I)</li>
			<li> Math 202 (Calculus II)</li>
			<li> Math 210 (Intro to Discrete Mathematics)</li>
			<li> Math 213 (Statistical Thinking)</li>
			<li> Math 215 (Intro to Financial Mathematics)</li>
			<li> Math 300 (Intro to Abstract Mathematics)</li>
			<li> Math 306 (Linear Algebra)</li>
			<li>Math 310 (Calculus III)</li>
 			<li>Math 311 (Differential Equations I)</li>
			<li>Math 402 (Theory of Numbers)</li>
			<li>Math 406 (Geometric Structures)</li>
			<li>Math 413 (Mathematical Statistics I)</li>
			<li>Math 415 (Actuarial and Financial Models)</li>
			<li>Math 441 (Abstract Algebra I)</li>
			<li>Math 451 (Analysis I)</li>
	</ul>
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
	} 
	else {
		include("views/SignUp.html");
	}
?>

</div>
<!--End content container-->
</div>
<!--End main container-->
</body>

</html>
