<?php
    $title = "SU Math/CS Club Activities & Field Trips";
    require_once("classes/EditableText.php");
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Activities &amp; Field Trips</title>
	<link rel="stylesheet" href="css/activities.css"/>

</head>

<body>

<div id="main">

<div id="content">


    <img src="images/meeting/fall16september.jpg" alt="meetingpicture" class="mySlides"/>
    <img src="images/activities/meetingsp2015.jpg" alt="multicultural day" class="mySlides"/>
	<img src="images/activities/image3.jpg" alt="Wiffle ball" class="mySlides"/>
  	<img src="images/activities/oriolessp2016.png" alt="activities fair" class="mySlides"/>
  	<img src="images/activities/IMG_1895.jpg" alt="chicken dinner" class="mySlides"/>

<h1 class="center">
Activites &amp; Field Trips
</h1>

<?php
  (new EditableText("fall-semester"))->getContent();
?>

<?php
    $fall_activities = $db->get("fall_activities");

    foreach ($fall_activities as $fall_activity) 
    {
        echo "<button class='accordion'>" . $fall_activity['activity'] . "</button>";
        echo "<div class='panel'>";
        (new EditableText("'" . $fall_activity['activity'] . "'"))->getContent();
        echo "</div>";

    }
?>

<?php
  (new EditableText("spring-semester"))->getContent();
?>

<?php
    $spring_activities = $db->get("spring_activities");

    foreach ($spring_activities as $spring_activity) 
    {
        echo "<button class='accordion'>" . $spring_activity['activity'] . "</button>";
        echo "<div class='panel'>";
        (new EditableText("'" . $spring_activity['activity'] . "'"))->getContent();
        echo "</div>";
    }
?>

<!--EVENTS NEED TO BE DYNAMICALLY ALLOCATED IN THE DB SO PRES CAN ADD MORE AND STUFF-->
<?php /*
<button class="accordion">Slaughter House Farm</button>
<div class="panel">

<?php
(new EditableText("Event1"))->getContent();
?>

</div>

<button class="accordion">Orioles Game</button>
<div class="panel">

<?php (new EditableText("Event2"))->getContent();
?>

</div>

<button class="accordion">Pumpkin Carving</button>
<div class="panel">

<?php (new EditableText("Event3"))->getContent();
?>

</div>

<button class="accordion">GeoPong</button>
<div class="panel">
 <?php (new EditableText("Event4"))->getContent();
?>
</div>
*/?>

</p>
</div>
</div>


<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 9000);
}

//script for accordion
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
</script>
</body>

</html>
