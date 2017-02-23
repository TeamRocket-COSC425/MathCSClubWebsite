<?php
    $title = "SU Math/CS Club Mentor Program";
    require_once('classes/EditableText.php');
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

<div id="content" class="center">

<div id="mentor-mobile">
<header class="banner">
    <h1>Mentor Program</h1>
</header>

<hr style="background-color: #003366; height: 3px;">

<p class="center">
    <?php (new EditableText("mentor-program"))->getContent(); ?>
</p>

<hr style="background-color: #003366; height: 3px;">

<h2>
    Meet the Mentors
</h2>
<h4>
    Select a picture below to view their profile:
</h4>



<?php
	$mentors = $db->where('mentor', 1)->get('users');

	echo '<div class="mentors">';
	foreach ($mentors as $mentor)
	{
        echo "<div class=\"block\">
                <h3>$mentor[name]</h3>
                <a href=\"profile?user=$mentor[id]\">
                    <img src=\"$mentor[image]\" class=\"mentorpic\">
                </a>
             </div>";
	}
    echo '</div>';
?>
<br>


<?php
	if($login->isUserLoggedIn())
	{
		$user = Utils::getCurrentUser();
		
		if (empty($user['image']) && empty($user['bio']) && $user['year']>1 && $user['mentor'] == 0)
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
</div>

</body>

</html>
