<?php
    $title = "SU Math/CS Club Mentor Program";
    require_once('classes/EditableContent.php');
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/Utils.php");
?>

<head>
	<title>Math CS Club - Mentor Program</title>
    <link rel="stylesheet" href="css/mentor-program.css"/>
</head>

<body>

<div id="main">

<div id="content">

<header>
<h1><code><center> Mentor Program </center></code></h1>
</header>

<hr style="background-color: #003366; height: 3px;">

<p class="center">
    <?php (new EditableContent("mentor-program"))->getContent(); ?>
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
				$mentor["name"] . '" onclick="window.location=\'profile.php?user='. $mentor["id"] . '\'"> </td></tr></table></td>';
				$count= $count - 1;
			}
			else
			{
				echo '<td><table id="mentors" align="center">';
				echo "<th colspan='1'>" . $mentor['name'] . "</th>";
				echo '<tr><td> <img src="' . $mentor["image"] . '" class=\'mentorpic\' alt="' .
				$mentor["name"] . '" onclick="window.location=\'profile.php?user='. $mentor["id"] . '\'"> </td></tr></table></td>';
				if ($ogcount > "3"){
					echo "</tr><tr>";
				}
				$count= $count - 1;
			}
		}
		echo "</tr></table>";
?>
<br>


<?php
	if($login->isUserLoggedIn())
	{
		$user = Utils::getCurrentUser();
		if ($user['year']<2)
		{
			include ("views/Mentee.html");
		}
		else if (empty($user['image']) && empty($user['bio']) && $user['year']>1 && $user['mentor'] == 0)
		{
			echo("<p class ='center' style='color:red;'>You must have a bio and image to become a mentor</p>");
		}else if (empty($user['bio']) && $user['year']>1 && $user['mentor'] == 0)
		{
			echo("<p class ='center' style='color:red;'>You must have a bio to become a mentor</p>");
		}
		else if (empty($user['image']) && $user['year']>1 && $user['mentor'] == 0)
		{
			echo("<p class ='center' style='color:red;'>You must have an image to become a mentor</p>");
		}
		else if (!empty($user['bio']) && !empty($user['image']) && $user['year']>1 && $user['mentor'] == 0)
		{
			include ("views/Mentor.html");
		}
		
	}
?>

</div>
</div>

</body>

</html>
