<?php
    $title = "SU Math/CS Club Registration";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - GullCode/Math Challenge Registration</title>
	  <link rel="stylesheet" href="css/forms.css"/>
	  <link rel="stylesheet" href="css/gc-mc-registration.css">

</head>

<body class="login-background">
<div class="container">
<br><br><br><br><br><br>
<div id="tabbox">
<a href="#" id="gullcode" class="tab gullcode">Gull Code</a>
<a href="#" id="math-challenge" class="tab math-challenge">Math Challenge</a>;
</div>
<div id="panel">
<div id="math_challenge_box">
<strong><code>Math Challenge Signup Form</code></strong>
 	<select id="reg_input_group" name="group" required>
    <optgroup label="Group">
	    <option value="0">Individual</option>
	    <option value="1">Team</option>

    </optgroup>
	</select>

<br>

</div>
<div id="gullcode_box">




<!-- if the user is logged in and it shows he has a "0" for no team and a "1" if there is a value for team. -->
<!-- if 0 then ask them to create a team or sign up from list below -->
<!-- if 1 then say you already signed up for gullcode -->


<code><strong>Gull Code Signup Form</strong></code>
<br>
Enter Team Name:
<br>
 <input id="gullcode_team" type="text" name="team_name" placeholder="Team Name"  > <input type = "submit" placeholder="Submit">
<br>





</div>
</div>
</div>


</div>



<!-- below is the script for our tab to change between gullcode and math challenge  -->
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

$(".tab").click(function()
{
var X=$(this).attr('id');

if(X=='math-challenge')
{
$("#gullcode").removeClass('select');
$("#math-challenge").addClass('select');
$("#gullcode_box").slideUp();
$("#math_challenge_box").slideDown();
}
else
{
$("#math-challenge").removeClass('select');
$("#gullcode").addClass('select');
$("#math_challenge_box").slideUp();
$("#gullcode_box").slideDown();
}

});

});
</script>
</body>
</html>