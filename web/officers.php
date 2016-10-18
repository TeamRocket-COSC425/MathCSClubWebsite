<?php
    $title = "SU Math/CS Club Officers";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("includes/database.php");
?>

<head>
	<title>Math CS Club - Officers</title>
    <link rel="stylesheet" href="css/officers.css"/>
</head>

<body>

<div id="main">

<div id="content">

<h1>
Meet Your Officers
</h1>

<div class='circle-container'>
	<div class='groupPic'><img src="images/officers/fall16septemberOfficers.jpg"></div>
	<?php
      	$positions = $db->get('officers');
      	foreach($positions as $pos) {
        	echo '<a  class="'. $pos["position"] .'"> <img src="' . $pos["image"] . '" ></a>';                    
    	  }
    ?>
</div>
</div>
</div>

</body>

</html>
