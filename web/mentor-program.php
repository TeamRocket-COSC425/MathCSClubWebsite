<?php
    $title = "SU Math/CS Club Mentor Program";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/Utils.php");
    require_once("classes/Login.php");
    $login = new Login();
?>

<head>
	<title>Math CS Club - Mentor Program</title>
    <link rel="stylesheet" href="css/mentor-program.css"/>
</head>

<body>

<div id="main">

<div id="content">

<h1 class="center">
Mentor Program
</h1>

<hr style="background-color: #003366; height: 3px;">

<p class="center">
The SU Math and Computer Science club mentor program is a way for underclassmen and upperclassmen to get connected in a way that might not happen otherwise. The upperclassmen become mentors to their underclassmen mentee for the purpose of getting them acclimated to living and studying here at SU. The goal of this program is help incoming students build relationships and hopefully establish a source of support, advice and friedship.
</p>

<hr style="background-color: #003366; height: 3px;">

<h2 class="center">
<u>Meet the Mentors</u>
</h2>



<?php 
	$mentors = $db->where('mentor', 1)->get('users');
	echo "<table id='mentors' align='center'><tr>";
		$count=sizeof($mentors);
		$ogcount=sizeof($mentors);

		foreach ($mentors as $mentor) 
		{  
			if ($count % "3" != "0" && $ogcount > "3")
			{
				echo '<td><table id="mentors" align="center">';
				echo "<th colspan='1'>" . $mentor['name'] . "</th>";
				echo '<tr><td> <img src="' . $mentor["image"] . '" class=\'mentorpic\' alt="' . 
				$mentor["name"] . '" onclick="document.forms[0].elements[\'Mentor Info\'].value = \'' . $mentor["name"] . '\n\n' . $mentor["major"] . '\n\n' . Utils::year($mentor["year"]) . '\n\n' . $mentor["bio"] . '\'"> </td></tr></table></td>';
				$count= $count - 1;
			}
			else
			{
				echo '<td><table id="mentors" align="center">';
				echo "<th colspan='1'>" . $mentor['name'] . "</th>";
				echo '<tr><td> <img src="' . $mentor["image"] . '" class=\'mentorpic\' alt="' . 
				$mentor["name"] . '" onclick="document.forms[0].elements[\'Mentor Info\'].value = \'' . $mentor["name"] . '\n\n' . $mentor["major"] . '\n\n' . Utils::year($mentor["year"]) . '\n\n' . $mentor["bio"] . '\'"> </td></tr></table></td>';
				if ($ogcount > "3"){
					echo "</tr><tr>";
				}	
				$count= $count - 1;
			}
		}
		echo "</tr></table>";
?>
<br>

<form class="center">
<textarea class="mentorinfo" name="Mentor Info" placeholder="Select a Mentor" readonly>
</textarea>
</form>

<?php
	if($login->isUserLoggedIn())
	{
		$user = Utils::getCurrentUser();
		if ($user['year']<"2")
		{
			include ("views/Mentee.html");
		}
		else if (is_null($user['bio']) && $user['year']>"1" && $user['mentor'] = 0)
		{
			echo("<p class ='center' style='color:red;'>You must have a bio to become a mentor</p>");
		}
		else if (is_null($user['image']) && $user['year']>"1" && $user['mentor'] = 0)
		{
			echo("<p class ='center' style='color:red;'>You must have an image to become a mentor</p>");
		}
		else if ($user['year']>"1" && $user['mentor'] = 0)
		{
			include ("views/Mentor.html");
		}
		
	}
?>


</div>
</div>

</body>

</html>
