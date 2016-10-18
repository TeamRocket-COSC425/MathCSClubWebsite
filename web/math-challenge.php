<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

    require_once("classes/Login.php");
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
	
	$users = $db->get('users');
	echo '<table id="teams">';

	echo '<th colspan="4">' . 'Free Agents' . "</th>";

	foreach ($users as $user) {  
		if ($user['year'] == 0)
		{
			$class = 'Freshman';
		}
		if ($user['year'] == 1)
		{
			$class = 'Sophomore';
		}
		if ($user['year'] == 2)
		{
			$class = 'Junior';
		}
		if ($user['year'] == 3)
		{
			$class = 'Senior';
		}
		echo "<tr><td>" . $user['name'] . "</td><td>" . $user['email'] . "</td><td>" . $user['major'] . "</td><td>" . $class . "</td></tr>";  
	}

echo "</table>"; 

?>

<br>

<?php 
	if($login->isUserLoggedIn()) {
		include("views/GC-MC-Register.html");
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
