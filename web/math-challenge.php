<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");

    require_once("classes/Login.php");
    require_once("classes/Utils.php");
  	$login = new Login();
  	require_once("classes/EditableText.php");
?>

<head>
	<title>Math CS Club - GullCode</title>
    <link rel="stylesheet" href="css/math-challenge.css"/>
</head>

<body>

<div id="main">

<div id="content">

<!--Top header line -->
<header class="banner">
    <h1>Math Challenge</h1>
</header>

<center style="text-align: center;font-size:14px">
<i>“Without mathematics, there’s nothing you can do. Everything

around you is mathematics. Everything around you is

numbers.”</i> - Shakuntala Devi</center>
<br>
<div class="Overview" style="text-align: justify;">
 	<?php (new EditableText("math-challenge-overview"))->getContent();?>

</div>

<div class="containerz">

 <div class="column-left" style="text-align:left;">
 	<?php (new EditableText("math-challenge-rules"))->getContent();?>
 </div>

 <div class="column-right" >
	<?php (new EditableText("math-challenge-questions"))->getContent();?>
 </div>




 </div>

<!--End Rules container-->
<?php
  if($login->isUserLoggedIn()) {
    $control = $db->where("admin_controls", "math_challenge_register")->getone("admin_controls");
    if($control["switch"] == 1) {
      include("views/GC-MC-Register.html");
    }
  }
?>

</div>


<!--End content container-->

</div>

<!--End main container-->

</body>

</html>
