<?php
    $title = "SU Math/CS Club Mentor Program";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
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

<script>
var text = document.forms[0].txt.value;
text = text.replace(/\r?\n/g, '<br>');
</script>

<table id="mentors">
<th>
<u>Ben Kenobi</u>
</th>
<tr>
<td>
<img src="images/mentors/ben-kenobi.jpg" alt="Ben Kenobi" class="mentorpic" onclick="document.forms[0].elements['Mentor Info'].value = 'Name:  Ben Kenobi \nYear:  Senior \nMajor: Jedi \nBio:   Ben is a hermit living in the wastelands of Tatonine. He is incredly wise and would make a great mentor to anyone looking to learn the ways of the force and go on adventures'">
</td>
</tr>
</table>
<br>

<form class="center">
<textarea class="mentorinfo" name="Mentor Info" placeholder="Select a Mentor" readonly>
</textarea>
</form>


</div>
</div>

</body>

</html>
