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

<header class="banner">
            <h1>Activities &amp; Field Trips</h1>
</header>

    <img src="images/meeting/fall16september.jpg" alt="meetingpicture" class="mySlides"/>
    <img src="images/activities/meetingsp2015.jpg" alt="multicultural day" class="mySlides"/>
    <img src="images/activities/image3.jpg" alt="Wiffle ball" class="mySlides"/>
    <img src="images/activities/oriolessp2016.png" alt="activities fair" class="mySlides"/>
    <img src="images/activities/IMG_1895.jpg" alt="chicken dinner" class="mySlides"/>

<?php
    (new EditableText("fall-semester"))->getContent();
?>

<br><br>

<?php
    $fall_activities = $db->get('fall_activities');
    if ($fall_activities) {
        foreach ($fall_activities as $fall_activity) {
        ?>
            <button class="accordion"> <?php echo $fall_activity['activity']; ?> </button>
            <div class="panel">
            <?php
                (new EditableText($fall_activity['activity']))->getContent();
            ?>
            </div>
        <?php
            echo "<br>";
        }
    }
?>

<?php
    (new EditableText("spring-semester"))->getContent();
?>

<br><br>

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
