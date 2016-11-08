<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

	require_once("classes/Login.php");
	require_once("classes/Utils.php");
  require_once("classes/EditableContent.php");
  	$login = new Login();
?>
<head>
	<title>Math CS Club - GullCode</title>
    <link rel="stylesheet" href="css/gullcode.css"/>
</head>

<body>

<div id="main">

<div id="content">
<?php (new EditableContent("gullcode"))->getContent(); ?>
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

<br >

<?php
	if($login->isUserLoggedIn()) {
		$user = Utils::getCurrentUser();

        $members = $db->get("gullcode_users_on_teams");
		$check = 0 ;
        foreach ($members as $member) {
            if($member['id'] == $user['id']) {
                $check = 1;
            }

        }
        if($check == 1) {
            echo("<p class ='center' style='color:red;'><u>You have already registered for gullcode. Check your profile for info</u></p>");
        }
        else{
        	include("views/GC-MC-Register.html");
        }	
	} else {
		include("views/SignUp.html");
	}
?>


</div>
</div>

</body>

</html>
