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
    /*$("#president-bio").hide();
    $("#treasurer-bio").hide();
    $("#webMaster-bio").hide();
    $("#secretary-bio").hide();
    $("#representative-bio").hide();
    $("#vicePresident-bio").hide();
    $("#DPS-bio").hide();*/
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
            echo '<a id="'. $pos["position"] .'"> <img src="' . $pos["image"] . '" onclick="toggleByID("'. $pos["position"] .'-bio");"></a>';                    
    	  }
    ?>

<div id='officer-bio'>
    <div id='default'>
        <p>Click on an officer's picture to learn more about them</p>
    </div>
    <div id='president-bio' class='bio'>
        <?php
            $db->where('position', 'president');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>President</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>
    <div id='treasurer-bio' class='bio'>
        <?php
            $db->where('position', 'treasurer');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>Treasurer</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>
    <div id='webMaster-bio' class='bio'>
        <?php
            $db->where('position', 'webMaster');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>Web Master</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>
    <div id='secretary-bio' class='bio'>
        <?php
            $db->where('position', 'secretary');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>Secretary</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>
    <div id='representative-bio' class='bio'>
        <?php
            $db->where('position', 'representative');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>SGA representative</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>
    <div id='vicePresident-bio' class='bio'>
        <?php
            $db->where('position', 'vicePresident');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>Vice President</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>
    <div id='DPS-bio' class='bio'>
        <?php
            $db->where('position', 'DPS');
            $results = $db->getOne('officers');
            echo '<H2>"'. $results["name"] .'"<br>Dead Poet\'s Society</H2><p>"'. $results["bio"] .'"</p>';

        ?>
    </div>

</div>
</div>
<button onclick="toggleByID('president-bio');">Show President</button>
<button onclick="toggleByID('treasurer-bio');">Show Treasurer</button>
</div>
</div>

</body>

</html>
