<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

    require_once("classes/Login.php");
    require_once("classes/Utils.php");
  	$login = new Login();
  	require_once("classes/EditableContent.php");
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
 	<?php (new EditableContent("math-challenge-overview"))->getContent();?>
<br><br>
</div>

<div class="containerz">
<!-- About container  -->
 <div class="column-left" style="text-align:left;">
 	<?php (new EditableContent("math-challenge-rules"))->getContent();?>
 </div>

 <div class="column-right" >
	<?php (new EditableContent("math-challenge-questions"))->getContent();?>
 </div>
 </div>

<!--End Rules container-->
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
