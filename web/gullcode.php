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
    <link rel="stylesheet" href="css/gullcode.css"/>
</head>

<body>

<div id="main">

<div id="content">

<h1 class="center">
<code>
GullCode
</code>
</h1>

<div id="cols">
<img src="images/gullcode/gullcode_sp2014.jpg" class="gullcodepic">
<h2 class="center">
Date: November 19th 2016 <br>
Time: 8am - 2pm <br>
Location: Nanticoke Room in GUC
</h2>
<img src="images/gullcode/gullcode_fa2015.jpg" class="gullcodepic">
</div>

<hr style="background-color: #003366; height: 3px;">

<p class="center">
Teams will be given a set of problems to be solved using either JAVA, C++, or Python which will require a logical or mathematical algorithm to solve. Each team can have up to 3 members to code their solutions. Teams are allowed to use their own laptop computers or the school desktops where available. The team that completes the most problems correctly within the 4 hour time window will be declared the winner. In the event of a tie, a judge will determine the winner based on efficiency of the algorithm and code design. All judgments are final.
</p>

<hr style="background-color: #003366; height: 3px;">

<!-- <h2 class="center">
<code>
Fall 2016 Teams and Participants
</code>
</h2>


<div id="cols">
<table id="teams">
<th colspan="3"> Team 1 </th>
<tr>
<td> Name 1 </td>
<td> Major 1 </td>
<td> Year 1 </td>
</tr>
<tr>
<td> Name 2 </td>
<td> Major 2 </td>
<td> Year 2 </td>
</tr>
<tr>
<td> Name 3 </td>
<td> Major 3 </td>
<td> Year 3 </td>
</tr>
</table>

<table id="teams">
<th colspan="3"> Team 2 </th>
<tr>
<td> Name 1 </td>
<td> Major 1 </td>
<td> Year 1 </td>
</tr>
<tr>
<td> Name 2 </td>
<td> Major 2 </td>
<td> Year 2 </td>
</tr>
<tr>
<td colspan="3"> <?php include("includes/jointeam.html");
?> </td>
</tr>
</table>

<table id="teams">
<th colspan="3"> Team 2 </th>
<tr>
<td> Name 1 </td>
<td> Major 1 </td>
<td> Year 1 </td>
</tr>
<tr>
<td colspan="3"> <?php include("includes/jointeam.html");
?> </td>
</tr>
<tr>
<td colspan="3"> <?php include("includes/jointeam.html");
?> </td>
</tr>
</table>
</div>  -->

<br>

<table id="teams">
<th colspan="4"> Free Agents </th>
<tr>
<td> Name </td>
<td> Email </td>
<td> Major </td>
<td> Year </td>
</tr>
</table>

<br>

<?php 
	if($login->isUserLoggedIn()) {
		include("views/GC-MC-Register.html");
	} else {
		include("views/SignUp.html");
	}
?>
</div>
</div>

</body>

</html>
