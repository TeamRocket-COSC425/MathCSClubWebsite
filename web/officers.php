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

<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
<script type="text/javascript">
function toggleByID(IDName) {
    $("#default").hide();
    $(".bio").hide();
    $("#"+IDName).toggle();
}</script>

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
            echo '<a id="'. $pos["position"] .'"> <img src="' . $pos["image"] . '" onclick="toggleByID(\''. $pos["position"] .'-bio\');"></a>';                    
    	  }
    ?>

<div id='officer-bio'>

    <div id='default'>
        <p>Click on an officer's picture to learn more about them</p>
    </div>

    <?php
        $bios = $db->get('officers');
        foreach($bios as $bio) {
            echo '<div id=\'' . $bio["position"] .'-bio\' class=\'bio\'>';
            echo '<H2>' . $bio["name"] . '</H2>';
            echo '<H3>' . $bio["title"] . '</H3>';
            echo '<p>' . $bio["bio"] . '</p>';
            echo '</div>';
        }

    ?>
</div>
    <!--<div class='advisor'>-->
        <div id='advisor1'  class='advisor'>
            <img src='images/officers/billy.jpg'>
        </div>

        <div id='advisor2'  class='advisor'>
            <img src='images/officers/billy.jpg'>
        </div>
    <!--</div>-->
</div>
</div>
</div>

</body>

</html>
